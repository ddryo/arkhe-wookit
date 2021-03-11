<?php
/**
 * ウィジェット登録
 */
add_action( 'widgets_init', function () {
	register_sidebar( [
		'name'          => __( 'Sidebar for WooCommerce page', 'arkhe-wookit' ),
		'id'            => 'sidebar-ark-woo',
		'description'   => __( 'Widgets in this area will be displayed in the sidebar on the WooCommerce page.', 'arkhe-wookit' ) .
		' ( ' . __( 'If this widget area is empty, you will see the normal sidebar.', 'arkhe-wookit' ) . ' )',
		'before_widget' => '<div id="%1$s" class="c-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="c-widget__title -side">',
		'after_title'   => '</div>',
	] );
}, 20 );
