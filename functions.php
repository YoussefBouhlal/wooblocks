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
 * Load native WooCommerce accessibility compatibility fixes.
 */
function wooblocks_enqueue_cart_focus() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$theme = wp_get_theme( get_template() );
	wp_enqueue_script( 'wooblocks-cart-focus', get_template_directory_uri() . '/assets/js/cart-focus.js', array(), $theme->get( 'Version' ), array( 'in_footer' => true ) );
	if ( is_product() ) {
		wp_enqueue_script( 'wooblocks-quantity-labels', get_template_directory_uri() . '/assets/js/quantity-labels.js', array(), $theme->get( 'Version' ), array( 'in_footer' => true ) );
		wp_enqueue_script( 'wooblocks-gallery-motion', get_template_directory_uri() . '/assets/js/gallery-motion.js', array( 'wc-single-product' ), $theme->get( 'Version' ), array( 'in_footer' => true ) );
	}
	if ( is_checkout() ) {
		wp_enqueue_script( 'wooblocks-payment-accessibility', get_template_directory_uri() . '/assets/js/payment-accessibility.js', array(), $theme->get( 'Version' ), array( 'in_footer' => true ) );
	}
}
add_action( 'wp_enqueue_scripts', 'wooblocks_enqueue_cart_focus' );

/**
 * Make the main landmark focusable by the native skip link.
 *
 * @param string $block_content Rendered block markup.
 * @param array  $block         Parsed block data.
 * @return string
 */
function wooblocks_skip_link_target( $block_content, $block ) {
	$is_main_group = 'core/group' === ( $block['blockName'] ?? '' ) && 'main' === ( $block['attrs']['tagName'] ?? '' );
	$is_product    = 'woocommerce/legacy-template' === ( $block['blockName'] ?? '' ) && 'single-product' === ( $block['attrs']['template'] ?? '' );
	if ( ! $is_main_group && ! $is_product ) {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );
	if ( $processor->next_tag( 'MAIN' ) && null === $processor->get_attribute( 'tabindex' ) ) {
		$processor->set_attribute( 'tabindex', '-1' );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block_core/group', 'wooblocks_skip_link_target', 10, 2 );
add_filter( 'render_block_woocommerce/legacy-template', 'wooblocks_skip_link_target', 10, 2 );

/**
 * Distinguish the shipped header and content search landmarks.
 *
 * @param string $block_content Rendered block markup.
 * @param array  $block         Parsed block data.
 * @return string
 */
function wooblocks_search_landmark( $block_content, $block ) {
	$classes = preg_split( '/\s+/', $block['attrs']['className'] ?? '' );
	if ( in_array( 'wooblocks-header-search', $classes, true ) ) {
		$label = 'product' === ( $block['attrs']['query']['post_type'] ?? '' ) ? __( 'Header product search', 'wooblocks' ) : __( 'Header site search', 'wooblocks' );
	} elseif ( in_array( 'wooblocks-content-search', $classes, true ) ) {
		$label = __( 'Site search', 'wooblocks' );
	} else {
		return $block_content;
	}

	$processor = new WP_HTML_Tag_Processor( $block_content );
	if ( $processor->next_tag( array( 'class_name' => 'wp-block-search' ) ) && null === $processor->get_attribute( 'aria-label' ) && null === $processor->get_attribute( 'aria-labelledby' ) ) {
		$processor->set_attribute( 'aria-label', $label );
	}

	return $processor->get_updated_html();
}
add_filter( 'render_block_core/search', 'wooblocks_search_landmark', 10, 2 );

/**
 * Render account shortcodes introduced after template shortcode processing.
 *
 * @param string $block_content Rendered block markup.
 * @param array  $block         Parsed block data.
 * @return string
 */
function wooblocks_render_account_shortcode( $block_content, $block ) {
	if ( '[woocommerce_my_account]' !== trim( $block['innerHTML'] ?? '' ) ) {
		return $block_content;
	}

	if ( ! shortcode_exists( 'woocommerce_my_account' ) ) {
		return '';
	}

	return do_shortcode( '[woocommerce_my_account]' );
}
add_filter( 'render_block_core/shortcode', 'wooblocks_render_account_shortcode', 10, 2 );

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
