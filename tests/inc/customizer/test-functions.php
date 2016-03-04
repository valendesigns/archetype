<?php
/**
 * Test Customizer functions.
 *
 * @package Archetype
 * @group customizer
 */

class Tests_Customizer_Functions extends WP_UnitTestCase {

	/**
	 * Loads the Customizer styles.
	 */
	function test_archetype_customize_css() {

		archetype_customize_css();
		$this->assertTrue( wp_style_is( 'archetype-customize' ) );

	}

	/**
	 * Loads the Customizer scripts.
	 */
	function test_archetype_customize_js() {

		archetype_customize_js();
		$this->assertTrue( wp_script_is( 'archetype-customize' ) );

	}

	/**
	 * Alerts Customizer errors.
	 */
	function test_archetype_customize_print_js() {
		global $customize_error;

		$customize_error = __( 'Error!' );

		ob_start();
		archetype_customize_print_js();
		$buffer = ob_get_contents();
		ob_end_clean();

		$this->assertEquals( '<script> alert("Error!"); </script>', $buffer );

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	function test_archetype_customize_preview_js() {

		archetype_customize_preview_js();
		$this->assertTrue( wp_script_is( 'archetype-customize-preview' ) );

	}

	/**
	 * Check that emoji's are removed.
	 */
	function test_archetype_emojis() {

		$this->assertEquals( 7, has_action( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertEquals( 10, has_action( 'admin_print_scripts', 'print_emoji_detection_script' ) );
		$this->assertEquals( 10, has_action( 'wp_print_styles', 'print_emoji_styles' ) );
		$this->assertEquals( 10, has_action( 'admin_print_styles', 'print_emoji_styles' ) );

		add_filter( 'archetype_default_no_emoji', '__return_true' );
		archetype_emojis();

		$this->assertFalse( has_action( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_action( 'admin_print_scripts', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_action( 'wp_print_styles', 'print_emoji_styles' ) );
		$this->assertFalse( has_action( 'admin_print_styles', 'print_emoji_styles' ) );

	}

	/**
	 * Adds the json mime type.
	 */
	function test_archetype_json_mime() {

		$mimes = array(
			'svg'  => 'image/svg+xml'
		);
		
		$expected = array(
			'svg'  => 'image/svg+xml',
			'json' => 'application/json',
		);

		$this->assertSame( $expected, archetype_json_mime( $mimes ) );

	}

	/**
	 * Adds the svg mime type.
	 */
	function test_archetype_svg_mime() {

		$mimes = array(
			'json' => 'application/json'
		);

		$expected = array(
			'json' => 'application/json',
			'svg'  => 'image/svg+xml',
		);

		$this->assertSame( $expected, archetype_svg_mime( $mimes ) );

	}

	/**
	 * Filter the site logo and add the SVG version
	 */
	function test_archetype_site_logo_svg() {

		$input    = '<a href="file.html"><img src="image.png"/></a>';
		$expected = '<a href="file.html"><img src="image.png"/><span class="svg-site-logo"></span></a>';
		$output   = archetype_site_logo_svg( $input, '', '' );

		$this->assertEquals( $expected, $output );

	}

	/**
	 * Returns the logo URL in the customizer
	 */
	function test_archetype_get_logo_url() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Filters the Primary Navigation's CSS classes.
	 */
	function test_archetype_get_primary_navigation_classes() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Displays Site Branding in the footer.
	 */
	function test_archetype_site_info_footer_branding() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Filters the site info styles array.
	 */
	function test_archetype_get_site_info_styles() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Filters the site footer styles array.
	 */
	function test_archetype_get_site_footer_styles() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Builds the background styles array.
	 */
	function test_archetype_get_background_styles() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Initiate import & export.
	 */
	function test_archetype_tools_init() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Exports customizer theme mods.
	 */
	function test_archetype_export_mods() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Imports uploaded mods and calls WordPress core customize_save actions so
	 * themes that hook into them can act before mods are saved to the database.
	 */
	function test_archetype_import_mods() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Imports customizer images.
	 */
	function test_archetype_import_mod_images() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Sideloads an image in the customizer during import
	 */
	function test_valid_sideload_image_by_width_and_height() {

		$file = 'http://valendesigns.com/images/logo.png';
		$data = archetype_sideload_image( $file );
		$this->assertSame( 44, $data->height );
		$this->assertSame( 187, $data->width );

	}

	function test_invalid_sideload_image_bad_extension() {

		$file = 'http://google.com/this-got-to-be-invalid.exe';
		$data = archetype_sideload_image( $file );
		$this->assertFalse( $data );

	}

	function test_invalid_sideload_image_bad_relative_url() {

		$file = 'invalid.png';
		$data = archetype_sideload_image( $file );
		$this->assertTrue( is_wp_error( $data ) );

	}

	function test_invalid_sideload_image_does_not_exists() {

		$file = 'http://google.com/this-got-to-be-invalid.png';
		$data = archetype_sideload_image( $file );
		$this->assertTrue( is_wp_error( $data ) );
		$this->assertSame( 'Not Found', $data->get_error_message() );

	}

	/**
	 * Check if the file extention is a valid image mime type.
	 */
	function test_archetype_is_image_url() {

		$this->assertTrue( archetype_is_image_url( 'file.jpg' ) );
		$this->assertTrue( archetype_is_image_url( 'file.jpe' ) );
		$this->assertTrue( archetype_is_image_url( 'file.jpeg' ) );
		$this->assertTrue( archetype_is_image_url( 'file.gif' ) );
		$this->assertTrue( archetype_is_image_url( 'file.png' ) );
		$this->assertTrue( archetype_is_image_url( 'file.bmp' ) );
		$this->assertTrue( archetype_is_image_url( 'file.tif' ) );
		$this->assertTrue( archetype_is_image_url( 'file.tiff' ) );
		$this->assertTrue( archetype_is_image_url( 'file.ico' ) );
		$this->assertTrue( archetype_is_image_url( 'file.svg' ) );
		
		$this->assertFalse( archetype_is_image_url( 'file.mp3' ) );
		$this->assertFalse( archetype_is_image_url( 'file.jpg.mp3' ) );

	}

	/**
	 * Sanitizes the import/export control value.
	 */
	function test_archetype_sanitize_import_export() {

		$this->assertFalse( archetype_sanitize_import_export() );

	}

	/**
	 * Sanitizes an integer value.
	 */
	function test_archetype_sanitize_integer() {

		$setting = new stdClass();
		$setting->default = 1;

		$this->assertEquals( false, archetype_sanitize_integer( 'help' ) );
		$this->assertEquals( 1, archetype_sanitize_integer( 'help', $setting ) );
		$this->assertEquals( 1, archetype_sanitize_integer( '-1' ) );
		$this->assertEquals( 1, archetype_sanitize_integer( -1 ) );
		$this->assertEquals( 1, archetype_sanitize_integer( '1' ) );
		$this->assertEquals( 1, archetype_sanitize_integer( 1 ) );

	}

	/**
	 * Sanitizes an integer value or return empty.
	 */
	function test_archetype_sanitize_number() {

		$setting = new stdClass();
		$setting->default = '10';

		$this->assertEquals( 0, archetype_sanitize_number( 'help' ) );
		$this->assertEquals( 10, archetype_sanitize_number( 'help', $setting ) );
		$this->assertEquals( -1, archetype_sanitize_number( '-1' ) );
		$this->assertEquals( 1, archetype_sanitize_number( '1' ) );

	}

	/**
	 * Sanitizes a checkbox value.
	 */
	function test_archetype_sanitize_checkbox() {

		// Falsey.
		$this->assertFalse( archetype_sanitize_checkbox( '' ) );
		$this->assertFalse( archetype_sanitize_checkbox( '0' ) );
		$this->assertFalse( archetype_sanitize_checkbox( 0 ) );
		$this->assertFalse( archetype_sanitize_checkbox( false ) );

		// True.
		$this->assertTrue( archetype_sanitize_checkbox( 'any-value' ) );
		$this->assertTrue( archetype_sanitize_checkbox( 'false' ) );
		$this->assertTrue( archetype_sanitize_checkbox( '1' ) );
		$this->assertTrue( archetype_sanitize_checkbox( 1 ) );
		$this->assertTrue( archetype_sanitize_checkbox( 'true' ) );
		$this->assertTrue( archetype_sanitize_checkbox( true ) );

	}
	
	/**
	 * Sanitizes an image value.
	 */
	function test_archetype_sanitize_image() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Sanitizes a URL value.
	 */
	function test_archetype_sanitize_url() {

		$this->assertEquals( 'http://sample.org/image.jpg', archetype_sanitize_url( 'sample.org/image.jpg' ) );
		$this->assertEquals( '//sample.org/image.jpg', archetype_sanitize_url( '//sample.org/image.jpg' ) );

	}

	/**
	 * Sanitizes an HTML value.
	 */
	function test_archetype_sanitize_html() {

		$this->assertEquals( 'Hello', archetype_sanitize_html( '<script>Hello</script>' ) );

	}

	/**
	 * Sanitizes a hex color. Identical to core's sanitize_hex_color(), which is not available on the wp_head hook.
	 */
	function test_archetype_sanitize_hex_color() {

		$this->assertEquals( '#000', archetype_sanitize_hex_color( '#000' ) );
		$this->assertEquals( '#000000', archetype_sanitize_hex_color( '#000000' ) );
		$this->assertEquals( '', archetype_sanitize_hex_color( '#0000' ) );
		$this->assertEquals( '', archetype_sanitize_hex_color( '' ) );
		$this->assertEquals( null, archetype_sanitize_hex_color( 'undefined' ) );

	}

	/**
	 * Sanitizes choices (selects / radios)
	 */
	function test_archetype_sanitize_choices() {

		$this->markTestIncomplete( 'This test has not been implemented.' );

	}

	/**
	 * Sanitizes the layout setting
	 */
	function test_archetype_sanitize_layout() {

		$this->assertEquals( 'left', archetype_sanitize_layout( 'left' ) );
		$this->assertEquals( '', archetype_sanitize_layout( 'wrong' ) );

	}

	/**
	 * Layout classes
	 */
	function test_archetype_layout_class() {

		$this->assertEquals( array( 'right-sidebar' ), archetype_layout_class( array() ) );

	}

	/**
	 * Adjust a hex color brightness
	 */
	function test_archetype_adjust_color_brightness() {

		$this->assertEquals( '#616161', archetype_adjust_color_brightness( '#666', -5 ) );

	}

}
