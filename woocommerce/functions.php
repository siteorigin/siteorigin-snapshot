<?php
/**
 * Theme support for WooCommerce.
 */
function siteorigin_snapshot_woocommerce_setup() {
	/*
	 * Add support for WooCommerce.
	 */
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'siteorigin_snapshot_woocommerce_setup' );

function siteorigin_snapshot_woocommerce_enqueue_editor_assets() {
	wp_enqueue_style(
		'siteorigin-snapshot-woocommerce',
		get_template_directory_uri() . '/css/woocommerce.css',
		array( 'woocommerce-blocktheme' ),
		1
	);
}
add_action( 'enqueue_block_assets', 'siteorigin_snapshot_woocommerce_enqueue_editor_assets', 10, 0 );
