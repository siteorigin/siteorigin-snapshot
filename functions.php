<?php
/**
 * SiteOrigin Snapshot functions and definitions.
 *
 * This file contains the main theme setup functions, enqueuing scripts and styles,
 * and includes necessary theme components for block editor support and customizations.
 *
 * @link https://siteorigin.com/theme/snapshot/
 *
 * @package siteorigin-snapshot
 * @since 1.0
 *
 * IMPORTANT NOTICE: Please don't edit this file; any changes made here will be lost during the theme update process.
 * If you need to add custom functions, use Code Snippets (https://wordpress.org/plugins/code-snippets/), or a child theme.
 */

if ( ! function_exists( 'siteorigin_snapshot_setup' ) ) {
	function siteorigin_snapshot_setup() {
		load_theme_textdomain( 'siteorigin-snapshot', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'wp-block-styles' );

		add_filter( 'should_load_remote_block_patterns', '__return_false' );

		add_theme_support(
			'html5',
			array(
				'caption',
				'comment-form',
				'comment-list',
				'gallery',
				'navigation-widgets',
				'script',
				'search-form',
				'style',
				'widgets',
			)
		);

		add_editor_style( 'style.css' );

		add_theme_support(
			'custom-background',
			apply_filters(
				'siteorigin_snapshot_custom_background_args',
				array(
					'default-color' => '#ffffff',
					'default-image' => '',
				)
			)
		);

		register_nav_menus(
			array(
				'header' => esc_html__( 'Header Menu', 'siteorigin-snapshot' ),
			)
		);

		// Adjust content width for classic usage.
		$GLOBALS['content_width'] = apply_filters( 'siteorigin_snapshot_content_width', 1128 );
	}
}
add_action( 'after_setup_theme', 'siteorigin_snapshot_setup' );

function siteorigin_snapshot_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'siteorigin-snapshot' ),
			'id'            => 'sidebar-main',
			'description'   => esc_html__( 'Visible on posts and pages that use the Default or Full Width, With Sidebar layout.', 'siteorigin-snapshot' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'siteorigin-snapshot' ),
			'id'            => 'sidebar-footer',
			'description'   => esc_html__( 'A column will be automatically assigned to each widget inserted', 'siteorigin-snapshot' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

	if ( function_exists( 'is_woocommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Shop', 'siteorigin-snapshot' ),
				'id'            => 'shop-sidebar',
				'description'   => esc_html__( 'Displays on WooCommerce pages.', 'siteorigin-snapshot' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'siteorigin_snapshot_widgets_init' );

function siteorigin_snapshot_register_scripts() {
	wp_register_style(
		'siteorigin-snapshot-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_register_script(
		'siteorigin-snapshot-script',
		get_template_directory_uri() . '/js/theme.js',
		array( 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_localize_script(
		'siteorigin-snapshot-script',
		'siteoriginSnapshot',
		array(
			// Aria labels.
			'menu' => array(
				'open' => esc_html__( 'Open Menu', 'siteorigin-snapshot' ),
				'close' => esc_html__( 'Close Menu', 'siteorigin-snapshot' ),
				'btnOpenText' => esc_html__( 'Menu', 'siteorigin-snapshot' ),
				'btnCloseText' => esc_html__( 'Close', 'siteorigin-snapshot' ),
			),
			'lightbox' => array(
				'previous' => esc_html__( 'Next image', 'siteorigin-snapshot' ),
				'prev' => esc_html__( 'Previous image', 'siteorigin-snapshot' ),
				'goTo' => esc_html__( 'Go to image %s', 'siteorigin-snapshot' ),
			),
			'posts_slider' => array(
				'current' => esc_html__( 'Current Slide', 'siteorigin-snapshot' ),
			),
		)
	);

	// Lightbox customizations for the core Image Block.
	wp_register_script(
		'siteorigin-snapshot-lightbox',
		get_template_directory_uri() . '/js/lightbox.js',
		array( 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_register_style(
		'siteorigin-snapshot-lightbox',
		get_template_directory_uri() . '/css/lightbox.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Posts Slider.
	wp_register_script(
		'siteorigin-snapshot-posts-slider',
		get_template_directory_uri() . '/js/posts-slider.js',
		array( 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_register_style(
		'siteorigin-snapshot-posts-slider',
		get_template_directory_uri() . '/css/posts-slider.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'init', 'siteorigin_snapshot_register_scripts' );

function siteorigin_snapshot_enqueue_assets() {
	// Don't let this load in the Block/Site Editor.
	if ( is_admin() ) {
		return;
	}

	wp_enqueue_style( 'siteorigin-snapshot-style' );
	wp_enqueue_script( 'siteorigin-snapshot-script' );
}
add_action( 'wp_enqueue_scripts', 'siteorigin_snapshot_enqueue_assets' );

function siteorigin_snapshot_enqueue_editor_assets() {
	if ( ! is_admin() ) {
		return;
	}

	// Editor specific.
	wp_enqueue_script(
		'siteorigin-snapshot-editor-script',
		get_template_directory_uri() . '/js/editor.js',
		array( 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);

	wp_enqueue_style(
		'siteorigin-snapshot-admin',
		get_template_directory_uri() . '/css/admin.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Load the rest.
	wp_enqueue_style( 'siteorigin-snapshot-style' );
	wp_enqueue_script( 'siteorigin-snapshot-script' );
	wp_enqueue_script( 'siteorigin-snapshot-lightbox' );
	wp_enqueue_style( 'siteorigin-snapshot-lightbox' );
	wp_enqueue_script( 'siteorigin-snapshot-posts-slider' );
	wp_enqueue_style( 'siteorigin-snapshot-posts-slider' );
}
add_action( 'enqueue_block_assets', 'siteorigin_snapshot_enqueue_editor_assets' );


function siteorigin_snapshot_viewport_tag() {
	?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
}
add_action( 'wp_head', 'siteorigin_snapshot_viewport_tag' );


require get_template_directory() . '/inc/blocks.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/template-tags.php';
if ( function_exists( 'is_woocommerce' ) ) {
	require get_template_directory() . '/woocommerce/functions.php';
}

/*
IMPORTANT NOTICE: Please don't edit this file; any changes made here will be lost during the theme update process.
If you need to add custom functions, use Code Snippets (https://wordpress.org/plugins/code-snippets/), or a child theme.
*/
