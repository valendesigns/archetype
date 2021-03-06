<?php
/**
 * General functions used to integrate this theme with OptionTree.
 *
 * @package Archetype
 * @subpackage Option_Tree
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_hide_title_post_meta' ) ) :
	/**
	 * Filter the visibility of the post title.
	 *
	 * @see archetype_hide_title()
	 *
	 * @since 1.0.0
	 *
	 * @param  bool   $hide Whether to hide the title or not.
	 * @param  object $post WP_Post object.
	 * @return bool
	 */
	function archetype_hide_title_post_meta( $hide, $post ) {
		if ( isset( $post->ID ) && get_post_meta( $post->ID, '_archetype_hide_title', true ) == 'on' ) {
			$hide = true;
		}
		return $hide;
	}
endif;

if ( ! function_exists( 'archetype_hide_author_bio_post_meta' ) ) :
	/**
	 * Filter the visibility of the author bio.
	 *
	 * @see archetype_hide_author_bio()
	 *
	 * @since 1.0.0
	 *
	 * @param  bool   $hide Whether to hide the title or not.
	 * @param  object $post WP_Post object.
	 * @return bool
	 */
	function archetype_hide_author_bio_post_meta( $hide, $post ) {
		if ( get_post_meta( $post->ID, '_archetype_hide_author_bio', true ) == 'on' ) {
			$hide = true;
		}
		return $hide;
	}
endif;

if ( ! function_exists( 'archetype_link_has_title' ) ) :
	/**
	 * Removes `link` from the array of post formats that do not have a title.
	 *
	 * @since 1.0.0
	 *
	 * @return array An array of post formats.
	 */
	function archetype_link_has_title() {
		/**
		 * Filter the array of post formats that do not have a title.
		 *
		 * @since 1.0.0
		 *
		 * @param array $post_formats An array of post formats.
		 */
		$post_formats = apply_filters( 'archetype_link_has_title', array( 'aside', 'status' ) );

		return $post_formats;
	}
endif;

if ( ! function_exists( 'archetype_post_format_title' ) ) :
	/**
	 * Retrieve the title and URL for the link post format.
	 *
	 * Must be used inside the loop.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function archetype_post_format_title() {
		$title = '';
		$link_url = get_post_meta( get_the_ID(), '_format_link_url', true );
		$link_title = get_post_meta( get_the_ID(), '_format_link_title', true );

		// Set the title.
		if ( ! empty( $link_url ) && ! empty( $link_title ) ) {

			$title = sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark nofollow" target="_blank">%s</a></h1>', esc_url( $link_url ), esc_attr( $link_title ) );

			// Remove the `hide-title` class by filtering the `archetype_hide_title_post_formats` array.
			add_filter( 'archetype_hide_title_post_formats', 'archetype_link_has_title' );

		} else {

			// Remove the filter so it does not alter other posts.
			remove_filter( 'archetype_hide_title_post_formats', 'archetype_link_has_title' );

		}

		return $title;
	}
endif;

if ( ! function_exists( 'archetype_slider_body_classes' ) ) :
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @since 1.0.0
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function archetype_slider_body_classes( $classes ) {
		global $slider_post_id;

		if ( ! is_null( $slider_post_id ) ) {
			$type = get_post_meta( $slider_post_id, '_archetype_slider', true );
			$slider = get_post_meta( $slider_post_id, '_archetype_' . $type, true );
			if ( ! empty( $slider ) && ( 'revolution_slider' === $type && class_exists( 'RevSlider', false ) ) || ( 'layer_slider' === $type && class_exists( 'LS_Sliders', false ) ) ) {
				$classes[] = 'archetype-has-header-slider';
			}
		}

		return $classes;
	}
endif;

if ( ! function_exists( 'archetype_slider_post_id' ) ) :
	/**
	 * Set the global slider post ID.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function archetype_slider_post_id() {
		global $post, $slider_post_id;

		$home_id = get_option( 'page_on_front' );
		$blog_id = get_option( 'page_for_posts' );

		if ( is_front_page() && $home_id ) {
			$post_id = $home_id;
		} else if ( is_home() && $blog_id ) {
			$post_id = $blog_id;
		} else if ( function_exists( 'is_shop' ) && is_shop() ) {
			$post_id = get_option( 'woocommerce_shop_page_id' );
		}

		if ( ! is_singular() && ! isset( $post_id ) ) {
			return null;
		}

		if ( ! isset( $post_id ) ) {
			$post_id = $post->ID;
		}

		$slider_post_id = $post_id;
	}
endif;

if ( ! function_exists( 'archetype_display_slider' ) ) :
	/**
	 * Display the post slider.
	 *
	 * Must be used inside the loop.
	 *
	 * @since 1.0.0
	 */
	function archetype_display_slider() {
		global $slider_post_id;

		if ( ! is_null( $slider_post_id ) ) {
			$type = get_post_meta( $slider_post_id, '_archetype_slider', true );
			$slider = get_post_meta( $slider_post_id, '_archetype_' . $type, true );

			// Display the slider.
			if ( ! empty( $slider ) ) {

				if ( 'revolution_slider' === $type && class_exists( 'RevSlider', false ) ) {
					echo '<div class="header-slider-region">' . archetype_do_shortcode_func( 'rev_slider', array( 'alias' => $slider ) ) . '</div>';
				} else if ( 'layer_slider' === $type && class_exists( 'LS_Sliders', false ) ) {
					global $wpdb;
					$table = $wpdb->prefix.LS_DB_TABLE;
					$result = $wpdb->get_row( $wpdb->prepare( "SELECT slug FROM $table WHERE id = %d LIMIT 1", $slider ), ARRAY_A );
					$id = ! empty( $result['slug'] ) ? $result['slug'] : $slider;
					echo '<div class="header-slider-region">' . archetype_do_shortcode_func( 'layerslider', array( 'id' => $id ) ) . '</div>';
				}
			}
		}
	}
