<?php
/**
 * Title: Search form
 * Slug: wooblocks/search-form
 * Categories: wooblocks
 * Inserter: no
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:search
<?php
echo serialize_block_attributes( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Core serializer escapes JSON for block comments.
	array(
		'label'         => __( 'Search', 'wooblocks' ),
		'showLabel'     => true,
		'buttonText'    => __( 'Search', 'wooblocks' ),
		'buttonUseIcon' => true,
	)
);
?>
	/-->
