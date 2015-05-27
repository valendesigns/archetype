/*!
 * fluidmedia.js v1.0.0
 */
( function( $ ) {
	'use strict';

	/* FLUIDMEDIA CLASS DEFINITION */
	var selectors = [
		'[data-spy=fluidmedia]',
		'iframe[src*="player.vimeo.com"]',
		'iframe[src*="youtube.com"]',
		'iframe[src*="youtube-nocookie.com"]',
		'iframe[src*="kickstarter.com"]',
		'iframe[src*="viddler.com"]',
		'iframe[src*="blip.tv"]',
		'iframe[src*="soundcloud.com"]',
		'iframe[src*="slideshare.net"]',
		'object',
		'embed',
		'.video-player'
	],
	Fluidmedia = function( element ) {
		this.$element = $( element );
		this.process();
	};

	Fluidmedia.prototype.process = function() {

		var tag = this.$element.prop( 'tagName' ).toLowerCase();

		if ( 'embed' === tag && this.$element.parent( 'object' ).length ) {
			return;
		}

		if ( this.$element.parent( '.fluid-media' ).length ) {
			return;
		}

		this.$element.wrap( '<div class="fluid-media"></div>' );

		var height = this.$element.attr( 'height' ),
			width = this.$element.attr( 'width' );

		if ( 'undefined' !== typeof height && 'undefined' !== typeof width ) {
			if ( -1 !== this.$element.attr( 'src' ).indexOf( 'slideshare.net' ) ) {
				height = height - 31;
			}
			var aspectRatio = height / width;
			this.$element.parent( '.fluid-media' ).css( 'padding-bottom', ( aspectRatio * 100 ) + '%' );
		}

		this.$element.removeAttr( 'height' ).removeAttr( 'width' );

	};

	/* FLUIDMEDIA PLUGIN DEFINITION */
	var old = $.fn.fluidmedia;

	$.fn.fluidmedia = function( option ) {
		return this.each( function() {
			var $this = $( this ),
				data = $this.data( 'fluidmedia' );
			if ( ! data ) {
				$this.data( 'fluidmedia', ( data = new Fluidmedia( this ) ) );
			}
			if ( 'string' === typeof option ) {
				data[option].call( $this );
			}
		} );
	};

	$.fn.fluidmedia.Constructor = Fluidmedia;

	/* FLUIDMEDIA NO CONFLICT */
	$.fn.fluidmedia.noConflict = function() {
		$.fn.fluidmedia = old;
		return this;
	};

	/* FLUIDMEDIA DATA-API */
	$( document ).on( 'ready.fluidmedia.data-api', function() {
		$( selectors.join( ',' ) ).each( function() {
			var $spy = $( this ),
				data = $spy.data();
			$spy.fluidmedia( data );
		} );
	} );

} )( window.jQuery );
