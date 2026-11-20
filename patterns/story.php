<?php
/**
 * Title: Editorial story
 * Slug: wooblocks/story
 * Categories: wooblocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","className":"wooblocks-story","backgroundColor":"navy","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull wooblocks-story has-navy-background-color has-background">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:cover {"dimRatio":20,"customOverlayColor":"#0e3a56","isUserOverlayColor":true,"minHeight":520} -->
			<div class="wp-block-cover" style="min-height:520px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim" style="background-color:#0e3a56"></span><div class="wp-block-cover__inner-container">
				<!-- wp:paragraph {"align":"center","fontFamily":"script","fontSize":"x-large"} --><p class="has-text-align-center has-script-font-family has-x-large-font-size"><?php esc_html_e( 'Out now', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
			</div></div>
			<!-- /wp:cover -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center"} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:paragraph {"fontFamily":"script","fontSize":"x-large"} --><p class="has-script-font-family has-x-large-font-size"><?php esc_html_e( 'The introduction', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:heading --><h2 class="wp-block-heading"><?php esc_html_e( 'The essence of WooBlocks harmony', 'wooblocks' ); ?></h2><!-- /wp:heading -->
			<!-- wp:paragraph --><p><?php esc_html_e( 'Great style goes beyond a single season. Explore classic silhouettes, expressive colour, and a fresh perspective on everyday dressing.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( wooblocks_shop_url() ); ?>"><?php esc_html_e( 'Explore the collection', 'wooblocks' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
