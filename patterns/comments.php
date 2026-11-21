<?php
/**
 * Title: Post comments
 * Slug: wooblocks/comments
 * Categories: wooblocks
 * Block Types: core/comments
 * Inserter: no
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:comments {"layout":{"type":"constrained"}} -->
<div class="wp-block-comments">
	<!-- wp:heading -->
	<h2 class="wp-block-heading"><?php esc_html_e( 'Comments', 'wooblocks' ); ?></h2>
	<!-- /wp:heading -->
	<!-- wp:comment-template -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"0.75rem","padding":{"top":"1rem","bottom":"1rem"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="padding-top:1rem;padding-bottom:1rem">
			<!-- wp:comment-author-name /-->
			<!-- wp:comment-date /-->
			<!-- wp:comment-content /-->
			<!-- wp:comment-reply-link /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:comment-template -->
	<!-- wp:comments-pagination {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
		<!-- wp:comments-pagination-previous /-->
		<!-- wp:comments-pagination-numbers /-->
		<!-- wp:comments-pagination-next /-->
	<!-- /wp:comments-pagination -->
	<!-- wp:post-comments-form /-->
</div>
<!-- /wp:comments -->
