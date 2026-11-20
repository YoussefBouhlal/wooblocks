<?php
/**
 * Title: Storefront footer
 * Slug: wooblocks/footer
 * Categories: wooblocks
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","backgroundColor":"navy","className":"wooblocks-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull wooblocks-footer has-navy-background-color has-background">
	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"50%"} -->
		<div class="wp-block-column" style="flex-basis:50%">
			<!-- wp:heading {"fontSize":"x-large"} --><h2 class="wp-block-heading has-x-large-font-size"><?php esc_html_e( 'Timeless pieces. Modern spirit.', 'wooblocks' ); ?></h2><!-- /wp:heading -->
			<!-- wp:paragraph --><p><?php esc_html_e( 'Classic elegance with a modern twist. Discover your next favourite.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Explore', 'wooblocks' ); ?></h3><!-- /wp:heading -->
			<!-- wp:navigation {"overlayMenu":"never","ariaLabel":"<?php echo esc_attr__( 'Footer navigation', 'wooblocks' ); ?>","layout":{"type":"flex","orientation":"vertical"}} -->
				<!-- wp:page-list /-->
			<!-- /wp:navigation -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><?php esc_html_e( 'Stay inspired', 'wooblocks' ); ?></h3><!-- /wp:heading -->
			<!-- wp:paragraph --><p><?php esc_html_e( 'Good style goes beyond a single season.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:site-title {"level":0,"fontSize":"medium"} /-->
			<!-- wp:site-tagline /-->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
	<!-- wp:paragraph {"align":"center","className":"wooblocks-footer-wordmark","fontFamily":"display"} --><p class="has-text-align-center wooblocks-footer-wordmark has-display-font-family">WOOBLOCKS</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
