<?php
/**
 * Title: Live product catalog
 * Slug: wooblocks/catalog
 * Categories: wooblocks
 * Inserter: no
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:woocommerce/store-notices /-->
<!-- wp:woocommerce/breadcrumbs /-->
<!-- wp:query-title {"type":"<?php echo is_search() ? 'search' : 'archive'; ?>","showPrefix":false,"align":"wide"} /-->
<!-- wp:term-description {"align":"wide"} /-->
<!-- wp:woocommerce/product-collection {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"product","order":"asc","orderBy":"menu_order","inherit":true,"isProductCollectionBlock":true},"displayLayout":{"type":"flex","columns":3,"shrinkColumns":true},"align":"wide"} -->
<div class="wp-block-woocommerce-product-collection alignwide">
	<!-- wp:group {"className":"wooblocks-catalog-toolbar","layout":{"type":"flex","justifyContent":"space-between","flexWrap":"wrap"}} -->
	<div class="wp-block-group wooblocks-catalog-toolbar">
		<!-- wp:woocommerce/product-results-count /-->
		<!-- wp:woocommerce/catalog-sorting /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:woocommerce/product-template -->
		<!-- wp:woocommerce/product-image {"showSaleBadge":true,"isDescendentOfQueryLoop":true} /-->
		<!-- wp:post-title {"level":2,"isLink":true,"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->
		<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true} /-->
		<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true} /-->
	<!-- /wp:woocommerce/product-template -->
	<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
	<!-- wp:woocommerce/product-collection-no-results -->
		<!-- wp:paragraph --><p><?php esc_html_e( 'No products found. Try another search or browse a different category.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
	<!-- /wp:woocommerce/product-collection-no-results -->
</div>
<!-- /wp:woocommerce/product-collection -->
