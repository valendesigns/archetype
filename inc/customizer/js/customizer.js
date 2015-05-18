/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to import and export theme mods.
 */
( function( $ ) {
  var Archetype_Customizer = {
    init: function() {
      $( document ).on( 'click', 'input[name=customize-import-button]', Archetype_Customizer._import );
      $( document ).on( 'click', 'input[name=customize-export-button]', Archetype_Customizer._export );
      $( document ).on( 'click', 'input[data-customize-setting-link=archetype_boxed]', Archetype_Customizer._toggle );
      $( document ).ready( function() {
        Archetype_Customizer._toggle();
      });
    },
    _import: function() {
    var win     = $( window )
      , body    = $( 'body' )
      , form    = $( '<form class="customize-import-form" method="POST" enctype="multipart/form-data"></form>' )
      , controls  = $( '.customize-import-controls' )
      , file    = $( 'input[name=customize-import-file]' )
      , message   = $( '.customize-import-uploading' );
      
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
      window.location.href = Archetype_CustomizerConfig.customizerURL + '?customize-export=' + Archetype_CustomizerConfig.customizerExportNonce;
      return false;
    },
    _toggle: function() {
      var input = $( 'input[data-customize-setting-link=archetype_boxed]' ),
        color = $( '#customize-control-archetype_boxed_background_color' );
      if ( input.prop( 'checked' ) ) {
        color.show();
      } else {
        color.hide();
      }
    }
  };
  $( Archetype_Customizer.init );
})( jQuery );