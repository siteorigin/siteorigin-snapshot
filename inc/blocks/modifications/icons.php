<?php
/**
 * Icon modifications for core blocks.
 *
 * Contains functions that add or replace icons in various core WordPress blocks
 * including search, pagination, post date, and read more blocks.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Overrides the search icon in the core Search Block.
 *
 * @param string $block_content The content of the block.
 * @param array  $block         The block attributes.
 * @return string The modified block content.
 */
function siteorigin_snapshot_override_search_icon( $block_content, $block ) {
	// Ensure the Search Icon is enabled.
	if (
		empty( $block['attrs'] ) ||
		empty( $block['attrs']['buttonUseIcon'] )
	) {
		return $block_content;
	}

	$snapshot_icon = siteorigin_snapshot_display_icon( 'search', true );
	$block_content = preg_replace(
		'/<svg(.*?)<\/svg>/s',
		$snapshot_icon,
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block_core/search', 'siteorigin_snapshot_override_search_icon', 20, 2 );

/**
 * Adds a calendar icon to the post date block content.
 *
 * @param string $block_content The original block content.
 * @param array  $block         The block data.
 * @return string The modified block content.
 */
function siteorigin_snapshot_add_calendar_to_post_date( $block_content ) {
	$snapshot_icon = siteorigin_snapshot_display_icon( 'calendar', true );

	$block_content = preg_replace(
		'/<div class="wp-block-post-date">(.*)<\/div>/s',
		'<div class="wp-block-post-date">' . $snapshot_icon . '$1</div>',
		$block_content
	);

	return $block_content;
}
add_filter( 'render_block_core/post-date', 'siteorigin_snapshot_add_calendar_to_post_date', 20 );


/**
 * Modifies the previous query and comment pagination blocks by adding a left chevron icon.
 * It also removes the default arrow span for comments pagination blocks.
 *
 * @param string $block_content The original block content.
 * @param array $block The block details.
 *
 * @return string The modified block content.
 */
function siteorigin_snapshot_pagination_previous_block( $block_content, $block ) {
	$icon = siteorigin_snapshot_display_icon( 'chevron-left' );
	$block_content = preg_replace( '/(<a[^>]*>)/', '$1' . $icon, $block_content );

	// If this is a comments pagination block, remove the default arrow span.
	if ( $block['blockName'] === 'core/comments-pagination-previous' ) {
		$block_content = preg_replace( '/<span class=["\']wp-block-comments-pagination-previous-arrow.*?["\']>.*?<\/span>/', '', $block_content );
	}

	return $block_content;
}
add_filter( 'render_block_core/query-pagination-previous', 'siteorigin_snapshot_pagination_previous_block', 10, 2 );
add_filter( 'render_block_core/comments-pagination-previous', 'siteorigin_snapshot_pagination_previous_block', 10, 2 );

/**
 * Modifies the next query and comment pagination blocks by adding a right chevron icon.
 * It also removes the default arrow span for comments pagination blocks.
 *
 * @param string $block_content The original block content.
 * @param array $block The block details.
 *
 * @return string The modified block content.
 */
function siteorigin_snapshot_pagination_next_block( $block_content, $block ) {
	$icon = siteorigin_snapshot_display_icon( 'chevron-right' );
	$block_content = str_replace( '</a>', $icon . '</a>', $block_content );

	// If this is a comments pagination block, remove the default arrow span.
	if ( $block['blockName'] === 'core/comments-pagination-next' ) {
		$block_content = preg_replace( '/<span class=["\']wp-block-comments-pagination-next-arrow.*?["\']>.*?<\/span>/', '', $block_content );
	}

	return $block_content;
}
add_filter( 'render_block_core/query-pagination-next', 'siteorigin_snapshot_pagination_next_block', 10, 2 );
add_filter( 'render_block_core/comments-pagination-next', 'siteorigin_snapshot_pagination_next_block', 10, 2 );

/**
 * Modifies the Post Pagination Block by adding a left/right chevron icons.
 *
 * @param string $block_content The original block content.
 * @param array $block The block details.
 *
 * @return string The modified block content.
 */
function siteorigin_snapshot_pagination_post_navigation_link_block( $block_content ) {
	$left_icon = siteorigin_snapshot_display_icon( 'chevron-left' );
	$right_icon = siteorigin_snapshot_display_icon( 'chevron-right' );

	// Replace default icons.
	$block_content = preg_replace( '/<span class="[^"]*wp-block-post-navigation-link__arrow-previous[^"]*".*?>[^<]*<\/span>/', '', $block_content );

	$block_content = preg_replace( '/<span class="[^"]*wp-block-post-navigation-link__arrow-next[^"]*".*?>[^<]*<\/span>/', '', $block_content );

	// Add replacement icons.
	$block_content = preg_replace( '/(<a [^>]*rel="prev"[^>]*>)/', '$1' . $left_icon, $block_content );
	$block_content = preg_replace( '/(<a [^>]*rel="next"[^>]*>.*?)(<\/a>)/', '$1' . $right_icon . '$2', $block_content );

	return $block_content;
}
add_filter( 'render_block_core/post-navigation-link', 'siteorigin_snapshot_pagination_post_navigation_link_block', 10, 1 );

/**
 * Adds icon to the read more block.
 *
 * @param string $block_content The original block content.
 * @return string The modified block content.
 */
function siteorigin_snapshot_read_more_block( $block_content ) {
	$icon = siteorigin_snapshot_display_icon( 'chevron-right' );
	$block_content = str_replace( '</a>', $icon . '</a>', $block_content );
	return $block_content;
}
add_filter( 'render_block_core/read-more', 'siteorigin_snapshot_read_more_block' );
