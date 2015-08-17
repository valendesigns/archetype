<?php
/**
 * Arbitrary control classes.
 *
 * @package Archetype
 * @subpackage Customize
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Archetype_Component_Order' ) ) :

	/**
	 * Class to manipulate the component order.
	 *
	 * @since 1.0.0
	 */
	final class Archetype_Component_Order {

		/**
		 * The single class instance.
		 *
		 * @since 1.0.0
		 * @access private
		 *
		 * @var object
		 */
		private static $_instance = null;

		/**
		 * Main Archetype_Component_Order Instance
		 *
		 * Ensures only one instance of this class exists in memory at any one time.
		 *
		 * @see archetype_component_order()
		 * @uses Archetype_Component_Order::init_actions() Setup hooks and actions.
		 *
		 * @since 1.0.0
		 * @static
		 * @return object The one true Archetype_Component_Order.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init_actions();
			}
			return self::$_instance;
		}

		/**
		 * A dummy constructor to prevent this class from being loaded more than once.
		 *
		 * @see Archetype_Component_Order::instance()
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function __construct() {
			/* We do nothing here! */
		}

		/**
		 * You cannort cloning this class.
		 *
		 * @since 1.0.0
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'archetype' ), '1.0.0' );
		}

		/**
		 * You cannot unserialize instances of this class.
		 *
		 * @since 1.0.0
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'archetype' ), '1.0.0' );
		}

		/**
		 * Setup the hooks, actions and filters.
		 *
		 * @uses add_action() To add actions.
		 *
		 * @since 1.0.0
		 * @access private
		 */
		private function init_actions() {
			// Manipulate the hooks very early.
			add_action( 'wp_loaded', array( $this, 'manipulate_hooks' ), 10 );

			// Filter the body classes & manipulate just in time hooks.
			add_action( 'body_class', array( $this, 'body_class' ), 10 );

			// Register the controls.
			add_action( 'archetype_customize_register', array( $this, 'customize_register' ),  11 );

			// Add customizer CSS styles.
			add_action( 'archetype_add_customize_css', array( $this, 'customize_css' ), 10 );

			// Order the components.
			add_action( 'get_header', array( $this, 'component_order' ), 10 );

			// Filter the component with hidden toggles.
			add_action( 'archetype_component_order_hide_toggles', array( $this, 'hide_toggles' ), 10 );
		}

		/**
		 * Manipulate the hooks.
		 *
		 * We need to hook early before other code is executed. Otherwise, the global `$wp_filter`
		 * used in Archetype_Component_Order::get_control_choices does not contain our hooks. Which
		 * causes certain items to be doubled, or not allow the order to be modified with drag & drop.
		 * This is not elegant and should be looked into for a better solution.
		 *
		 * @since 1.0.0
		 */
		function manipulate_hooks() {
			// Header layout.
			$header_layout = get_theme_mod( 'archetype_header_layout', 'version-1' );

			// Add our hook to change the secondary navigation.
			if ( 'version-2' === $header_layout ) {
				add_action( 'archetype_header', 'archetype_secondary_navigation', 15 );
			}
		}

		/**
		 * Filter the body classes & manipulate just in time hooks.
		 *
		 * @since 1.0.0
		 *
		 * @param  array $classes Array of body classes.
		 * @return array $classes Modified array of classes.
		 */
		function body_class( $classes ) {
			// Header layout.
			$header_layout = get_theme_mod( 'archetype_header_layout', 'version-1' );

			// Just in time to re-hook during preview when a different header is currently active.
			if ( is_customize_preview() && 'version-1' === $header_layout ) {
				add_action( 'archetype_site_header', 'archetype_secondary_navigation', 20 );
			}

			/*
			 * Add alternative header class and remove navigation from the `archetype_site_header` hook.
			 * The navigation is added earlier in Archetype_Component_Order::manipulate_hooks.
			 */
			if ( 'version-2' === $header_layout ) {
				remove_action( 'archetype_site_header', 'archetype_secondary_navigation', 20 );
				$classes[] = 'archetype-site-header-alt';
			}

			return $classes;
		}

		/**
		 * Add section, setting and load custom customizer control.
		 *
		 * @since 1.0.0
		 *
		 * @param object $wp_customize The customizer object.
		 */
		public function customize_register( $wp_customize ) {
			require_once dirname( __FILE__ ) . '/controls/component-order.php';

			foreach ( (array) $this->get_controls() as $key => $section ) {
				if ( isset( $section['id'] ) && ! is_object( $wp_customize->get_section( $section['id'] ) ) ) {
					$wp_customize->add_section( $section['id'], array(
						'title'       => ( isset( $section['title'] ) ? $section['title'] : __( 'Component Order', 'archetype' ) ),
						'priority'    => ( isset( $section['priority'] ) ? $section['priority'] : 1 ),
						'panel'       => ( isset( $section['panel'] ) ? $section['panel'] : '' ),
					) );
				}

				if ( ! empty( $section['controls'] ) ) {
					foreach ( (array) $section['controls'] as $key => $control ) {
						$wp_customize->add_setting( $control['id'], array(
							'default'           => $this->get_control_default( $control['hook'], $control['id'] ),
							'sanitize_callback'	=> array( $this, 'sanitize_components' ),
							'capability'        => 'edit_theme_options',
						) );

						$wp_customize->add_control( new Archetype_Component_Order_Customizer_Control( $wp_customize, $control['id'], array(
							'label'       => ( isset( $control['label'] ) ? $control['label'] : '' ),
							'description' => $control['description'],
							'section'     => $section['id'],
							'settings'    => $control['id'],
							'choices'     => $this->get_control_choices( $control['hook'], $control['id'] ),
							'priority'    => 10,
							'toggle'      => ( isset( $control['toggle'] ) ? $control['toggle'] : '' ),
						) ) );
					}
				}
			}
		}

		/**
		 * Add CSS in <head> for styles handled by the theme customizer
		 *
		 * @since 1.0.0
		 *
		 * @param string $style The customizer CSS styles.
		 */
		function customize_css( $style ) {
			// Header layout.
			$header_layout = get_theme_mod( 'archetype_header_layout', 'version-1' );

			if ( 'version-2' === $header_layout ) {
				$style .= '
				@media screen and (max-width: 767px) {
					.secondary-navigation-wrap .site-header-cart {
						display: none;
					}
				}
				@media screen and (min-width: 768px) {
					.site-header > .col-full .site-header-cart {
						display: none;
					}
				}';
			}

			return $style;
		}

		/**
		 * Work through the stored data and display the components in the desired order,
		 * and without any of the disabled components.
		 *
		 * @since 1.0.0
		 */
		public function component_order() {
			if ( is_admin() ) {
				return;
			}

			// Loop over the sections.
			foreach ( (array) $this->get_controls() as $key => $sections ) {

				// Loop over the controls in each section.
				foreach ( (array) $sections['controls'] as $key => $control ) {

					// Toggle override. Bail when toggle is set but doesn't match the value.
					if ( ! empty( $control['toggle'] ) ) {
						list( $toggle_id, $toggle_value ) = explode( ':' , $control['toggle'] );
						if ( false === strpos( get_theme_mod( $toggle_id ), $toggle_value ) ) {
							continue;
						}
					}

					$component_order = get_theme_mod( $control['id'] );

					if ( ! empty( $component_order ) ) {
						$components = explode( ',', $component_order );

						// Remove all existing actions for this hook.
						remove_all_actions( $control['hook'] );

						// Remove the disabled components.
						if ( 0 < count( $components ) ) {
							foreach ( $components as $id => $component ) {
								if ( false !== strpos( $component, '[disabled]' ) ) {
									unset( $components[ $id ] );
								}
							}
						}

						// Reorder the components.
						if ( 0 < count( $components ) ) {
							$count = 10;
							foreach ( $components as $id => $component ) {
								if ( false !== strpos( $component, '@' ) ) {
									list( $class, $method ) = explode( '@' , $component );
									if ( class_exists( $class ) && method_exists( $class, $method ) ) {
										add_action( $control['hook'], array( $class, $method ), $count );
									}
								} else {
									if ( function_exists( $component ) ) {
										add_action( $control['hook'], esc_attr( $component ), $count );
									}
								}

								$count + 10;
							}
						}
					}
				}
			}
		}

		/**
		 * Sanitizes choices array.
		 *
		 * @since 1.0.0
		 *
		 * @param  array  $input The choices.
		 * @param  object $setting The Customizer setting.
		 * @return array  The sanitized choices.
		 */
		public function sanitize_components( $input, $setting ) {
			foreach ( (array) $this->get_controls() as $key => $sections ) {
				foreach ( (array) $sections['controls'] as $key => $control ) {
					if ( $control['id'] === $setting->id ) {
						$hook = $control['hook'];
					}
				}
			}

			$choices = $this->get_control_choices( $hook, $setting->id );

			foreach ( explode( ',', $input ) as $value ) {
				if ( ! array_key_exists( $value, $choices ) && ! array_key_exists( str_replace( '[disabled]', '', $value ), $choices ) ) {
					$invalid = false;
				}
			}

			if ( ! isset( $invalid ) ) {
				return $input;
			} else {
				return '';
			}
		}

		/**
		 * Retrieve the hooked functions.
		 *
		 * @since 1.0.0
		 *
		 * @param string $hook The place where the component is hooked. Default empty.
		 * @param string $id The component ID. Default empty.
		 * @return array $hook An array of hooked functions.
		 */
		private function get_control_choices( $hook = '', $id = '' ) {
			global $wp_filter;

			if ( empty( $hook ) || empty( $id ) ) {
				return;
			}

			$filters = $wp_filter;
			$response = array();

			if ( isset( $filters[ $hook ] ) && 0 < count( $filters[ $hook ] ) ) {
				/*
				 * We need to fake that the secondary nav exists in some headers, even though it has
				 * been hooked somewhere else. In some cases we'll need to remove this array, as well.
				 * This exists to keep both solutions DRY.
				 */
				$secondary_navigation = array(
					'archetype_secondary_navigation' => array(
						'function' => 'archetype_secondary_navigation',
						'accepted_args' => 1,
					),
				);

				// Filter the header hooks.
				if ( 'archetype_header' === $hook ) {
					foreach ( $filters[ $hook ] as $key => $components ) {
						if ( is_array( $components ) && $secondary_navigation === $components ) {
							// Remove secondary navigation.
							if ( false !== strpos( $id, '_1' ) ) {
								unset( $filters[ $hook ][ $key ] );
							} else if ( false !== strpos( $id, '_2' ) ) {
								$hook_exists = true;
							}
						}
					}
					// Add secondary navigation.
					if ( false !== strpos( $id, '_2' ) && ! isset( $hook_exists ) ) {
						$filters[ $hook ][15] = $secondary_navigation;
					}
					ksort( $filters[ $hook ] );
				}

				foreach ( $filters[ $hook ] as $key => $components ) {
					if ( is_array( $components ) ) {
						foreach ( $components as $key => $component ) {
							if ( is_array( $component['function'] ) ) {
								$key = get_class( $component['function'][0] ) . '@' . $component['function'][1];
								$response[ $key ] = $this->format_title( $component['function'][1] );
							} else {
								$response[ $key ] = $this->format_title( $key );
							}
						}
					}
				}
			}

			return $response;
		}

		/**
		 * Format a given ID into a title.
		 *
		 * @since 1.0.0
		 *
		 * @param string $id The component ID.
		 * @return string A formatted title. If no formatting is possible, return the ID.
		 */
		private function format_title( $id ) {
			$title = $id;

			$title = preg_replace( '/archetype_(homepage_)?/', '', $title );
			$title = str_replace( '_', ' ', $title );
			$title = preg_replace( '/(\d+)/', '($1)', $title );
			$title = ucwords( $title );

			return $title;
		}

		/**
		 * Format an array of components as a comma separated list.
		 *
		 * @since 1.0.0
		 *
		 * @param string $hook The place where the component is hooked. Default empty.
		 * @param string $id The component ID. Default empty.
		 * @return string A list of components separated by a comma.
		 */
		private function get_control_default( $hook = '', $id = '' ) {
			if ( empty( $hook ) || empty( $id ) ) {
				return;
			}

			$components = $this->get_control_choices( $hook, $id );
			$defaults = array();

			foreach ( $components as $key => $component ) {
				if ( apply_filters( 'archetype_component_order_control_hide_' . $key, false ) ) {
					$defaults[] = '[disabled]' . $key;
				} else {
					$defaults[] = $key;
				}
			}

			return join( ',', $defaults );
		}

		/**
		 * Component order controls.
		 *
		 * @since 1.0.0
		 *
		 * @return array
		 */
		private function get_controls() {
			/**
			 * Filter the component order controls.
			 *
			 * @since 1.0.0
			 *
			 * @param array $controls
			 */
			$controls = apply_filters( 'archetype_component_order_controls', array(
				array(
					'id'          => 'archetype_header_layout',
					'title'       => __( 'Layout', 'archetype' ),
					'priority'    => 1,
					'panel'       => 'archetype_header',
					'controls'    => array(
						array(
							'id'          => 'archetype_header_layout_1',
							'description' => __( 'Re-order & toggle the header components.', 'archetype' ),
							'label'       => '',
							'toggle'      => 'archetype_header_layout:version-1',
							'hook'        => 'archetype_header',
						),
						array(
							'id'          => 'archetype_header_layout_2',
							'description' => __( 'Re-order & toggle the header components.', 'archetype' ),
							'label'       => '',
							'toggle'      => 'archetype_header_layout:version-2',
							'hook'        => 'archetype_header',
						),
					),
				),
				array(
					'id'          => 'archetype_homepage_layout',
					'title'       => __( 'Layout', 'archetype' ),
					'priority'    => 1,
					'panel'       => 'archetype_homepage',
					'controls'    => array(
						array(
							'id'          => 'archetype_homepage_layout',
							'description' => __( 'Re-order & toggle the homepage components.', 'archetype' ),
							'label'       => '',
							'toggle'      => '',
							'hook'        => 'homepage',
						),
					),
				),
				array(
					'id'          => 'archetype_footer_layout',
					'title'       => __( 'Layout', 'archetype' ),
					'priority'    => 1,
					'panel'       => 'archetype_footer',
					'controls'    => array(
						array(
							'id'          => 'archetype_footer_layout',
							'description' => __( 'Re-order & toggle the footer components.', 'archetype' ),
							'label'       => '',
							'toggle'      => '',
							'hook'        => 'archetype_footer',
						),
					),
				),
			) );

			return $controls;
		}

		/**
		 * Filter the hidden toggle buttons for all header components.
		 *
		 * @since 1.0.0
		 *
		 * @param  array  $components The components. Default is empty.
		 * @param  string $id The control ID.
		 * @return array  The components with hidden toggle buttons.
		 */
		public function hide_toggles( $components, $id ) {
			if ( false !== strpos( $id, 'header_layout' ) ) {
				$components = array( 'archetype_site_header', 'archetype_primary_navigation' );
			}

			return $components;
		}

	}

endif;

if ( ! function_exists( 'archetype_component_order' ) ) :
	/**
	 * The main function responsible for returning the one true
	 * Archetype_Component_Order Instance to functions everywhere.
	 *
	 * Use this function like you would a global variable, except
	 * without needing to declare the global.
	 *
	 * Example: <?php $archetype_component_order = archetype_component_order(); ?>
	 *
	 * @since 1.0.0
	 * @return object The one true Archetype_Component_Order Instance
	 */
	function archetype_component_order() {
		return Archetype_Component_Order::instance();
	}
endif;

/**
 * Loads the main instance of Archetype_Component_Order to prevent
 * the need to use globals.
 *
 * @since 1.0.0
 * @return object Archetype_Component_Order
 */
add_action( 'after_setup_theme', 'archetype_component_order', 11 );
