<?php
namespace Arkhe_Woo;

defined( 'ABSPATH' ) || exit;

add_action( 'init', function() {
	if ( ! class_exists( 'Arkhe' ) ) return;
	\Arkhe::set_plugin_data( 'use_arkhe_wookit', true );
} );


/**
 * WooCommerce セットアップ
 */
add_action( 'after_setup_theme', '\Arkhe_Woo\woo_setup' );
function woo_setup() {
	add_theme_support( 'woocommerce', [
		'product_grid' => [
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 3,
			'min_columns'     => 2,
			'max_columns'     => 4,
		],
	] );

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
