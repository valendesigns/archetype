/* global _archetype */

/**
 * Script for initializing globally-used functions and libs.
 *
 * @since 1.0.0
 */
( function( $ ) {
	'use strict';

	var archetype = {

		cache: {},

		init: function() {
			this.cacheElements();
			this.bindEvents();
		},

		cacheElements: function() {
			this.cache = {
				$window: $( window ),
				$document: $( document )
			};
		},

		bindEvents: function() {
			var self = this;

			this.cache.$document.on( 'ready', function() {
				self.navigationInit();
				self.skipLinkFocusFix();
				self.wooCommerceStarRating();
				self.sliderInit();
			} );
		},

		/**
		 * Initialize the mobile menu functionality.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		navigationInit: function() {
			var $container = $( '#site-navigation' ),
				$menu = $( '.handheld-navigation ul' );

			if ( 0 === $container.length ) {
				return;
			}

			if ( 0 === $( 'button.menu-toggle' ).length ) {
				return;
			}

			// Hide menu toggle button if menu is empty and return early.
			if ( 0 === $menu.length ) {
				$( 'button.menu-toggle' ).hide();
				return;
			}

			$menu.attr( 'aria-expanded', 'false' );

			// Fix position by moving the button & display both buttons
			$( 'button.menu-toggle' ).appendTo( '.secondary-navigation' ).css( 'display', 'block' );
			$( 'a.cart-contents' ).css( 'display', 'block' );

			// Listen for button click.
			$( 'button.menu-toggle' ).on( 'click', function() {
				var $that = $( this );

				if ( $container.is( '.toggled' ) ) {
					$container.removeClass( 'toggled' );
					$that.attr( 'aria-expanded', 'false' );
					$menu.attr( 'aria-expanded', 'false' );
				} else {
					$container.addClass( 'toggled' );
					$that.attr( 'aria-expanded', 'true' );
					$menu.attr( 'aria-expanded', 'true' );
				}
			} );

			// Fix header button positions inside wrapper
			if ( $( '.secondary-navigation-wrap' ).length ) {
				$( '.secondary-navigation-wrap button.menu-toggle' ).appendTo( '.site-header > .col-full' );
				$( '.secondary-navigation-wrap .site-header-cart' ).clone().appendTo( '.site-header > .col-full' );
			}

			// Add focus class to li
			$( '.main-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.archetype blur.archetype', function() {
				$( this ).parents().toggleClass( 'focus' );
			});

			// Add focus to cart dropdown
			$( window ).load( function() {
				$( '.site-header-cart' ).find( 'a' ).on( 'focus.archetype blur.archetype', function() {
					$( this ).parents().toggleClass( 'focus' );
				});
			});

			// Hide empty cart dropdown
			$( document ).on( 'mouseenter.archetype mouseleave.archetype', '.site-header-cart .cart-contents', function() {
				var $cart = $( this ).parents().next( '.widget_shopping_cart' );
				if ( $cart.find( 'li:first-child' ).hasClass( 'empty' ) ) {
					$cart.addClass( 'is-empty' );
				} else {
					$cart.removeClass( 'is-empty' );
				}
			});
		},

		/**
		 * Fix tab destination after 'Skip to content' link has been clicked.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		skipLinkFocusFix: function() {
			var isWebkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
				isOpera = navigator.userAgent.toLowerCase().indexOf( 'opera' ) > -1,
				isIE = navigator.userAgent.toLowerCase().indexOf( 'msie' ) > -1,
				eventMethod;

			if ( ( isWebkit || isOpera || isIE ) && 'undefined' !== typeof( document.getElementById ) ) {
				eventMethod = ( window.addEventListener ) ? 'addEventListener' : 'attachEvent';
				window[ eventMethod ]( 'hashchange', function() {
					var element = document.getElementById( location.hash.substring( 1 ) );

					if ( element ) {
						if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) {
							element.tabIndex = -1;
						}

						element.focus();
					}
				}, false );
			}
		},

		/**
		 * WooCommerce star rating
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		wooCommerceStarRating: function() {
			var $stars = '#respond p.stars a';

			if ( $( $stars ).length ) {
				$( 'body' ).on( 'mouseenter.archetype', $stars, function() {
					$( this ).prevAll().toggleClass( 'toggled' );
				});

				$( 'body' ).on( 'mouseleave.archetype', $stars, function() {
					$( this ).siblings( 'a' ).removeClass( 'toggled' );
				});

				$( 'body' ).on( 'click.archetype', $stars, function() {
					$( this ).siblings( 'a' ).removeClass( 'active' );
					$( this ).addClass( 'active' ).prevAll().addClass( 'active' );
				});
			}
		},

		/**
		 * Initialize Slider
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		sliderInit: function() {
			var _slider;
			if ( 'function' === typeof jQuery.fn.bxSlider ) {
				_slider = $( '.bxslider' ).bxSlider( {
					adaptiveHeight: true,
					mode: 'fade',
					pager: false,
					nextText: _archetype.next,
					prevText: _archetype.prev
				} );

				$( window ).on( 'orientationchange', function() {

					_slider.reloadSlider();

				});
			}
		}

	};

	archetype.init();

} )( jQuery );
