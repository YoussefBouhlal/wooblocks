<?php
/**
 * Title: Seasonal fashion hero
 * Slug: wooblocks/hero
 * Categories: wooblocks, featured
 * Viewport Width: 1440
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:cover {"dimRatio":30,"customOverlayColor":"#071a2c","isUserOverlayColor":true,"minHeight":640,"align":"full","className":"wooblocks-hero"} -->
<div class="wp-block-cover alignfull wooblocks-hero" style="min-height:640px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim" style="background-color:#071a2c"></span><div class="wp-block-cover__inner-container">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"align":"wide","className":"wooblocks-hero-copy","layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide wooblocks-hero-copy">
			<!-- wp:paragraph {"className":"wooblocks-script","fontFamily":"script"} --><p class="wooblocks-script has-script-font-family"><?php esc_html_e( 'Made for a modern muse', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"className":"wooblocks-hero-title"} --><h1 class="wp-block-heading wooblocks-hero-title"><?php esc_html_e( 'Step back into style', 'wooblocks' ); ?></h1><!-- /wp:heading -->
			<!-- wp:paragraph {"className":"wooblocks-hero-description"} --><p class="wooblocks-hero-description"><?php esc_html_e( 'Explore timeless pieces that blend classic elegance with a modern twist. Discover your perfect look.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( wooblocks_shop_url() ); ?>"><?php esc_html_e( 'Shop now', 'wooblocks' ); ?></a></div><!-- /wp:button -->
				<!-- wp:button {"className":"is-style-outline"} --><div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( wooblocks_category_url( 'new' ) ); ?>"><?php esc_html_e( 'New arrivals', 'wooblocks' ); ?></a></div><!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div></div>
<!-- /wp:cover -->
