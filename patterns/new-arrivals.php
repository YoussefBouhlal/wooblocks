<?php
/**
 * Title: New arrivals
 * Slug: wooblocks/new-arrivals
 * Categories: wooblocks
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"wide","className":"wooblocks-section","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide wooblocks-section">
	<!-- wp:paragraph {"textColor":"peach"} --><p class="has-peach-color has-text-color"><?php esc_html_e( 'New arrivals', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading"><?php esc_html_e( 'Fresh off the rail', 'wooblocks' ); ?></h2><!-- /wp:heading -->
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
	<!-- wp:woocommerce/product-collection {"queryId":1,"query":{"perPage":4,"pages":1,"offset":0,"postType":"product","order":"desc","orderBy":"date","inherit":false,"isProductCollectionBlock":true},"displayLayout":{"type":"flex","columns":4,"shrinkColumns":true},"collection":"woocommerce/product-collection/new-arrivals"} -->
	<div class="wp-block-woocommerce-product-collection">
		<!-- wp:woocommerce/product-template -->
			<!-- wp:woocommerce/product-image {"showSaleBadge":true,"isDescendentOfQueryLoop":true} /-->
			<!-- wp:post-title {"level":3,"isLink":true,"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->
			<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true} /-->
			<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true} /-->
		<!-- /wp:woocommerce/product-template -->
		<!-- wp:woocommerce/product-collection-no-results -->
			<!-- wp:paragraph --><p><?php esc_html_e( 'New pieces are on their way.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
		<!-- /wp:woocommerce/product-collection-no-results -->
	</div>
	<!-- /wp:woocommerce/product-collection -->
	<?php endif; ?>
</div>
<!-- /wp:group -->
