<?php
/**
 * Title: Customer account
 * Slug: wooblocks/account
 * Categories: wooblocks
 * Inserter: no
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<?php if ( class_exists( 'WooCommerce' ) ) : ?>
<!-- wp:shortcode -->[woocommerce_my_account]<!-- /wp:shortcode -->
<?php endif; ?>
