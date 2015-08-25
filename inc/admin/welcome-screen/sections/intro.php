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
<div class="two-col" style="margin-bottom: 1.618em; overflow: hidden;">
	<div class="col">
		<h1 style="margin-right: 0;"><?php echo '<strong>Archetype</strong> <sup style="font-weight: bold; font-size: 50%; padding: 5px 10px; color: #666; background: #fff;">' . esc_attr( $archetype_version ) . '</sup>'; ?></h1>

		<p style="font-size: 1.2em;"><?php esc_html_e( 'Welcome to Archetype! You\'ve made a great choice.', 'archetype' ); ?></p>
		<p><?php esc_html_e( 'Archetype is more than just a beautiful blog! If you\'re wanting to setup shop, then our integrated WooCommerce core will assist you in doing just that. With support for many popular WooCommerce extensions and a beautiful design, you\'re just a few clicks away from your own branded online store.', 'archetype' ); ?></p>
		<p><?php esc_html_e( 'Also, our point and click Customizer options and extremely extensible codebase, will leave you with nothing but an ear to ear grin.', 'archetype' ); ?></p>
	</div>

	<div class="col screenshot-image">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.png'; ?>" alt="Archetype" />
	</div>
</div>