endif;

if ( ! function_exists( 'archetype_post_format_the_content' ) ) :
	/**
	 * Displays the audio
	 *
	 * Must be used inside the loop.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content The post content.
	 */
	function archetype_post_format_the_content( $content ) {
		$content = $GLOBALS['wp_embed']->autoembed( $content );

		return do_shortcode( $content );
	}
endif;

if ( ! function_exists( 'archetype_post_format_audio' ) ) :
	/**
	 * Displays the audio
	 *
	 * Must be used inside the loop.
	 *
	 * @since 1.0.0
	 */
	function archetype_post_format_audio() {
		if ( has_post_format( 'audio' ) && $audio = get_post_meta( get_the_ID(), '_format_audio_embed', true ) ) {
			?>
			<div class="post-audio">
				<?php echo archetype_post_format_the_content( $audio ); ?>
			</div><!-- .post-audio -->
			<?php
		}
	}
endif;

if ( ! function_exists( 'archetype_post_format_video' ) ) :
	/**
	 * Displays the video
	 *
	 * Must be used inside the loop.
	 *
	 * @since 1.0.0
	 */
	function archetype_post_format_video() {
		if ( has_post_format( 'video' ) && $video = get_post_meta( get_the_ID(), '_format_video_embed', true ) ) {
			?>
			<div class="post-video">
				<?php echo archetype_post_format_the_content( $video ); ?>
			</div><!-- .post-video -->
			<?php
		}
	}
endif;

if ( ! function_exists( 'archetype_post_format_gallery_images' ) ) :
	/**
	 * Returns an array of gallery images.
	 *
	 * @since 1.0.0
	 *
	 * @param	int $post_id ID of the post.
	 * @return bool|array
	 */
	function archetype_post_format_gallery_images( $post_id = 0 ) {
		if ( $gallery = get_post_meta( $post_id, '_format_gallery', true ) ) {

			// Search the string for the IDs.
			preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );

			// Turn the field value into an array of IDs.
			if ( isset( $matches[1] ) ) {

				// Found the IDs in the shortcode.
				$ids = explode( ',', $matches[1] );
			} else {

				// The string is only IDs.
				$ids = ! empty( $gallery ) && '' !== $gallery ? explode( ',', $gallery ) : array();
			}

			if ( ! empty( $ids ) ) {
				return $ids;
			}
		}
		return false;
	}
endif;

if ( ! function_exists( 'archetype_filter_post_format_gallery' ) ) :
	/**
	 * Filter the metaboxes added to the gallery post format.
	 *
	 * @since 1.0.0
	 *
	 * @param array $settings The metabox settings.
	 */
	function archetype_filter_post_format_gallery( $settings ) {
		$settings['fields'][] = array(
			'id'      => '_format_gallery_embed',
			'label'   => '',
			'desc'    => sprintf( __( 'Embed images from services like Photobucket, Instagram, or Flickr. You can find a list of supported oEmbed sites in the %1$s. Alternatively, you could use the built-in %2$s shortcode. Which is what the "Create Gallery" button above does, only dynamically.', 'archetype' ), '<a href="http://codex.wordpress.org/Embeds" target="_blank">' . __( 'Wordpress Codex', 'archetype' ) .'</a>', '<code>[gallery]</code>' ),
			'std'     => '',
			'type'    => 'textarea',
		);

		return $settings;
	}
