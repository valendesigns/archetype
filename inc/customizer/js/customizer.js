/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers for toggle controls.
 */
( function( $ ) {
	'use strict';

	var $body;

	var ArchetypeCustomizer = {
		init: function() {
			ArchetypeCustomizer._imageRadioInit();
			ArchetypeCustomizer._toggleInit();
		},
		_cacheSelectors: function() {
			var _frame = $( 'iframe' ).contents();

			$body      = $( 'body', _frame );
		},
		_imageRadioInit: function() {
			if ( ! $.fn.buttonset ) {
				return;
			}

			$( '.radio-image' ).each( function() {
				var self = this;

				// Create the button set.
				$( self ).buttonset();

				// Adds keyboard navigation.
				$( 'label', self ).on( 'keydown', function( event ) {
					if ( 13 === event.which ) {
						event.preventDefault();
						$( event.target ).click();
						$( self ).buttonset( 'refresh' );
					}
				} );
			} );
		},
		_toggleInit: function() {
			var toggles = {
				'input[data-customize-setting-link=archetype_boxed]': '#customize-control-archetype_boxed_background_color',
				'input[data-customize-setting-link=archetype_post_shadow_toggle]': '#customize-control-archetype_post_shadow_color',
				'input[data-customize-setting-link=archetype_search_shadow_toggle]': '#customize-control-archetype_search_shadow_color',
				'!input[data-customize-setting-link=archetype_button_2d]': '#customize-control-archetype_button_shadow_color, #customize-control-archetype_button_shadow_hover_color',
				'input[data-customize-setting-link=archetype_upsell_display_toggle]': '#customize-control-archetype_upsell_display_limit, #customize-control-archetype_upsell_display_limit_text, #customize-control-archetype_upsell_display_columns, #customize-control-archetype_upsell_display_columns_text',
				'input[data-customize-setting-link=archetype_related_products_toggle]': '#customize-control-archetype_related_products_limit, #customize-control-archetype_related_products_limit_text, #customize-control-archetype_related_products_columns, #customize-control-archetype_related_products_columns_text'
			};
			ArchetypeCustomizer._toggleEach( toggles );
		},
		_toggleEach: function( toggles ) {
			$.each( toggles, function( input, control ) {
				var invert = false;
				if ( '!' === input.charAt( 0 ) ) {
					input = input.substr( 1 );
					invert = true;
				}
				ArchetypeCustomizer._toggle( input, control, invert );
				$( document ).on( 'click', input, function() {
					ArchetypeCustomizer._toggle( input, control, invert );
				} );
			} );
		},
		_toggle: function( input, control, invert ) {
			var $input = $( input ),
				$control = $( control );
			if ( $input.prop( 'checked' ) ) {
				if ( invert ) {
					$control.hide();
				} else {
					$control.show();
				}
			} else {
				if ( invert ) {
					$control.show();
				} else {
					$control.hide();
				}
			}
		}
	};
	$( ArchetypeCustomizer.init );
} )( jQuery );
