<?php
/**
 * Navigation block modifications.
 *
 * Contains functions that modify the core navigation block functionality,
 * including custom mobile menu icons, submenu toggles, and menu behavior improvements.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Modifies the navigation block for the mobile menu.
 * - Replaces the default mobile menu icon.
 * - Removes the focus out event to handle it in theme.js.
 * - Adds custom icons for submenu toggles.
 *
 * @param string $block_content The original block content.
 * @param array  $block         The block attributes.
 * @return string The modified block content.
 */
function siteorigin_snapshot_alter_navigation_block( $block_content, $block ) {
	if (
		empty( $block_content ) ||
		empty( $block['attrs'] )
	) {
		return $block_content;
	}

	$icon_replacement = '';

	// Does the block contain a mobile menu icon?
	if ( ! isset( $block['attrs']['hasIcon'] ) ) {
		// Replace the default mobile menu icon.
		$icon_replacement = '<span class="screen-reader-text">' . esc_html( __( 'Menu', 'siteorigin-snapshot' ) ) . '></span>';

		// Is the user using the three line menu icon?
		if ( ! empty( $block['attrs']['icon'] ) ) {
			$icon_replacement .= '<span class="snapshot-mobile-middle-line"></span>';
		}
	} else {
		// Add class `snapshot-nav-text` to the mobile menu button to help with styling.
		$block_content = str_replace(
			'<nav class="',
			'<nav class="snapshot-nav-text-only ',
			$block_content
		);
	}

	// Remove default icons from the navigation block.
	$block_content = preg_replace( '/<svg[^>]+>.*?<\/svg>/s', $icon_replacement, $block_content );

	// Remove focus out event. This is handled by theme.js instead.
	$block_content = preg_replace( '/data-wp-on-async--focusout=".*?"/', '', $block_content );

	// Does this menu have any sub menus?
	if ( strpos( $block_content, 'wp-block-navigation__submenu-icon' ) === false ) {
		return $block_content;
	}

	$openSubmenusOnClick = ! empty( $block['attrs'] ) && ! empty( $block['attrs']['openSubmenusOnClick'] );

	siteorigin_snapshot_replace_menu_icons( $block_content, $openSubmenusOnClick );

	return $block_content;
}
add_filter( 'render_block_core/navigation', 'siteorigin_snapshot_alter_navigation_block', 99, 2 );

/**
 * Updates the submenu icons in navigation menus with custom icons.
 *
 * This function iterates through the block content to locate navigation menu
 * items. It then replaces the default icon for submenu toggle with a custom icon.
 * Icons are differentiated between top-level menu items and submenu items.
 *
 * The function accurately identifies the scope of each submenu toggle button
 * by mapping the start and end positions of `<ul>` tags. This ensures that
 * each submenu toggle is associated with the correct menu level and
 * receives the appropriate icon.
 *
 * @param string &$block_content The HTML content of the block, passed by reference. This content is modified to include the custom submenu icons.
 * @param bool $openSubmenusOnClick Whether submenus should open on click.
 *
 * @return void The function directly modifies the `$block_content` parameter.
 */
function siteorigin_snapshot_replace_menu_icons( &$block_content, $openSubmenusOnClick ) {

	// How we structure the replacement depends on whether submenus should open on click.
	if ( $openSubmenusOnClick ) {
		$block_content = preg_replace( '/<span class="wp-block-navigation__submenu-icon">.*?<\/span><\/span>/', '', $block_content );
		$replacement_structure = '$1$2%s$3';
	} else {
		$replacement_structure = '$1%s$2$3' . '</a>';
	}

	$icon_top_level = siteorigin_snapshot_display_icon( 'chevron-down' );
	$icon_submenu = siteorigin_snapshot_display_icon( 'chevron-right' );

	// Identifying whether a menu item is in a sub menu requires us to index the start/end of each ul tag. Then we match the button to the correct ul range.
	preg_match_all( '/<ul[^>]*class="([^"]*)"[^>]*>|<\/ul>/', $block_content, $ulMatches, PREG_OFFSET_CAPTURE );

	$all_menus = array();
	$current_menu = array();

	foreach ( $ulMatches[0] as $match ) {
		if ( strpos( $match[0], '</ul>' ) === false ) {
			// Opening <ul> tag
			$current_menu[] = $match;
		} else {
			// Closing </ul> tag, pop the last <ul> from the stack and record its scope.
			$start = array_pop( $current_menu );
			if ( $start ) {
				$all_menus[] = array(
					'start' => $start[1],
					// Include the length of </ul> to cover its full range.
					'end' => $match[1] + strlen( $match[0] ),
					'class' => $start[0],
				);
			}
		}
	}

	$button_regex = '/(<button[^>]*class="[^"]*wp-block-navigation-submenu__toggle[^"]*"[^>]*>)(.*?)(<\/button>)/s';

	preg_match_all( $button_regex, $block_content, $matches, PREG_OFFSET_CAPTURE );

	// Reverse the matches to maintain previously found positions.
	$matches = array_reverse( $matches[0] );
	// The offset is used to move the button and icon inside of the anchor.
	$anchor_offset = $openSubmenusOnClick ? 0 : 4;

	foreach ( $matches as $match ) {
		$submenu_toggle = $match[0];
		$submenu_toggle_position = $match[1] - $anchor_offset;

		// Find which menu this submenu toggle belongs to.
		foreach ( $all_menus as $submenu ) {
			if (
				$submenu_toggle_position > $submenu['start'] &&
				$submenu_toggle_position < $submenu['end']
			) {
				// Is this menu item in a sub menu?
				$toggle_icon = strpos( $submenu['class'], 'wp-block-navigation__submenu-container' ) !== false ? $icon_submenu : $icon_top_level;

				// Add the correct sub menu toggle icon.
				$new_submenu_toggle = preg_replace(
					$button_regex,
					sprintf( $replacement_structure, $toggle_icon ),
					$submenu_toggle
				);

				// Add the updated submenu toggle to the block content.
				$block_content = substr_replace(
					$block_content,
					$new_submenu_toggle,
					$submenu_toggle_position,
					strlen( $submenu_toggle ) + $anchor_offset
				);

				break;
			}
		}
	}
}
