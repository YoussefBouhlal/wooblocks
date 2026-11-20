<?php
/**
 * Title: Seasonal collection promotion
 * Slug: wooblocks/promotion
 * Categories: wooblocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","className":"wooblocks-promotion","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull wooblocks-promotion">
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:paragraph --><p><?php esc_html_e( 'Your next favourite', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
		<!-- wp:heading --><h2 class="wp-block-heading"><?php esc_html_e( 'A fresh take on timeless style.', 'wooblocks' ); ?></h2><!-- /wp:heading -->
		<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"cream","textColor":"midnight"} --><div class="wp-block-button"><a class="wp-block-button__link has-midnight-color has-cream-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( wooblocks_shop_url() ); ?>"><?php esc_html_e( 'Find your favourites', 'wooblocks' ); ?></a></div><!-- /wp:button --></div><!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
