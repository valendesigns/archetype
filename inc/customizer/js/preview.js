/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
  // Site title and description.
  wp.customize( 'blogname', function( value ) {
    value.bind( function( to ) {
      $( '.site-title a' ).text( to );
    } );
  } );
  wp.customize( 'blogdescription', function( value ) {
    value.bind( function( to ) {
      $( '.site-description' ).text( to );
    } );
  } );
  wp.customize( 'archetype_site_logo_margin_top', function( value ) {
    value.bind( function( to ) {
      if ( to )
        $( '.site-logo-link img' ).css( 'margin-top', to + 'em' );
      else
        $( '.site-logo-link img' ).css( 'margin-top', '0' );
    } );
  } );
  wp.customize( 'archetype_text_color', function( value ) {
    value.bind( function( to ) {
      var boxShadow = '5px 0px 0px ' + to + ' inset';

      // Color
      $( 'body, button, input, select, textarea, .author-info .author-heading, #comments p.no-comments, .post-navigation .meta-nav, .widget-area .widget a' ).css( 'color', to );

      // Box Shadow
      $( '.page-header, #comments p.no-comments' ).css( 'box-shadow', boxShadow );

      // Box Shadow Hover
      $( '.post-navigation a' ).on( 'mouseenter', function() {
        $( this ).css( 'box-shadow', boxShadow );
      } );

      // Background Color
      $( '.sticky-post, .pagination .prev, .pagination .next, .image-navigation .nav-previous a, .image-navigation .nav-next a, .comment-navigation .prev, .comment-navigation .next, .woocommerce-pagination .prev, .woocommerce-pagination .next, .page-links a' ).css( 'background-color', to );

      // Background Color Hover
      $( '.bx-controls-direction .bx-prev, .bx-controls-direction .bx-next' ).on( 'mouseenter', function() {
        $( this ).css( 'background-color', to );
      } );

      // Border Color
      $( '.page-links a, .widget h3.widget-title' ).css( 'border-color', to );
    } );
  } );
  wp.customize( 'archetype_heading_color', function( value ) {
    value.bind( function( to ) {
      // Color
      $( 'h1, h2, h3, h4, h5, h6, .hentry .entry-header h1 a' ).css( 'color', to );

      // Border Color Hover
      $( '.hentry .entry-header h1 a' ).on( 'mouseenter', function() {
        $( this ).css( 'border-color', to );
      } );
    } );
  } );
  wp.customize( 'archetype_link_color', function( value ) {
    value.bind( function( to ) {
      // Color
      $( 'a, .error-404 h1' ).css( 'color', to );

      // Color Hover
      $( '.subscribe-and-connect-connect a, .widget-area .widget a' ).on( 'mouseenter', function() {
        $( this ).css( 'color', to );
      } );

      // Outline Color Focus
      $( 'a:focus, button, input[type="button"], input[type="reset"], input[type="submit"], .button, .added_to_cart' ).on( 'focus', function() {
        $( this ).css( 'outline-color', to );
      } );

      // Border Color
      $( '.error-404 h1' ).css( 'border-color', to );
    } );
  } );
} )( jQuery );