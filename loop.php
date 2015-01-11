<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: http://codex.wordpress.org/The_Loop
 *
 * @package archetype
 */

do_action( 'archetype_loop_before' );

while ( have_posts() ) : the_post();

  /* Include the Post-Format-specific template for the content.
   * If you want to override this in a child theme, then include a file
   * called content-___.php (where ___ is the Post Format name) and that will be used instead.
   */
  get_template_part( 'content', get_post_format() );

endwhile;

/**
 * @hooked archetype_posts_navigation - 10
 */
do_action( 'archetype_loop_after' );