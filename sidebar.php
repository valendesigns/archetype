<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Archetype
 */

/**
 * Filters the widget region ID for the sidebar.
 *
 * @since 1.0.0
 *
 * @param string $id The widget region ID for the sidebar.
 */
$id = apply_filters( 'archetype_sidebar_widget_region_id', 'sidebar-1' );

if ( ! is_active_sidebar( $id ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php do_action( 'archetype_sidebar' ); ?>
	<?php dynamic_sidebar( $id ); ?>
</aside><!-- #secondary -->