endif;

if ( ! function_exists( 'archetype_post_format_gallery' ) ) :
	/**
	 * Displays the gallery
	 *
	 * Must be used inside the loop.
	 *
	 * @since 1.0.0
	 */
	function archetype_post_format_gallery() {
		$post_id = get_the_ID();

		if ( has_post_format( 'gallery' ) ) {

			// Embeded gallery.
			if ( $gallery = get_post_meta( get_the_ID(), '_format_gallery_embed', true ) ) {

				$content = archetype_post_format_the_content( $gallery );

			} else {

				// Get the gallery images.
				$ids = archetype_post_format_gallery_images( $post_id );

				if ( ! empty( $ids ) ) {
					$content = '<ul class="bxslider">';
					foreach ( $ids as $image_id ) {
						$attachments = get_posts( array(
							'post_type'      => 'attachment',
							'posts_per_page' => 1,
							'include'        => $image_id,
						) );
						if ( $attachments ) {
							foreach ( $attachments as $attachment ) {
								$caption = ! empty( $attachment->post_excerpt ) ? '<div class="caption"><span class="caption-body">' . wpautop( $attachment->post_excerpt ) . '</span></div>' : '';
								if ( ! is_single() ) {
									$content .= sprintf( '<li><a href="%s" rel="bookmark"><img src="%s" alt="%s" />%s</a></li>', esc_url( get_permalink() ), esc_url( wp_get_attachment_url( $attachment->ID ) ), esc_attr( $attachment->post_title ), $caption );
								} else {
									$content .= sprintf( '<li><a href="%s" rel="lightbox[gallery-main]" title="%s"><img src="%s" alt="%s" />%s</a></li>', esc_url( wp_get_attachment_url( $attachment->ID ) ), esc_attr( $attachment->post_excerpt ), esc_url( wp_get_attachment_url( $attachment->ID ) ), esc_attr( $attachment->post_title ), $caption );
								}
							}
						}
					}
					$content .= '</ul>';
				}
			}

			// Display the gallery.
			if ( ! empty( $content ) ) {
				echo '<div class="post-gallery">' . $content . '</div><!-- .post-gallery -->';
			}
		}
	}
endif;

if ( ! function_exists( 'archetype_post_format_quote' ) ) :
	/**
	 * Displays the quote
	 *
	 * @since 1.0.0
	 *
	 * @param string $content Post content.
	 * @return string
	 */
	function archetype_post_format_quote( $content ) {
		if ( has_post_format( 'quote' ) ) {
			$_content  = array();
			$post_id   = get_the_ID();
			$name      = get_post_meta( $post_id, '_format_quote_source_name', true );
			$url       = get_post_meta( $post_id, '_format_quote_source_url', true );
			$title     = get_post_meta( $post_id, '_format_quote_source_title', true );
			$date      = get_post_meta( $post_id, '_format_quote_source_date', true );

			// Add the name & url.
			if ( $name ) {
				$open = $close = '';
				if ( ! $title ) {
					$open = '<cite>';
					$close = '</cite>';
				}
				$_content[] = $url ? sprintf( '%s<a href="%s" rel="nofollow" target="_blank">%s</a>%s', $open, esc_url( $url ), esc_html( $name ), $close ) : $open . esc_html( $name ) .$close;
			}

			// Add the comma.
			if ( $name && ( $title || $date ) ) {
				$_content[] = ', ';
			}

			// Add the title.
			if ( $title ) {
				$_content[] = sprintf( '%s%s%s ', '<cite>', esc_html( $title ), '</cite>' );
			}

			// Add the date.
			if ( $date ) {
				$_content[] = esc_html( $date );
			}

			// Replace the content.
			if ( ! empty( $_content ) ) {
				$cite = $url ? ' cite="' . esc_url( $url ) . '"' : '';
				$content = '<figure>' .
					'<blockquote' . $cite . '>' . $content . '</blockquote>' .
					'<figcaption>' . implode( $_content, '' ) . '</figcaption>' .
				'</figure>';
			}
		}
		return $content;
	}
endif;
