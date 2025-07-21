<?php
/**
 * Lightbox modifications for core blocks.
 *
 * Contains functions that enhance the core WordPress lightbox functionality,
 * including improved gallery navigation, custom close icons, and accessibility improvements.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Improve the core lightbox functionality for gallery blocks by wrapping blocks with multiple lightboxes in a div.
 *
 * This function checks if a gallery block contains multiple lightbox triggers.
 * If it does, it wraps the block content in a div with the ".so-gallery-lightboxes"
 * class, and a data attribute indicating the number of lightboxes. This is then
 * used by JavaScript to apply the improvements.
 *
 * @param string $block_content The content of the block.
 * @param array  $block         The block attributes.
 * @return string The modified block content.
 */
function siteorigin_snapshot_improve_lightbox( $block_content, $block ) {
	if ( empty( $block['attrs'] ) || empty( $block['attrs']['className'] ) ) {
		return $block_content;
	}

	if ( ! apply_filters( 'siteorigin_snapshot_improve_lightbox', true ) ) {
		return $block_content;
	}

	wp_enqueue_script( 'siteorigin-snapshot-lightbox' );
	wp_enqueue_style( 'siteorigin-snapshot-lightbox' );

	// Does the block have at least two lightboxes?
	$numberOfLightboxes = substr_count($block_content, 'lightbox-trigger');
	if ( $numberOfLightboxes < 2 ) {
		return $block_content;
	}

	// Nest the block to help with detection.
	return '<div class="so-gallery-lightboxes" data-lightboxes="' . (int) $numberOfLightboxes . '">' . $block_content . '</div>';
}
add_filter( 'render_block_core/gallery', 'siteorigin_snapshot_improve_lightbox', 10, 2 );

/**
 * Overrides the close icon for the Lightbox in the core Image Block, and alter the markup to help with styling.
 *
 * This function checks if the Lightbox is enabled for a block and replaces the second SVG icon with a custom close icon.
 *
 * @param string $block_content The content of the block.
 * @param array  $block         The block attributes.
 * @return string The modified block content.
 */
function siteorigin_snapshot_override_lightbox_close_icon( $block_content, $block ) {
	// Ensure the Lightbox is enabled.
	if (
		empty( $block['attrs'] ) ||
		empty( $block['attrs']['lightbox'] ) ||
		empty( $block['attrs']['lightbox']['enabled'] )
	) {
		return $block_content;
	}

	$snapshot_icon = siteorigin_snapshot_display_icon( 'close', true );

	// Image BLock has two SVGs, so we need to replace the second one.
	$i = 0;
	$block_content = preg_replace_callback(
		'/<svg(.*?)<\/svg>/s',
		function ( $matches ) use ( $snapshot_icon, & $i ) {
			$i++;
			if ( $i === 2 ) {
				return $snapshot_icon;
			}

			// Not a match. Return the original icon.
			return $matches[0];
		},
		$block_content
	);

	// Nest lightbox contents in a div to help with styling.
	$block_content = preg_replace( '/<figure(.*?)>/', '<figure$1><div class="so-lightbox">', $block_content );
	$block_content = str_replace( '</figure>', '</div></figure>', $block_content );

	remove_action( 'wp_footer', 'block_core_image_print_lightbox_overlay', 10, 0 );
	add_action( 'wp_footer', 'siteorigin_lightbox_improve_accessability', 10, 0 );

	return $block_content;
}
add_filter( 'render_block_core/image', 'siteorigin_snapshot_override_lightbox_close_icon', 20, 2 );

/**
 * Remove Core Lightbox Focus Trap. We need to handle this ourselves to allow for gallery navigation.
 *
 * This function removes the `data-wp-on--keydown="actions.handleKeydown"` attribute from the lightbox overlay. By default, this focus locks onto the close button.
 * This prevents use of the lightbox gallery controls.
 */
function siteorigin_lightbox_improve_accessability() {
	ob_start();
	block_core_image_print_lightbox_overlay();
	$lightbox_overlay = ob_get_clean();

	if ( ! apply_filters( 'siteorigin_snapshot_improve_lightbox', true ) ) {
		echo $lightbox_overlay;
		return;
	}

	$lightbox_overlay = preg_replace( '/data-wp-on--keydown="actions.handleKeydown"/', '', $lightbox_overlay );

	echo $lightbox_overlay;
}