<?php
namespace Arkhe_Woo;

defined( 'ABSPATH' ) || exit;

/**
 * ファイルの読み込み
 */
add_action( 'wp_enqueue_scripts', '\Arkhe_Woo\enqueue_front_scripts', 20 );
// add_action( 'admin_enqueue_scripts', '\Arkhe_Woo\enqueue_admin_scripts', 20 );


/**
 * フロントで読み込むファイル
 */
function enqueue_front_scripts() {
	wp_enqueue_style( 'arkhe-woo-front', ARKHE_WOO_URL . 'dist/css/front.css', [], ARKHE_WOO_VER );

	// Wooのページごとに読み込むファイル
	if ( is_cart() ) {
		wp_enqueue_style( 'arkhe-woo-cart', ARKHE_WOO_URL . 'dist/css/cart.css', [], ARKHE_WOO_VER );
	} elseif ( is_checkout() ) {
		wp_enqueue_style( 'arkhe-woo-checkout', ARKHE_WOO_URL . 'dist/css/checkout.css', [], ARKHE_WOO_VER );
	} elseif ( is_account_page() ) {
		wp_enqueue_style( 'arkhe-woo-mypage', ARKHE_WOO_URL . 'dist/css/mypage.css', [], ARKHE_WOO_VER );
	}
	// elseif ( is_shop() || is_product_taxonomy() ) {

	// } elseif ( is_product() ) {

	// }
}


/**
 * 管理画面で読み込むファイル
 */
function enqueue_admin_scripts( $hook_suffix ) {

	$is_arkhe_page = strpos( $hook_suffix, 'arkhe_woo' ) !== false;

	// Arkhe設定ページのみ
	// if ( $is_arkhe_page ) {
		wp_enqueue_style( 'arkhe-woo-admin', ARKHE_WOO_URL . 'dist/css/admin.css', [], ARKHE_WOO_VER );
	// 	wp_enqueue_script( 'arkhe-woo-admin', ARKHE_WOO_URL . 'dist/js/admin.js', ['jquery' ], ARKHE_WOO_VER, true );
	// }
}
