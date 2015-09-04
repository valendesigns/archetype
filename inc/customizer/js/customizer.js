/* global ArchetypeCustomizerConfig, ArchetypeCustomizerl10n, alert */

/**
 * Customizer enhancements.
 *
 * Contains handlers for svg logo, component order, toggle controls, & importing and exporting theme mods.
 *
 * @since 1.0.0
 */
( function( $ ) {
	'use strict';

	var $body, $anchor, $logo, $svg, $branding, size;

	var ArchetypeCustomizer = {
		init: function() {
			ArchetypeCustomizer.autoFocus();
			ArchetypeCustomizer.siteLogo();
			ArchetypeCustomizer.componentOrder();
			ArchetypeCustomizer.componentToggle();
			ArchetypeCustomizer._radioButtonsInit();
			ArchetypeCustomizer._toggleInit();
			$( document ).on( 'click', 'input[name=customize-import-button]', ArchetypeCustomizer.importMods );
			$( document ).on( 'click', 'input[name=customize-export-button]', ArchetypeCustomizer.exportMods );
		},

		cacheSelectors: function() {
			var _frame = $( 'iframe' ).contents();

			$body      = $( 'body', _frame );
			$anchor    = $( '.site-logo-link', _frame );
			$logo      = $( '.site-logo', _frame );
			$svg       = $( '.svg-site-logo', _frame );
			$branding  = $( '.site-branding', _frame ),
			size       = $logo.attr( 'data-size', _frame );
		},

		autoFocus: function() {
			$( '.archetype-autofocus' ).on( 'click', function() {
				var section = wp.customize.section( $( this ).data( 'id' ) );
				if ( section ) {
					section.focus();
					wp.customize.previewer.previewUrl.set( wp.customize.settings.url.home );
				}
			} );
		},

		siteLogo: function() {
			wp.customize( 'site_logo', function( value ) {
				value.bind( function( to ) {

					// Grab selectors the first time through.
					if ( ! $body ) {
						ArchetypeCustomizer.cacheSelectors();
					}

					if ( to && to.url ) {
						$logo.hide();
						$branding.hide();

						if ( ! to.sizes[ size ] ) {
							size = 'full';
						}

						$svg.css({
							height: to.sizes[ size ].height,
							width: to.sizes[ size ].width
						});

						if ( 'block' !== $svg.css( 'display' ) ) {
							$logo.show();
						}
					} else {
						$branding.show();
					}
				} );
			} );
			wp.customize( 'archetype_site_logo_svg', function( value ) {
				value.bind( function( to ) {
					var params, width, height;

					// Grab selectors the first time through.
					if ( ! $body ) {
						ArchetypeCustomizer.cacheSelectors();
					}

					if ( to ) {
						params = {
							'action': 'archetype-get-logo-url',
							'wp_customize': 'on',
							'id': to,
							'customize-logo': ArchetypeCustomizerConfig.logoNonce
						};

						$.post( ArchetypeCustomizerConfig.ajaxURL, params, function( response ) {
							if ( response.data && response.data.message ) {

								// Display error message.
								alert( response.data.message );

								// Show logo.
								$logo.show();
							} else if ( response.success ) {
								width = $logo.attr( 'width' );
								height = $logo.attr( 'height' );

								// Hide logo.
								$logo.hide();

								// SVG styles.
								$svg.css( {
									'display': 'block',
									'background-image': 'url(' + response.data + ')',
									'background-repeat': 'no-repeat',
									'background-size': 'contain',
									'width': width,
									'height': height
								} );

								// Display error message.
								if ( $anchor.is( ':hidden' ) ) {
									alert( ArchetypeCustomizerl10n.missingLogo );
								}
							}
						} );
					} else {
						$logo.show();
						$svg.css( {
							display: 'none'
						} );
					}
				} );
			} );
		},

		componentOrder: function() {
			$( '.component-order' ).each( function() {
				var self = this,
					input = $( self ).next( '.component-order-input' );

				$( self ).sortable( {
					axis: 'y'
				} );

				$( self ).disableSelection();

				$( self ).bind( 'sortstop', function( event ) {
					ArchetypeCustomizer.componentSort( event.target, input );
				} );

				$( '.ui-sortable-handle', self ).bind( 'click', function( event ) {
					event.preventDefault();
				} );

				$( '.component-visibility', self ).bind( 'click', function() {
					$( this ).parent( 'li' ).toggleClass( 'disabled' );
					ArchetypeCustomizer.componentSort( self, input );
				} );
			} );
		},

		componentSort: function( element, input ) {
			var components = [];

			$( element ).find( 'li' ).each( function() {
				if ( $( this ).hasClass( 'disabled' ) ) {
					components.push( '[disabled]' + $( this ).attr( 'id' ) );
				} else {
					components.push( $( this ).attr( 'id' ) );
				}
			} );

			components = components.join( ',' );

			input.attr( 'value', components ).trigger( 'change' );
		},

		componentToggle: function() {
			var controls = {
				'header': 'archetype_header_layout'
			};

			$.each( controls, function( id, control ) {
				wp.customize( control, function( value ) {
					value.bind( function( to ) {
						$( '.component-order' ).each( function() {
							var self = this,
								data = $( self ).data();

							if ( control === data.id ) {
								if ( ~data.value.indexOf( to ) ) {
									$( self ).parent( 'label' ).show();
								} else {
									$( self ).parent( 'label' ).hide();
								}
							}
						} );
					} );
				} );
			} );
		},

		_radioButtonsInit: function() {
			if ( ! $.fn.buttonset ) {
				return;
			}

			$( '.radio-buttons' ).each( function() {
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
				'input[data-customize-setting-link=archetype_header_subscribe_and_connect_theme_override]': '#customize-control-archetype_header_subscribe_and_connect_theme',
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
		},

		importMods: function() {
			var win     = $( window ),
				body      = $( 'body' ),
				form      = $( '<form class="customize-import-form" method="POST" enctype="multipart/form-data"></form>' ),
				controls  = $( '.customize-import-controls' ),
				file      = $( 'input[name=customize-import-file]' ),
				message   = $( '.customize-import-uploading' );

			if ( '' === file.val() ) {
				alert( ArchetypeCustomizerl10n.emptyImport );
			} else {
				win.off( 'beforeunload' );
				body.append( form );
				form.append( controls );
				message.show();
				form.submit();
			}
		},

		exportMods: function() {
			window.location.href = ArchetypeCustomizerConfig.customizerURL + '?customize-export=' + ArchetypeCustomizerConfig.exportNonce;
			return false;
		}

	};

	$( ArchetypeCustomizer.init );

} )( jQuery );
