<?php
/**
 * Title: Storefront header
 * Slug: wooblocks/header
 * Categories: wooblocks
 * Block Types: core/template-part/header
 * Inserter: no
 */

defined( 'ABSPATH' ) || exit;

$wooblocks_categories = taxonomy_exists( 'product_cat' ) ? get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0, 'hide_empty' => true, 'number' => 6 ) ) : array();
?>
<!-- wp:group {"align":"full","className":"wooblocks-header","backgroundColor":"peach","textColor":"midnight","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull wooblocks-header has-midnight-color has-peach-background-color has-text-color has-background">
	<!-- wp:group {"align":"wide","className":"wooblocks-header-row","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide wooblocks-header-row">
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:site-logo {"width":48,"shouldSyncIcon":false} /-->
			<!-- wp:paragraph {"className":"wooblocks-wordmark","fontFamily":"display"} -->
			<p class="wooblocks-wordmark has-display-font-family"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">WooBlocks</a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:navigation {"overlayMenu":"mobile","openSubmenusOnClick":true,"ariaLabel":"<?php echo esc_attr__( 'Main navigation', 'wooblocks' ); ?>","layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:navigation-link <?php echo wp_json_encode( array( 'label' => __( 'Home', 'wooblocks' ), 'url' => home_url( '/' ), 'kind' => 'custom' ) ); ?> /-->
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<!-- wp:navigation-submenu <?php echo wp_json_encode( array( 'label' => __( 'Shop', 'wooblocks' ), 'url' => wooblocks_shop_url(), 'kind' => 'custom' ) ); ?> -->
				<!-- wp:navigation-link <?php echo wp_json_encode( array( 'label' => __( 'Shop all', 'wooblocks' ), 'url' => wooblocks_shop_url(), 'kind' => 'custom' ) ); ?> /-->
				<?php if ( ! is_wp_error( $wooblocks_categories ) ) : ?>
					<?php foreach ( $wooblocks_categories as $wooblocks_category ) : ?>
						<!-- wp:navigation-link <?php echo wp_json_encode( array( 'label' => $wooblocks_category->name, 'url' => wooblocks_category_url( $wooblocks_category->slug ), 'kind' => 'taxonomy', 'type' => 'product_cat', 'id' => $wooblocks_category->term_id ), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT ); ?> /-->
					<?php endforeach; ?>
				<?php endif; ?>
			<!-- /wp:navigation-submenu -->
				<?php if ( function_exists( 'wc_get_page_id' ) && function_exists( 'wc_get_page_permalink' ) && 0 < wc_get_page_id( 'myaccount' ) ) : ?>
			<!-- wp:navigation-link <?php echo wp_json_encode( array( 'label' => __( 'My account', 'wooblocks' ), 'url' => wc_get_page_permalink( 'myaccount' ), 'kind' => 'custom' ) ); ?> /-->
				<?php endif; ?>
			<?php endif; ?>
		<!-- /wp:navigation -->
		<!-- wp:group {"className":"wooblocks-header-actions","layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group wooblocks-header-actions">
			<!-- wp:search {"label":"<?php echo esc_attr__( 'Search', 'wooblocks' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Search', 'wooblocks' ); ?>","buttonText":"<?php echo esc_attr__( 'Search', 'wooblocks' ); ?>","buttonUseIcon":true,"buttonPosition":"button-inside","query":<?php echo wp_json_encode( class_exists( 'WooCommerce' ) ? array( 'post_type' => 'product' ) : new stdClass() ); ?>} /-->
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<!-- wp:woocommerce/mini-cart {"miniCartIcon":"bag","addToCartBehaviour":"open_drawer"} /-->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
