<?php
/**
 * WooBlocks theme setup.
 *
 * @package WooBlocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme features and editor styles.
 */
function wooblocks_setup() {
	load_theme_textdomain( 'wooblocks', get_template_directory() . '/languages' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/storefront.css' );
	remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', 'wooblocks_setup' );

/**
 * Load the shared storefront stylesheet.
 */
function wooblocks_enqueue_styles() {
	$theme = wp_get_theme( get_template() );
	wp_enqueue_style( 'wooblocks-storefront', get_template_directory_uri() . '/assets/css/storefront.css', array(), $theme->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'wooblocks_enqueue_styles' );

/**
 * Group the editable storefront patterns.
 */
function wooblocks_register_pattern_category() {
	register_block_pattern_category( 'wooblocks', array( 'label' => __( 'WooBlocks storefront', 'wooblocks' ) ) );
}
add_action( 'init', 'wooblocks_register_pattern_category' );

/**
 * Resolve the configured shop without assuming a permalink structure.
 *
 * @return string Shop URL, or the homepage before store setup.
 */
function wooblocks_shop_url() {
	if ( function_exists( 'wc_get_page_id' ) && 0 < wc_get_page_id( 'shop' ) ) {
		return get_permalink( wc_get_page_id( 'shop' ) );
	}
	return home_url( '/' );
}

/**
 * Resolve an existing category, falling back to the configured shop.
 *
 * @param string $slug Product category slug.
 * @return string Category or shop URL.
 */
function wooblocks_category_url( $slug ) {
	if ( taxonomy_exists( 'product_cat' ) ) {
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $term ) {
			$url = get_term_link( $term );
			if ( ! is_wp_error( $url ) ) {
				return $url;
			}
		}
	}
	return wooblocks_shop_url();
}
