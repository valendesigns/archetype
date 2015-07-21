<?php
/**
 * Template functions used for pages.
 *
 * @package Archetype
 * @subpackage Page
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_page_media' ) ) :
	/**
	 * Display an optional featured image.
	 *
	 * @since 1.0.0
	 */
	function archetype_page_media() {
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

		<?php } // End is_singular()
	}
endif;

if ( ! function_exists( 'archetype_page_header' ) ) :
	/**
	 * Display the post header with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function archetype_page_header() {
		if ( is_page_template( 'template-homepage.php' ) ) {
			return;
		}
		?>
		<header class="<?php echo archetype_entry_header_class(); ?>">
			<?php the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<?php
	}
endif;

if ( ! function_exists( 'archetype_page_content' ) ) :
	/**
	 * Display the post content with a link to the single post
	 *
	 * @since 1.0.0
	 */
	function archetype_page_content() {
		?>
		<div class="entry-content" itemprop="mainContentOfPage">
			<?php the_content(); ?>
			<?php archetype_page_navigation(); ?>
		</div><!-- .entry-content -->
		<?php
	}
endif;
