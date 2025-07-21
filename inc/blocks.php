<?php
// This file contains general Block Editor changes.

require 'blocks/modifications.php';
require 'blocks/variations.php';

/**
 * Adds additional template part areas to the site editor.
 *
 * @param array $areas Existing template part areas defined by WordPress,
 * or other plugins/themes.
 * @return array Modified list of template part areas including the custom
 * ones added by this function.
 */
function siteorigin_template_part_areas( $areas ) {
	if ( ! is_array( $areas ) ) {
		$areas = array();
	}

	$areas[] = array(
		'area' => 'sidebar',
		'area_tag' => 'aside',
		'label' => __( 'Sidebar', 'siteorigin-snapshot' ),
		'description' => __( 'The Sidebar template part area is used by templates to display the sidebar.', 'siteorigin-snapshot' ),
		'icon' => 'sidebar',
	);

	$areas[] = array(
		'area' => 'content',
		'area_tag' => 'main',
		'label' => __( 'Content', 'siteorigin-snapshot' ),
		'description' => __( 'The Content template part area is used by other templates to display the main content of the page.', 'siteorigin-snapshot' ),
		'icon' => 'page',
	);

	return $areas;
}
add_filter( 'default_wp_template_part_areas', 'siteorigin_template_part_areas' );

/**
 * Ensure blocks have a class to identify them as a block. Used for styling purposes.
 *
 * @param string $block_content The content of the block.
 * @param array $block The block data.
 * @return string The modified block content.
 */
function siteorigin_snapshot_add_block_class( $block_content, $block ) {
	global $siteorigin_snapshot_blocks_to_class;

	$siteorigin_snapshot_blocks_to_class = apply_filters(
		'siteorigin_snapshot_blocks_to_class',
		array(
			'core/list' => array( 'ul', 'ol' ),
			'core/quote' => array( 'blockquote' ),
			'core/table' => array( 'table' ),
		)
	);

	if ( ! is_array( $siteorigin_snapshot_blocks_to_class ) ) {
		return $block_content;
	}

	if (
		array_key_exists(
			$block['blockName'],
			$siteorigin_snapshot_blocks_to_class
		)
	) {
		$tags = $siteorigin_snapshot_blocks_to_class[ $block['blockName'] ];
		foreach ( $tags as $tag ) {
			$block_content = str_replace( "<$tag>", "<$tag class='so-is-block'>", $block_content );
		}
	}

	return $block_content;
}
add_filter( 'render_block', 'siteorigin_snapshot_add_block_class', 10, 2 );
