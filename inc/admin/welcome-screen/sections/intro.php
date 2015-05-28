<?php
/**
 * Welcome screen intro template
 *
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

global $archetype_version;
?>
<div class="col two-col" style="margin-bottom: 1.618em; overflow: hidden;">
	<div class="col-1">
		<h1 style="margin-right: 0;"><?php echo '<strong>Archetype</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $archetype_version ) . '</sup>'; ?></h1>

		<p style="font-size: 1.2em;"><?php _e( 'Welcome to Archetype! Where your websites functionality meets simplicity.', 'archetype' ); ?></p>
		<p><?php _e( 'Itching to sell your products online? Our integrated WooCommerce core will assist you in doing just that. With support for many popular WooCommerce extensions and a beautiful design, you\'re just a few clicks away from your own branded shop. Also, our point and click Customizer options, backed by an extremely extensible codebase, will leave you with nothing but an ear to ear smile.', 'archetype' ); ?>
	</div>

	<div class="col-2 last-feature">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="Storefront" class="image-50" width="440" />
	</div>
</div>
