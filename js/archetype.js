/* global Archetypel10n */

/**
 * Script for initializing globally-used functions and libs.
 *
 * @since 1.0.0
 */
( function( $ ) {
	'use strict';

	var Archetype = {

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
				self.fixMobileMenuInit();
				self.pinHeaderInit();
				self.pinMenuInit();
				self.heroInit();

				self.cache.$window.on( 'load', function() {
					$( this ).trigger( 'resize' );
				} );
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
			var $container = $( '#masthead #site-navigation' ),
				$menu = $( '#masthead .handheld-navigation ul' );

			if ( 0 === $container.length ) {
				return;
			}

			if ( 0 === $( '#masthead button.menu-toggle' ).length ) {
				return;
			}

			// Hide menu toggle button if menu is empty and return early.
			if ( 0 === $menu.length ) {
				$( '#masthead button.menu-toggle' ).hide();
				return;
			}

			$menu.attr( 'aria-expanded', 'false' );

			// Fix position by moving the button & display both buttons
			if ( 0 === $( '#masthead .secondary-navigation button.menu-toggle' ).length ) {
				$( '#masthead button.menu-toggle' ).appendTo( '.secondary-navigation' ).css( 'display', 'block' );
			}
			$( 'a.cart-contents' ).css( 'display', 'block' );

			// Listen for button click.
			$( '#masthead button.menu-toggle' ).on( 'click', function() {
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
			if ( $( '#masthead .secondary-navigation-wrap' ).length ) {
				$( '#masthead .secondary-navigation-wrap button.menu-toggle' ).appendTo( '.site-header > .col-full' );
				$( '#masthead .secondary-navigation-wrap .site-header-cart' ).clone().appendTo( '.site-header > .col-full' );
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
					nextText: Archetypel10n.next,
					prevText: Archetypel10n.prev
				} );

				$( window ).on( 'orientationchange', function() {

					_slider.reloadSlider();

				});
			}
		},

		fixMobileMenuInit: function() {
			var self = this;

			// Mobile menu vars.
			self.$mobileMenu = $( '#masthead #navigation' );
			self.$mobileMenuPrev = self.$mobileMenu.prev();
			self.$mobileMenuNext = self.$mobileMenu.next();
			self.$mobileMenuMain = $( '#masthead > div.col-full' );

			if ( 0 === self.$mobileMenu.length ) {
				return;
			}

			// Event listener.
			self.cache.$window.on( 'resize', $.proxy( self.fixMobileMenu, this ) );
		},

		fixMobileMenu: function() {
			var self = this,
				scrollWidth = self.cache.$window.width();

			if ( 768 > scrollWidth && self.$mobileMenu.not( '.moved-to-end' ) ) {
				self.$mobileMenu.insertAfter( self.$mobileMenuMain ).addClass( 'moved-to-end' );
			} else if ( self.$mobileMenu.is( '.moved-to-end' ) ) {
				if ( 0 === self.$mobileMenuPrev.length ) {
					self.$mobileMenu.insertBefore( self.$mobileMenuNext ).removeClass( 'moved-to-end' );
				} else {
					self.$mobileMenu.insertAfter( self.$mobileMenuPrev ).removeClass( 'moved-to-end' );
				}
			}
		},

		pinHeaderInit: function() {
			var self = this;

			$( '.handheld-pin' ).parents( '#masthead' ).addClass( 'header-pin' );

			// Global menu vars.
			self.$header = $( '.header-pin' );
			self.$headerInner = $( '#masthead > .col-full' );

			if ( 0 === self.$header.length || 0 === self.$headerInner.length ) {
				return;
			}

			self.$headerClone = self.$header.clone().attr( 'id', 'masthead-clone' );
			self.$headerCloneContainer = self.$headerClone.find( '#site-navigation' );
			self.$headerCloneMenu = self.$headerClone.find( '.handheld-navigation ul' );

			// Event listeners.
			self.cache.$window
				.on( 'scroll', $.proxy( self.pinHeader, this ) )
				.on( 'resize', $.proxy( self.pinHeader, this ) );
		},

		pinHeader: function() {
			var self = this, headerTop, scrollTop, scrollWidth;

			// There is no header.
			if ( 0 === self.$header.length ) {
				return;
			}

			// Get the values.
			headerTop = self.$headerInner.offset().top;
			scrollTop = self.cache.$window.scrollTop();
			scrollWidth = self.cache.$window.width();

			// The admin bar needs to be accounted for.
			if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				headerTop = headerTop - ( 600 >= scrollWidth ? 0 : 46 );
			}

			// Pin the menu.
			if ( 0 < scrollTop && headerTop <= scrollTop && 768 > scrollWidth && 600 <= scrollWidth ) {
				if ( 0 === $( '#masthead-clone' ).length ) {
					self.$headerClone.insertAfter( '#masthead' ).addClass( 'pinned' );
					self.$header.addClass( 'was-pinned' );

					// Mobile menu vars.
					if ( $( '#masthead-clone #navigation' ).not( '.moved-to-end' ) ) {
						$( '#masthead-clone #navigation' ).insertAfter( $( '#masthead-clone > div.col-full' ) ).addClass( 'moved-to-end' );
					}

					self.$headerCloneMenu.attr( 'aria-expanded', 'false' );

					self.$headerClone.find( 'button.menu-toggle' ).appendTo( '#masthead-clone .secondary-navigation' ).css( 'display', 'block' );
					self.$headerClone.find( 'a.cart-contents' ).css( 'display', 'block' );

					// Listen for button click.
					self.$headerClone.find( 'button.menu-toggle' ).on( 'click', function() {
						if ( self.$headerCloneContainer.is( '.toggled' ) ) {
							self.$headerCloneContainer.removeClass( 'toggled' );
							self.$headerCloneMenu.attr( 'aria-expanded', 'false' );
							$( this ).attr( 'aria-expanded', 'false' );
						} else {
							self.$headerCloneContainer.addClass( 'toggled' );
							self.$headerCloneMenu.attr( 'aria-expanded', 'true' );
							$( this ).attr( 'aria-expanded', 'true' );
						}
					} );

					// Need to do some visual trickery
					if ( $( '#masthead #site-navigation' ).is( '.toggled' ) ) {
						$( '#masthead #site-navigation' ).removeClass( 'toggled' );
						$( '#masthead .handheld-navigation ul' ).attr( 'aria-expanded', 'false' );
						$( '#masthead button.menu-toggle' ).attr( 'aria-expanded', 'false' );
						self.$headerCloneContainer.addClass( 'toggled' );
						self.$headerCloneMenu.attr( 'aria-expanded', 'true' );
						self.$headerClone.find( 'button.menu-toggle' ).attr( 'aria-expanded', 'true' );
					} else {
						self.$headerCloneContainer.removeClass( 'toggled' );
						self.$headerCloneMenu.attr( 'aria-expanded', 'false' );
						self.$headerClone.find( 'button.menu-toggle' ).attr( 'aria-expanded', 'false' );
					}
				}
			} else {
				self.$headerClone.remove();
				self.$header.removeClass( 'was-pinned header-pin' );
				self.$header.find( 'a.cart-contents' ).css( 'display', 'block' );
			}
		},

		pinMenuInit: function() {
			var self = this;

			// Global menu vars.
			self.$menu = $( '.navigation-pin' );
			self.$menuClone = self.$menu.clone();

			// Event listeners.
			self.cache.$window
				.on( 'scroll', $.proxy( self.pinMenu, this ) )
				.on( 'resize', $.proxy( self.pinMenu, this ) );
		},

		pinMenu: function() {
			var menuTop, scrollTop, scrollWidth, adminBarHeight;

			// There is no menu.
			if ( 0 === this.$menu.length ) {
				return;
			}

			// Get the values.
			menuTop = this.$menu.offset().top;
			scrollTop = this.cache.$window.scrollTop();
			scrollWidth = this.cache.$window.width();

			// The admin bar needs to be accounted for.
			if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
				adminBarHeight = 32;
				if ( 600 >= scrollWidth ) {
					adminBarHeight = 0;
				}
				if ( 782 >= scrollWidth ) {
					adminBarHeight = 46;
				}
				menuTop = menuTop - adminBarHeight;
			}

			// Pin the menu.
			if ( 0 < scrollTop && menuTop <= scrollTop && 767 < scrollWidth ) {
				if ( 0 === $( '#masthead + .navigation-pin' ).length ) {
					this.$menuClone.insertAfter( '#masthead' ).addClass( 'pinned' );
					this.$menu.addClass( 'was-pinned' );
				}
			} else {
				this.$menuClone.remove();
				this.$menu.removeClass( 'was-pinned' );
			}
		},

		heroInit: function() {
			var self = this,
				reverse = false;

			// Global hero vars.
			self.$hero = $( '.archetype-hero' );
			self.$heroCol = self.$hero.find( '.col-full' );
			self.$heroContent = self.$hero.find( '.archetype-hero-content' );
			self.$heroMedia = self.$hero.find( '.archetype-hero-media' );

			// Transition is reversed.
			reverse = self.$hero.hasClass( 'archetype-hero-transition-reverse' );

			if ( self.$hero.hasClass( 'archetype-hero-add-transition' ) ) {
				self.slideShake( self.$heroContent, {
					'shakes': 1,
					'distance': ( reverse ? 3 : 4 ),
					'duration': ( reverse ? 300 : 400 ),
					'slidePosition': ( reverse ? 3000 : -3000 ),
					'slideDuration': 150
				} );

				self.slideShake( self.$heroMedia, {
					'distance': 2,
					'slidePosition': ( reverse ? -3000 : 3000 )
				} );
			} else {
				self.makeVisible( self.$heroContent );
				self.makeVisible( self.$heroMedia );
			}

			// Event listeners.
			if ( self.$hero.hasClass( 'archetype-hero-has-grid' ) && self.$hero.hasClass( 'archetype-hero-position-media' ) ) {
				self.cache.$window.on( 'resize', $.proxy( self.pinHeroMedia, this ) );
			}
		},

		pinHeroMedia: function() {
			var colHeight = this.$heroCol.outerHeight( true ),
				mediaHeight = this.$heroMedia.height(),
				contentHeight = this.$heroContent.height(),
				mediaMargin = ( Math.abs( parseFloat( this.$heroMedia.css( 'margin-bottom' ) ) ) / 2 ),
				trueHeight = mediaHeight + mediaMargin,
				scrollWidth = $( window ).width();

			if ( 767 < scrollWidth && ( trueHeight < colHeight || mediaHeight < contentHeight ) ) {
				this.$heroMedia.css( { top: ( colHeight - trueHeight ) } );
			} else {
				this.$heroMedia.css( { top: 'auto' } );
			}
		},

		makeVisible: function( element ) {
			return element.each( function() {
				$( this )
					.css( { opacity: 0, visibility: 'visible' } )
					.animate( { opacity: 1.0 }, 0 );
			} );
		},

		slideShake: function( element, options ) {
			var settings = {
				'shakes': 2,
				'distance': 5,
				'duration': 500,
				'slidePosition': 3000,
				'slideDelay': 150,
				'slideDuration': 250
			}, pos;

			if ( options ) {
				$.extend( settings, options );
			}

			return element.each( function() {
				var self = $( this ), x, multi;

				pos = self.css( 'position' );
				if ( ! pos || 'static' === pos ) {
					self.css( 'position', 'relative' );
				}

				self
					.css( { opacity: 0, visibility: 'visible', left: settings.slidePosition } )
					.animate( { opacity: 1.0 }, 0 )
					.delay( settings.slideDelay )
					.animate( { left: 0 }, settings.slideDuration );

				for ( x = 1; x <= settings.shakes; x++ ) {
					multi = ( settings.shakes / 2 <= x ? 2 : 1 );

					self.animate( { left: settings.distance * -multi }, ( settings.duration / settings.shakes ) / 4 )
						.animate( { left: settings.distance * multi }, ( settings.duration / settings.shakes ) / 2 )
						.animate( { left: 0 }, ( settings.duration / settings.shakes ) / 4 );
				}
			} );
		}

	};

	Archetype.init();

} )( jQuery );
