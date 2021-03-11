<?php
/**
 * The template for displaying product widget entries.
 *
 * </a>の位置を変えているだけ
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

// @phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<li class="woo-productList">
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

	<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="woo-productList__a">
		<?php echo $product->get_image(); ?>
		<div class="woo-productList__body">
			<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
			<?php if ( ! empty( $show_rating ) ) : ?>
				<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
			<?php endif; ?>
			<?php echo $product->get_price_html(); ?>
			<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
		</div>
	</a>
</li>
