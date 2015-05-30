/* global ArchetypeCustomizerConfig, ArchetypeCustomizerl10n, alert */

/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers for logo, toggle controls, & import and export theme mods.
 */
( function( $ ) {
	'use strict';

	var $body, $anchor, $logo, $svg, $branding, size;

	var ArchetypeCustomizer = {
		init: function() {
			ArchetypeCustomizer._logoInit();
			ArchetypeCustomizer._toggleInit();
			$( document ).on( 'click', 'input[name=customize-import-button]', ArchetypeCustomizer._import );
			$( document ).on( 'click', 'input[name=customize-export-button]', ArchetypeCustomizer._export );
		},
		_cacheSelectors: function() {
			var _frame = $( 'iframe' ).contents();

			$body      = $( 'body', _frame );
			$anchor    = $( '.site-logo-link', _frame );
			$logo      = $( '.site-logo', _frame );
			$svg       = $( '.svg-site-logo', _frame );
			$branding  = $( '.site-branding', _frame ),
			size       = $logo.attr( 'data-size', _frame );
		},
		_logoInit: function() {
			wp.customize( 'site_logo', function( value ) {
				value.bind( function( to ) {
					// grab selectors the first time through
					if ( ! $body ) {
						ArchetypeCustomizer._cacheSelectors();
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
					// grab selectors the first time through
					if ( ! $body ) {
						ArchetypeCustomizer._cacheSelectors();
					}

					if ( to ) {
						var params = {
							'action': 'archetype-get-logo-url',
							'wp_customize': 'on',
							'id': to,
							'customize-logo': ArchetypeCustomizerConfig.customizerLogoNonce
						};

						$.post( ArchetypeCustomizerConfig.ajaxURL, params, function( response ) {
							if ( response.data && response.data.message ) {
								// Display error message
								alert( response.data.message );

								// Show logo
								$logo.show();
							} else if ( response.success ) {
								var width = $logo.attr( 'width' ),
									height = $logo.attr( 'height' );

								// Hide logo
								$logo.hide();

								// SVG styles
								$svg.css( {
									'display': 'block',
									'background-image': 'url(' + response.data + ')',
									'background-repeat': 'no-repeat',
									'background-size': 'contain',
									'width': width,
									'height': height
								} );

								// Display error message
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
		_toggleInit: function() {
			var toggles = {
				'input[data-customize-setting-link=archetype_boxed]': '#customize-control-archetype_boxed_background_color',
				'input[data-customize-setting-link=archetype_post_shadow_toggle]': '#customize-control-archetype_post_shadow_color',
				'input[data-customize-setting-link=archetype_search_shadow_toggle]': '#customize-control-archetype_search_shadow_color',
				'!input[data-customize-setting-link=archetype_button_2d]': '#customize-control-archetype_button_shadow_color, #customize-control-archetype_button_shadow_hover_color',
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
		_import: function() {
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
		_export: function() {
			window.location.href = ArchetypeCustomizerConfig.customizerURL + '?customize-export=' + ArchetypeCustomizerConfig.customizerExportNonce;
			return false;
		}
	};
	$( ArchetypeCustomizer.init );
} )( jQuery );
