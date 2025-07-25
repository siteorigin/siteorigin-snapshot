<?php
/**
 * Core WordPress block modifications.
 *
 * Contains functions that modify the output and behavior of core WordPress blocks
 * to enhance functionality and improve styling compatibility with the theme.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require 'modifications/icons.php';
require 'modifications/lightbox.php';
require 'modifications/navigation.php';

/**
 * Adjusts the markup of the latest posts block to help with styling.
 *
 * @param string $block_content The original HTML markup of the block.
 * @param array  $block         The block data.
 * @return string The modified HTML markup of the block.
 */
function siteorigin_snapshot_adjust_latest_post_block_markup( $block_content ) {
	$block_content = str_replace(
		'<a class="wp-block-latest-posts__post-title"',
		'<div class="so-group-block"><a class="wp-block-latest-posts__post-title"',
		$block_content
	);

	$block_content = str_replace(
		'</time>',
		'</time></div>',
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block_core/latest-posts', 'siteorigin_snapshot_adjust_latest_post_block_markup', 10 );


/**
 * Change the site title block element to p on all pages except the front page.
 *
 * @param string $block_content The original block content.
 * @return string The modified block content.
 */
function siteorigin_snapshot_site_title_block( $block_content ) {
	if ( ! is_front_page() ) {
		$element = sanitize_html_class( apply_filters( 'siteorigin_snapshot_fallback_site_title_element', 'p' ) );
		$block_content = str_replace( '<h1', "<$element", $block_content );
		$block_content = str_replace( '</h1>', "</$element>", $block_content );
	}

	return $block_content;
}
add_filter( 'render_block_core/site-title', 'siteorigin_snapshot_site_title_block' );

/**
 * Modify the Author block on all pages except for the author archive.
 *
 * Adds "All Author Posts" link below the bio and increases avatar size 
 * with high resolution support for crisp display on high-DPI screens.
 *
 * @param string $block_content The original block content.
 * @return string The modified block content.
 */
function siteorigin_snapshot_author_block( $block_content ) {
	// Confirm we're not already on the author archive.
	if ( is_author() ) {
		return $block_content;
	}

	// Add all author posts link.
	$icon = siteorigin_snapshot_display_icon( 'chevron-right' );
	$author_posts_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
	$author_link = '<a href="' . esc_url( $author_posts_url ) . '" class="all-posts">' . esc_html( __( 'All Author Posts', 'siteorigin-snapshot' ) ) . $icon . '</a>';

	$block_content = preg_replace(
		'/(<div class="wp-block-post-author__content">.*?)(<\/div>)/s',
		'$1' . $author_link . '$2',
		$block_content
	);

	// Get high-resolution avatar.
	$display_size = 128;
	$fetch_size = 256; // Double for retina.

	// Get the avatar at double size.
	$larger_avatar = get_avatar( get_the_author_meta( 'ID' ), $fetch_size );

	// First, adjust the dimensions to display size.
	$larger_avatar = preg_replace(
		'/(width|height)="\d+"/',
		'$1="' . $display_size . '"',
		$larger_avatar
	);

	// Only proceed for local uploads to avoid touching remote (e.g. Gravatar) URLs.
	if ( strpos( $larger_avatar, 'wp-content' ) !== false ) {
		// Extract the current image URL.
		preg_match( '/src="([^"]+)"/', $larger_avatar, $src_matches );

		if ( ! empty( $src_matches[1] ) ) {
			$current_url = $src_matches[1];

			// Create the potential 1× and 2× URLs.
			$url_1x = preg_replace( '/-\d+x\d+(\.[^.]+)$/', '-' . $display_size . 'x' . $display_size . '$1', $current_url );
			$url_2x = $current_url; // Already 256×256.

			// Verify that the larger file(s) actually exist on disk. Custom-avatar plugins
			// often skip intermediate image sizes, so requesting them would break.
			$upload_dir = wp_get_upload_dir();
			$path_1x   = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url_1x );
			$path_2x   = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url_2x );

			if ( file_exists( $path_1x ) && file_exists( $path_2x ) ) {
				// Both files exist – safe to output the srcset.
				$larger_avatar = preg_replace(
					'/(<img[^>]+src="[^"]+")([^>]*>)/',
					'$1 srcset="' . esc_url( $url_1x ) . ' 1x, ' . esc_url( $url_2x ) . ' 2x"$2',
					$larger_avatar
				);
			}

			// --- Fallback: if the 2× size file is missing, try the original (unsuffixed) file. ---
			elseif ( file_exists( $path_1x ) ) {
				$original_url  = preg_replace( '/-\d+x\d+(\.[^.]+)$/', '$1', $url_1x );
				$original_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $original_url );

				if ( file_exists( $original_path ) ) {
					$larger_avatar = preg_replace(
						'/(<img[^>]+src="[^"]+")([^>]*>)/',
						'$1 srcset="' . esc_url( $url_1x ) . ' 1x, ' . esc_url( $original_url ) . ' 2x"$2',
						$larger_avatar
					);
				}
			}
		}
	}

	// Replace the avatar in the block content.
	$block_content = preg_replace(
		'/(<div class="wp-block-post-author__avatar">).*?(<\/div>)/s',
		'$1' . $larger_avatar . '$2',
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block_core/post-author', 'siteorigin_snapshot_author_block' );


/**
 * Filters the post terms block content to replace the span element with a more semantic element.
 *
 * This function checks if the block has attributes and a prefix. If so, it allows replacing the
 * span element with a specified semantic element (h3, h4, h5, h6, or p). To which element is
 * used, you can filter the 'siteorigin_snapshot_post_terms_heading' hook. The default is h5.
 *
 * It also wraps the modified content in a div for styling purposes.
 *
 * @param string $block_content The original content of the block.
 * @param array $block The block's attributes and settings.
 *
 * @return string The modified block content with a more semantic element and additional div wrapper.
 */
function siteorigin_snapshot_post_terms_block( $block_content, $block ) {
	if (
		empty( $block_content ) ||
		empty( $block['attrs'] ) ||
		empty( $block['attrs']['prefix'] )
	) {
		return $block_content;
	}

	$allowed_elements = array( 'h3', 'h4', 'h5', 'h6', 'p' );
	$element = apply_filters( 'siteorigin_snapshot_post_terms_heading', 'h5' );

	// Ensure valid element.
	if ( empty( $element ) || ! in_array( $element, $allowed_elements, true ) ) {
		return $block_content;
	}

	// Replace span with more semantic element. Also prepend <div> for styling purposes.
	$block_content = preg_replace(
		'/<span class="wp-block-post-terms__prefix">(.+?)<\/span>/',
		"<$element class='wp-block-post-terms__prefix'>$1</$element>",
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block_core/post-terms', 'siteorigin_snapshot_post_terms_block', 10, 2 );

/**
 * Enhance avatar block resolution for high-DPI displays.
 *
 * Modifies core/avatar block output to load higher resolution images while 
 * maintaining original display dimensions. Doubles image resolution for 
 * crisp display on high-DPI screens.
 *
 * @param string $block_content The block content.
 * @param array  $block         The block data.
 * @return string Modified block content with enhanced avatar resolution.
 */
function siteorigin_snapshot_enhance_avatar_block_resolution( $block_content, $block ) {
	if ( 'core/avatar' !== $block['blockName'] ) {
		return $block_content;
	}

	// Extract the current size from the block attributes.
	$size = isset( $block['attrs']['size'] ) ? $block['attrs']['size'] : 96;
	$new_size = $size * 2; // Double for high resolution.

	// Handle Gravatar URLs.
	$block_content = preg_replace_callback(
		'/(https:\/\/[^\s]+gravatar\.com\/avatar[^\s]+\?[^"]*s=)(\d+)([^"]*")/',
		function( $matches ) use ( $new_size ) {
			return $matches[1] . $new_size . $matches[3];
		},
		$block_content
	);

	// Handle local WordPress uploads.
	$block_content = preg_replace_callback(
		'/src="([^"]+)-(\d+)x(\d+)(\.[^"]+)"/',
		function( $matches ) {
			$base_url  = $matches[1];
			$width     = (int) $matches[2];
			$height    = (int) $matches[3];
			$extension = $matches[4];

			$one_x_url = $base_url . '-' . $width . 'x' . $height . $extension; // original (1x)

			// First preference: exact 2× dimensions file, e.g. 64x64 for 32x32.
			$double_url = $base_url . '-' . ( $width * 2 ) . 'x' . ( $height * 2 ) . $extension;
			$original_url = $base_url . $extension;

			$upload_dir = wp_get_upload_dir();
			$double_path   = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $double_url );
			$original_path = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $original_url );

			$srcset_parts = array( esc_url( $one_x_url ) . ' 1x' );

			if ( file_exists( $double_path ) ) {
				$srcset_parts[] = esc_url( $double_url ) . ' 2x';
			}

			// Always include the unsuffixed original as a crisp fallback (browser will ignore if it 404s).
			$descriptor = in_array( esc_url( $double_url ) . ' 2x', $srcset_parts, true ) ? '3x' : '2x';
			$srcset_parts[] = esc_url( $original_url ) . ' ' . $descriptor;

			if ( count( $srcset_parts ) > 1 ) {
				return 'src="' . esc_url( $one_x_url ) . '" srcset="' . implode( ', ', $srcset_parts ) . '"';
			}

			return $matches[0];
		},
		$block_content
	);

	// Ensure the display dimensions remain as set by the user.
	$block_content = preg_replace(
		'/(<img[^>]+)width="\d+"\s*height="\d+"/',
		'$1width="' . $size . '" height="' . $size . '"',
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block', 'siteorigin_snapshot_enhance_avatar_block_resolution', 10, 2 );
