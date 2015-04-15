/**
 * Script for initializing globally-used functions and libs.
 *
 * @since 1.0.0
 */
(function($) {
  'use strict';
  
  var archetype = {
    
    cache: {},
    
    init: function() {
      this.cacheElements();
      this.bindEvents();
    },
    
    cacheElements: function() {
      this.cache = {
        $window: $(window),
        $document: $(document)
      };
    },

    bindEvents: function() {
      var self = this;

      this.cache.$document.on( 'ready', function() {
        self.navigationInit();
        self.skipLinkFocusFix();
        self.wooCommerceStarRating();
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
      var container, button, menu;

      container = document.getElementById( 'site-navigation' );
      if ( ! container ) {
        return;
      }

      button = container.getElementsByTagName( 'button' )[0];
      if ( 'undefined' === typeof button ) {
        return;
      }

      menu = container.getElementsByTagName( 'ul' )[0];

      // Hide menu toggle button if menu is empty and return early.
      if ( 'undefined' === typeof menu ) {
        button.style.display = 'none';
        return;
      }

      menu.setAttribute( 'aria-expanded', 'false' );

      if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
        menu.className += ' nav-menu';
      }

      button.onclick = function() {
        if ( -1 !== container.className.indexOf( 'toggled' ) ) {
          container.className = container.className.replace( ' toggled', '' );
          button.setAttribute( 'aria-expanded', 'false' );
          menu.setAttribute( 'aria-expanded', 'false' );
        } else {
          container.className += ' toggled';
          button.setAttribute( 'aria-expanded', 'true' );
          menu.setAttribute( 'aria-expanded', 'true' );
        }
      };

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
      var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
          is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
          is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1,
          eventMethod;

      if ( ( is_webkit || is_opera || is_ie ) && 'undefined' !== typeof( document.getElementById ) ) {
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
    },

  };
  
  archetype.init();
})(jQuery);
