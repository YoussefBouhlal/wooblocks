<?php
/**
 * Title: Shop by department
 * Slug: wooblocks/categories
 * Categories: wooblocks
 */

defined( 'ABSPATH' ) || exit;

$wooblocks_departments = array(
	'men'   => __( "Men's wear", 'wooblocks' ),
	'women' => __( "Women's wear", 'wooblocks' ),
	'kids'  => __( "Kids' wear", 'wooblocks' ),
);
?>
<!-- wp:group {"align":"wide","className":"wooblocks-section","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide wooblocks-section">
	<!-- wp:heading --><h2 class="wp-block-heading"><?php esc_html_e( 'Find your own rhythm', 'wooblocks' ); ?></h2><!-- /wp:heading -->
	<!-- wp:columns -->
	<div class="wp-block-columns">
		<?php foreach ( $wooblocks_departments as $wooblocks_slug => $wooblocks_label ) : ?>
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:cover {"dimRatio":20,"customOverlayColor":"#0f4f68","isUserOverlayColor":true,"minHeight":400,"className":"wooblocks-department"} -->
			<div class="wp-block-cover wooblocks-department" style="min-height:400px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-20 has-background-dim" style="background-color:#0f4f68"></span><div class="wp-block-cover__inner-container">
				<!-- wp:heading {"level":3} --><h3 class="wp-block-heading"><a href="<?php echo esc_url( wooblocks_category_url( $wooblocks_slug ) ); ?>"><?php echo esc_html( $wooblocks_label ); ?></a></h3><!-- /wp:heading -->
			</div></div>
			<!-- /wp:cover -->
		</div>
		<!-- /wp:column -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
