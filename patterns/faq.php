<?php
/**
 * Title: Shopping questions
 * Slug: wooblocks/faq
 * Categories: wooblocks
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"wide","className":"wooblocks-section wooblocks-faq","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide wooblocks-section wooblocks-faq">
	<!-- wp:heading --><h2 class="wp-block-heading"><?php esc_html_e( 'A little more to know', 'wooblocks' ); ?></h2><!-- /wp:heading -->
	<!-- wp:details -->
	<details class="wp-block-details"><summary><?php esc_html_e( 'How do I place an order?', 'wooblocks' ); ?></summary><!-- wp:paragraph --><p><?php esc_html_e( 'Choose a product, select any available options, and add it to your cart. Continue to checkout to review your order before placing it.', 'wooblocks' ); ?></p><!-- /wp:paragraph --></details>
	<!-- /wp:details -->
	<!-- wp:details -->
	<details class="wp-block-details"><summary><?php esc_html_e( 'Where can I see delivery costs?', 'wooblocks' ); ?></summary><!-- wp:paragraph --><p><?php esc_html_e( 'Available delivery methods and costs are shown at checkout after you enter your address.', 'wooblocks' ); ?></p><!-- /wp:paragraph --></details>
	<!-- /wp:details -->
	<!-- wp:details -->
	<details class="wp-block-details"><summary><?php esc_html_e( 'Which payment methods can I use?', 'wooblocks' ); ?></summary><!-- wp:paragraph --><p><?php esc_html_e( 'Checkout shows the payment methods currently available for your order.', 'wooblocks' ); ?></p><!-- /wp:paragraph --></details>
	<!-- /wp:details -->
</div>
<!-- /wp:group -->
