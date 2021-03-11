<?php
namespace Arkhe_Woo;

defined( 'ABSPATH' ) || exit;


/**
 * 無駄なラッパー削除
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );


/**
 * 文言変更
 */
add_filter( 'woocommerce_product_add_to_cart_text', '\Arkhe_Woo\change_add_to_cart_text', 20 );
add_filter( 'woocommerce_product_single_add_to_cart_text', '\Arkhe_Woo\change_add_to_cart_text', 20 );
function change_add_to_cart_text( $text ) {
	if ( \Arkhe::$is_ja ) {
		return 'カートに入れる';
	}
	return $text;
}


/**
 * カートの削除ボタンのアイコンを差し替え
 */
add_filter( 'woocommerce_cart_item_remove_link', '\Arkhe_Woo\change_remove_btn', 20 );
function change_remove_btn( $link ) {
	$link = \str_replace( '&times;', '<i class="arkhe-icon-close"></i>', $link );
	return $link;
}


/**
 * 商品カテゴリーリストの件数を</a>の中に移動 & クラス名を arkhe に揃える
 */
add_filter( 'wp_list_categories', function ( $output ) {
	$output = preg_replace(
		'/<\/a>\s*<span[^>]*?>([^<]*?)<\/span>/s',
		'<span class="cat-post-count">$1</span></a>',
		$output
	);
	return $output;
} );


/**
 * 商品検索ウィジェット
 */
add_filter( 'get_product_search_form', function( $html ) {
	$html = str_replace( 'class="woocommerce-product-search"', 'class="woocommerce-product-search c-searchForm"', $html );
	$html = str_replace( 'class="search-field"', 'class="search-field c-searchForm__s"', $html );
	$html = preg_replace(
		'/<button([^>]*?)>[^<]*?<\/button>/s',
		'<button class="c-searchForm__submit u-flex--c"$1><i class="arkhe-icon-search" role="img" aria-hidden="true"></i></button>',
		$html
	);
	return $html;
} );


/**
 * Arkheのパンくずリストを非表示に
 */
add_filter( 'arkhe_breadcrumbs_position', function( $breadcrumbs_position ) {
	if ( is_product() || is_shop() || is_product_taxonomy() ) {
		$breadcrumbs_position = '';
	}
	return $breadcrumbs_position;
} );


/**
 * Arkheの固定ページタイトルの位置をコンテンツ内へ。
 */
add_filter( 'arkhe_is_show_ttltop', function( $is_show_ttltop ) {
	if ( is_cart() || is_checkout() || is_account_page() ) {
		$is_show_ttltop = false;
	}
	return $is_show_ttltop;
} );


/**
 * Wooのページネーションのフォーマットを上書き
 */
add_filter( 'woocommerce_pagination_args', function( $args ) {
	// array( // WPCS: XSS ok.
	// 	'base'      => $base,
	// 	'format'    => $format,
	// 	'add_args'  => false,
	// 	'current'   => max( 1, $current ),
	// 	'total'     => $total,
	// 	'prev_text' => '&larr;',
	// 	'next_text' => '&rarr;',
	// 	'type'      => 'list',
	// 	'end_size'  => 3,
	// 	'mid_size'  => 3,
	// )
	$args['type']   = 'list';
	$args['format'] = '';
	return $args;
} );
