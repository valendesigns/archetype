<?php
/**
 * Template functions used for posts.
 *
 * @package Archetype
 * @subpackage Post
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_post_format_media' ) ) :
	/**
	 * Display an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 *
	 * @since 1.0.0
	 */
	function archetype_post_format_media() {
		/**
		 * Filter the format media.
		 */
		do_action( 'archetype_post_format_media' );

		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		$attachment = get_post( get_post_thumbnail_id() );
		$caption = ! empty( $attachment->post_excerpt ) ? '<div class="caption"><span class="caption-body">' . wpautop( $attachment->post_excerpt ) . '</span></div>' : '';

		if ( is_singular() ) {
		?>

		<div class="post-thumbnail">
			<?php
				the_post_thumbnail();
				echo $caption;
			?>
		</div><!-- .post-thumbnail -->

		<?php } else { ?>

		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" aria-hidden="true">
				<?php the_post_thumbnail( 'post-thumbnail', array( 'itemprop' => 'image', 'alt' => get_the_title() ) ); ?>
			</a>
			<?php echo $caption; ?>
		</div>
	
		<?php } // End is_singular()
	}
endif;

if ( ! function_exists( 'archetype_post_header' ) ) :
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function archetype_post_header() {
		if ( is_single() ) {
			$title = the_title( '<h1 class="entry-title" itemprop="name headline">', '</h1>', false );
		} else {
			$title = the_title( sprintf( '<h1 class="entry-title" itemprop="name headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>', false );
		}
		if ( has_post_format( 'link' ) && $link_title = archetype_post_format_title() ) {
			$title = $link_title;
		}
		?>
		<header class="<?php echo archetype_entry_header_class(); ?>">
			<?php echo $title; ?>
		</header><!-- .entry-header -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_post_content' ) ) :
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function archetype_post_content() {
		$has_content = archetype_has_content();
		?>
		<div class="entry-content <?php echo ! $has_content ? 'no-content' : ''; ?>" itemprop="articleBody">
			<?php if ( $has_content ) { ?>
			<div class="entry-body">
				<?php
				the_content(
					sprintf(
						__( 'Continue reading %s', 'archetype' ),
						'<span class="screen-reader-text">' . get_the_title() . '</span>'
					)
				); ?>
			</div>
			<?php } ?>

			<?php archetype_page_navigation(); ?>
		</div><!-- .entry-content -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_post_author_bio' ) ) :
	/**
	 * Display the post author bio
	 *
	 * @since 1.0.0
	 */
	function archetype_post_author_bio() {
		if ( is_singular() && get_the_author_meta( 'description' ) && ! archetype_hide_author_bio() ) {
			get_template_part( 'author-bio' );
		}
	}
endif;

if ( ! function_exists( 'archetype_post_meta' ) ) :
	/**
	 * Displays meta information for the author, categories, tags etc.
	 *
	 * @since 1.0.0
	 */
	function archetype_post_meta() {
		?>
		<aside class="entry-meta">
			<?php
			if ( is_sticky() && is_home() && ! is_paged() ) {
				printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'archetype' ) );
			}

			/**
			 * Hook before the meta displays.
			 */
			do_action( 'archetype_post_meta' );

			$format = get_post_format();
			if ( current_theme_supports( 'post-formats', $format ) ) {
				printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
					sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'archetype' ) ),
					esc_url( get_post_format_link( $format ) ),
					get_post_format_string( $format )
				);
			}

			if ( in_array( get_post_type(), array( 'post', 'project', 'attachment' ) ) ) {
				$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
					$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
				}

				$time_string = sprintf( $time_string,
					esc_attr( get_the_date( 'c' ) ),
					get_the_date(),
					esc_attr( get_the_modified_date( 'c' ) ),
					get_the_modified_date()
				);

				printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
					_x( 'Posted on', 'Used before publish date.', 'archetype' ),
					esc_url( get_permalink() ),
					$time_string
				);
			}

			if ( 'post' == get_post_type() ) {
				if ( ( is_singular() || is_multi_author() ) && ! archetype_hide_author_bio() ) {
					printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
						_x( 'Author', 'Used before post author name.', 'archetype' ),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						get_the_author()
					);
				}

				$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'archetype' ) );
				if ( $categories_list && archetype_categorized_blog() ) {
					printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
						_x( 'Categories', 'Used before category names.', 'archetype' ),
						$categories_list
					);
				}

				$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'archetype' ) );
				if ( $tags_list ) {
					printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
						_x( 'Tags', 'Used before tag names.', 'archetype' ),
						$tags_list
					);
				}
			}

			if ( is_attachment() && wp_attachment_is_image() ) {
				// Retrieve attachment metadata.
				$metadata = wp_get_attachment_metadata();

				printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
					_x( 'Full size', 'Used before full size attachment link.', 'archetype' ),
					esc_url( wp_get_attachment_url() ),
					$metadata['width'],
					$metadata['height']
				);
			}

			if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
				echo '<span class="comments-link">';
				comments_popup_link( __( 'Leave a comment', 'archetype' ), __( '1 Comment', 'archetype' ), __( '% Comments', 'archetype' ) );
				echo '</span>';
			}

			edit_post_link( __( 'Edit', 'archetype' ), '<span class="edit-link">', '</span>' );
			?>
		</aside>
		<?php
	}
endif;
