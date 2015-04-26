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
      $( 'body, button, input, select, textarea, .author-info .author-heading, #comments p.no-comments, .post-navigation .meta-nav, .widget-area .widget a' ).css( 'color', to );
    } );
  } );
  wp.customize( 'archetype_text_color', function( value ) {
    value.bind( function( to ) {
      $( '.page-header, #comments p.no-comments' ).css( 'box-shadow', '5px 0px 0px ' + to + ' inset' );
      $( '.post-navigation a' ).on( 'mouseenter', function() {
        $( this ).css( 'box-shadow', '5px 0px 0px ' + to + ' inset' );
      } );
    } );
  } );
  wp.customize( 'archetype_text_color', function( value ) {
    value.bind( function( to ) {
      $( '.sticky-post, .pagination .prev, .pagination .next, .image-navigation .nav-previous a, .image-navigation .nav-next a, .comment-navigation .prev, .comment-navigation .next, .woocommerce-pagination .prev, .woocommerce-pagination .next, .page-links a' ).css( 'background-color', to );
      $( '.bx-controls-direction .bx-prev, .bx-controls-direction .bx-next' ).on( 'mouseenter', function() {
        $( this ).css( 'background-color', to );
      } );
    } );
  } );
  wp.customize( 'archetype_text_color', function( value ) {
    value.bind( function( to ) {
      $( '.page-links a, .widget h3.widget-title' ).css( 'border-color', to );
    } );
  } );
  wp.customize( 'archetype_heading_color', function( value ) {
    value.bind( function( to ) {
      $( 'h1, h2, h3, h4, h5, h6, .hentry .entry-header h1 a' ).css( 'color', to );
    } );
  } );
  wp.customize( 'archetype_heading_color', function( value ) {
    value.bind( function( to ) {
      $( '.hentry .entry-header h1 a' ).on( 'mouseenter', function() {
        $( this ).css( 'border-color', to );
      } );
    } );
  } );
} )( jQuery );