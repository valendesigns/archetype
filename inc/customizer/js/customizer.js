/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to import and export theme mods.
 */
( function( $ ) {
  var Archetype_Customizer = {
    init: function() {
      $( 'input[name=customizer-import-button]' ).on( 'click', Archetype_Customizer._import );
      $( 'input[name=customizer-export-button]' ).on( 'click', Archetype_Customizer._export );
    },
    _import: function() {
    var win     = $( window )
      , body    = $( 'body' )
      , form    = $( '<form class="customizer-import-form" method="POST" enctype="multipart/form-data"></form>' )
      , controls  = $( '.customizer-import-controls' )
      , file    = $( 'input[name=customizer-import-file]' )
      , message   = $( '.customizer-import-uploading' );
      
      if ( '' == file.val() ) {
        alert( Archetype_Customizerl10n.emptyImport );
      } else {
        win.off( 'beforeunload' );
        body.append( form );
        form.append( controls );
        message.show();
        form.submit();
      }
    },
    _export: function() {
      window.location.href = Archetype_CustomizerConfig.customizerURL + '?customizer-export=' + Archetype_CustomizerConfig.exportNonce;
    }
  };
  $( Archetype_Customizer.init );
})( jQuery );