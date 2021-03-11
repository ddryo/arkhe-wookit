<?php
/**
 * woocommerceページ専用サイドバー
 */

$is_woo_page = function_exists( 'is_woocommerce' ) && is_woocommerce();

if ( $is_woo_page && is_active_sidebar( 'sidebar-ark-woo' ) ) {
	dynamic_sidebar( 'sidebar-ark-woo' );
} elseif ( is_active_sidebar( 'sidebar-1' ) ) {
	dynamic_sidebar( 'sidebar-1' ); // Arkheの通常サイドバー
}
