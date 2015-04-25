/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to import and export theme mods.
 */
( function( $ ) {
  var Archetype_Customizer = {
    init: function() {
      $( document ).on( 'click', 'input[name=customize-import-button]', Archetype_Customizer._import_customize );
      $( document ).on( 'click', 'input[name=customize-export-button]', Archetype_Customizer._export_customize );
      $( document ).on( 'click', 'input[name=widgets-import-button]', Archetype_Customizer._import_widgets   );
      $( document ).on( 'click', 'input[name=widgets-export-button]', Archetype_Customizer._export_widgets   );
    },
    _import_customize: function() {
      Archetype_Customizer._import( 'customize' );
    },
    _export_customize: function() {
      Archetype_Customizer._export( 'customize' );
    },
    _import_widgets: function() {
      Archetype_Customizer._import( 'widgets' );
    },
    _export_widgets: function() {
      Archetype_Customizer._export( 'widgets' );
    },
    _import: function( type ) {
    var win     = $( window )
      , body    = $( 'body' )
      , form    = $( '<form class="' + type + '-import-form" method="POST" enctype="multipart/form-data"></form>' )
      , controls  = $( '.' + type + '-import-controls' )
      , file    = $( 'input[name=' + type + '-import-file]' )
      , message   = $( '.' + type + '-import-uploading' );
      
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
    _export: function( type ) {
      var nonce = type == 'customize' ? Archetype_CustomizerConfig.exportCustomizeNonce : Archetype_CustomizerConfig.exportWidgetsNonce;
      window.location.href = Archetype_CustomizerConfig.customizerURL + '?' + type + '-export=' + nonce;
      return false;
    }
  };
  $( Archetype_Customizer.init );
})( jQuery );