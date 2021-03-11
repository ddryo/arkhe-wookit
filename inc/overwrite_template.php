<?php
/**
 * WooCommerceのテンプレートを上書きする
 */
namespace Arkhe_Woo;

defined( 'ABSPATH' ) || exit;

/**
 * WooCommerce用テンプレートファイルの読み込み
 */
add_filter( 'template_include', '\Arkhe_Woo\change_template', 20 );
function change_template( $template ) {

	// 商品アーカイブページ
	if ( is_shop() || is_product_taxonomy() ) {
		$template = ARKHE_WOO_PATH . 'woocommerce/archive-product.php';
	}

	// 商品ページ
	if ( is_product() ) {
		$template = ARKHE_WOO_PATH . 'woocommerce/single-product.php';
	}

	// if( is_cart() ) {}
	// if( is_checkout() ) {}

	return $template;
}


/**
 * テンプレートパーツのパスを上書き
 */
add_filter( 'wc_get_template', function( $template, $template_name ) {
	// 商品リストウィジェット
	if ( 'content-widget-product.php' === $template_name ) {
		return ARKHE_WOO_PATH . 'woocommerce/content-widget-product.php';
	} elseif ( 'loop/pagination.php' === $template_name ) {
		return ARKHE_WOO_PATH . 'woocommerce/pagination.php';
	}

	return $template;
}, 10, 2 );


/**
 * Arkheのサイドバーファイルを上書き
 */
add_filter( 'arkhe_pre_get_part__sidebar', function( $path ) {
	\Arkhe::$ex_parts_path = ARKHE_WOO_PATH;
} );
add_filter( 'arkhe_did_get_part__sidebar', function() {
	\Arkhe::$ex_parts_path = '';
} );
