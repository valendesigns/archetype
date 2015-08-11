<?php
/**
 * Archetype engine room
 *
 * @package Archetype
 * @subpackage Init
 * @since 1.0.0
 */

/**
 * Enqueue styles, register widget regions, etc.
 */
require get_template_directory() . '/inc/functions/setup.php';

/**
 * Functions used throughout the theme.
 */
require get_template_directory() . '/inc/functions/archive.php';
require get_template_directory() . '/inc/functions/chat.php';
require get_template_directory() . '/inc/functions/color.php';
require get_template_directory() . '/inc/functions/comments.php';
require get_template_directory() . '/inc/functions/entry.php';
require get_template_directory() . '/inc/functions/footer.php';
require get_template_directory() . '/inc/functions/header.php';
require get_template_directory() . '/inc/functions/homepage.php';
require get_template_directory() . '/inc/functions/hooks.php';
require get_template_directory() . '/inc/functions/image.php';
require get_template_directory() . '/inc/functions/navigation.php';
require get_template_directory() . '/inc/functions/page.php';
require get_template_directory() . '/inc/functions/post.php';
require get_template_directory() . '/inc/functions/schema.php';
require get_template_directory() . '/inc/functions/search.php';
require get_template_directory() . '/inc/functions/shortcode.php';
require get_template_directory() . '/inc/functions/social.php';
require get_template_directory() . '/inc/functions/taxonomy.php';
require get_template_directory() . '/inc/functions/template-tags.php';
require get_template_directory() . '/inc/functions/extras.php';

/**
 * Customizer additions.
 */
if ( is_archetype_customizer_enabled() ) {
	require get_template_directory() . '/inc/customizer/hooks.php';
	require get_template_directory() . '/inc/customizer/controls.php';
	require get_template_directory() . '/inc/customizer/display.php';
	require get_template_directory() . '/inc/customizer/functions.php';
	require get_template_directory() . '/inc/customizer/custom-header.php';
}

/**
 * Welcome screen
 */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
}

/**
 * Load OptionTree compatibility files.
 */
require get_template_directory() . '/inc/option-tree/hooks.php';
require get_template_directory() . '/inc/option-tree/meta-boxes.php';
require get_template_directory() . '/inc/option-tree/functions.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack/jetpack.php';

/**
 * Load WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
	require get_template_directory() . '/inc/woocommerce/controls.php';
	require get_template_directory() . '/inc/woocommerce/integrations.php';
}
