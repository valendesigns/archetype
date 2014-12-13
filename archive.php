<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package archetype
 *
 * @todo  replace archive header title / description with the_archive_title / the_archive_description when wp 4.1 lands
 */

get_header(); ?>

  <section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

      <header class="page-header">
        <h1 class="page-title">
          <?php
          if ( is_category() ) :
            single_cat_title();

          elseif ( is_tag() ) :
            single_tag_title();

          elseif ( is_author() ) :
            printf( __( 'Author: %s', 'archetype' ), '<span class="vcard">' . get_the_author() . '</span>' );

          elseif ( is_day() ) :
            printf( __( 'Day: %s', 'archetype' ), '<span>' . get_the_date() . '</span>' );

          elseif ( is_month() ) :
            printf( __( 'Month: %s', 'archetype' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'archetype' ) ) . '</span>' );

          elseif ( is_year() ) :
            printf( __( 'Year: %s', 'archetype' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'archetype' ) ) . '</span>' );

          elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
            _e( 'Asides', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
            _e( 'Galleries', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
            _e( 'Images', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
            _e( 'Videos', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
            _e( 'Quotes', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
            _e( 'Links', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
            _e( 'Statuses', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
            _e( 'Audios', 'archetype' );

          elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
            _e( 'Chats', 'archetype' );

          else :
            _e( 'Archives', 'archetype' );

          endif;
          ?>
        </h1>

        <?php
        // Show an optional term description.
        $term_description = term_description();
        if ( ! empty( $term_description ) ) :
          printf( '<div class="taxonomy-description">%s</div>', $term_description );
        endif;
        ?>
      </header><!-- .page-header -->

      <?php get_template_part( 'loop' ); ?>

    <?php else : ?>

      <?php get_template_part( 'content', 'none' ); ?>

    <?php endif; ?>

    </main><!-- #main -->
  </section><!-- #primary -->

<?php do_action( 'archetype_sidebar' ); ?>
<?php get_footer(); ?>
