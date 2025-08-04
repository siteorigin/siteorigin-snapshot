<?php
/**
 * Block variations and modifications.
 *
 * Contains functions that register block style variations for core WordPress blocks
 * and applies custom modifications like posts slider functionality and entry meta limits.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds block variations to specific core blocks.
 */
function siteorigin_snapshot_add_block_variations() {
	// Register "Unstyled" variations.
	// These are variations where we don't apply custom styling to them.
	register_block_style(
		'core/table',
		array(
			'name'         => 'unstyled',
			'label'        => __( 'Unstyled', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/tag-cloud',
		array(
			'name'         => 'unstyled',
			'label'        => __( 'Unstyled', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/latest-posts',
		array(
			'name'         => 'unstyled',
			'label'        => __( 'Unstyled', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/tag',
		array(
			'name'         => 'unstyled',
			'label'        => __( 'Unstyled', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/post_tag',
		array(
			'name'         => 'unstyled',
			'label'        => __( 'Unstyled', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/post-terms',
		array(
			'name'         => 'unstyled',
			'label'        => __( 'Unstyled', 'siteorigin-snapshot' ),
		)
	);

	// Register "Dark" and "Light" variations.
	register_block_style(
		'core/tag-cloud',
		array(
			'name'         => 'dark',
			'label'        => __( 'Dark', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/tag-cloud',
		array(
			'name'         => 'light',
			'label'        => __( 'Light', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'         => 'dark',
			'label'        => __( 'Dark', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/button',
		array(
			'name'         => 'light',
			'label'        => __( 'Light', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/read-more',
		array(
			'name'         => 'dark',
			'label'        => __( 'Dark', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/read-more',
		array(
			'name'         => 'light',
			'label'        => __( 'Light', 'siteorigin-snapshot' ),
		)
	);

	// Block Variations with styles.
	register_block_style(
		'core/button',
		array(
			'name'         => 'tag',
			'label'        => __( 'Tag', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/query',
		array(
			'name'         => 'posts-slider',
			'label'        => __( 'Posts Slider', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/query-title',
		array(
			'name'         => 'underline',
			'label'        => __( 'Underline', 'siteorigin-snapshot' ),
		)
	);

	register_block_style(
		'core/post-terms',
		array(
			'name'         => 'entry-meta',
			'label'        => __( 'Entry Meta', 'siteorigin-snapshot' ),
		)
	);
}
add_action( 'init', 'siteorigin_snapshot_add_block_variations' );

/**
 * Modifies the query block for posts slider style.
 *
 * @param string $block_content The original block content.
 * @param array  $block         The block attributes.
 * @return string The modified block content.
 */
function siteorigin_snapshot_posts_slider_block( $block_content, $block ) {
	if (
		empty( $block['attrs'] ) ||
		empty( $block['attrs']['className'] ) ||
		strpos( $block['attrs']['className'], 'is-style-posts-slider' ) === false
	) {
		return $block_content;
	}

	// Check if we've already processed this block.
	if ( strpos( $block_content, 'so-group-navigation' ) !== false ) {
		return $block_content;
	}

	add_filter( 'siteorigin_snapshot_remove_header_margin', '__return_true' );

	// Modify list items to add active and hidden classes.
	$block_content = preg_replace_callback(
		'/<li([^>]*)class="wp-block-post/',
		function ( $matches ) {
			static $first_match = true;

			if ( $first_match ) {
				// For the first match, we set it to active.
				$first_match = false;
				return '<li' . $matches[1] . 'class="wp-block-post" aria-current="true"';
			}

			// For the rest, we set them to hidden.
			return '<li' . $matches[1] . 'class="wp-block-post" aria-hidden="true';
		},
		$block_content
	);

	$total_posts = substr_count( $block_content, '<li' );

	// If there's only one post, we don't need to add pagination.
	if ( $total_posts === 1 ) {
		return $block_content;
	}

	// Add navigation arrows.
	$arrows = '<div class="so-group-navigation">';
	$arrows .= '<button class="so-group-prev"><span class="screen-reader-text">' . esc_html( __( 'Previous', 'siteorigin-snapshot' ) ) . '</span>' . siteorigin_snapshot_display_icon( 'chevron-left' ) . '</button>';
	$arrows .= '<button class="so-group-next"><span class="screen-reader-text">' . esc_html( __( 'Next', 'siteorigin-snapshot' ) ) . '</span>' . siteorigin_snapshot_display_icon( 'chevron-right' ) . '</button>';
	$arrows .= '</div>';

	// Add pagination.
	$page_number_nav = '<ol class="so-group-pagination-number">';

	for ( $i = 1; $i <= $total_posts; $i++ ) {
		$page_number_nav .= sprintf(
			'<li><button class="so-group-page" %s data-page="%d" aria-label="%s">%02d</button></li>',
			// Whether the slide is active.
			$i === 1 ? ' aria-current="true"' : '',
			// data-page.
			$i - 1,
			// Label.
			sprintf(
				esc_attr( __( 'Go to slide %d.', 'siteorigin-snapshot' ) ),
				$i
			),
			// Text.
			$i
		);
	}

	$page_number_nav .= '</ol>';

	$block_content = preg_replace(
		'/<\/div>(?!.*<\/div>)/s',
		$arrows . $page_number_nav . '$0',
		$block_content
	);

	wp_enqueue_script( 'siteorigin-snapshot-posts-slider' );
	wp_enqueue_style( 'siteorigin-snapshot-posts-slider' );

	return $block_content;
}
add_filter( 'render_block_core/query', 'siteorigin_snapshot_posts_slider_block', 10, 2 );

/**
 * Limits the number of terms displayed in the entry meta.
 *
 * @param string $block_content The original block content.
 * @param array  $block         The block attributes.
 * @return string The modified block content.
 */
function siteorigin_snapshot_limit_entry_meta_terms( $block_content, $block ) {
	if (
		empty( $block['attrs'] ) ||
		empty( $block['attrs']['className'] ) ||
		strpos( $block['attrs']['className'], 'is-style-entry-meta' ) === false
	) {
		return $block_content;
	}

	// Only output a single term.
	preg_match( '/(<a href="[^"]+" rel="tag">[^<]+?<\/a>)/', $block_content, $matches );

	if ( ! empty( $matches ) ) {
		$block_content = '<div class="taxonomy-category is-style-entry-meta wp-block-post-terms">' . $matches[1] . '</div>';
	}

	return $block_content;
}
add_filter( 'render_block_core/post-terms', 'siteorigin_snapshot_limit_entry_meta_terms', 10, 2 );
