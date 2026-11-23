<?php
/**
 * Title: Page not found content
 * Slug: wooblocks/404-content
 * Categories: wooblocks
 * Inserter: no
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:heading {"level":1} --><h1 class="wp-block-heading"><?php esc_html_e( 'Page not found', 'wooblocks' ); ?></h1><!-- /wp:heading -->
<!-- wp:paragraph --><p><?php esc_html_e( 'That page is no longer here. Search for something else.', 'wooblocks' ); ?></p><!-- /wp:paragraph -->
<!-- wp:pattern {"slug":"wooblocks/search-form"} /-->
