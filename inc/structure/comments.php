<?php
/**
 * Template functions used for the site comments.
 *
 * @package archetype
 */

if ( ! function_exists( 'archetype_display_comments' ) ) {
  /**
   * Archetype display comments
   * @since  1.0.0
   */
  function archetype_display_comments() {
    // If comments are open or we have at least one comment, load up the comment template
    if ( comments_open() || '0' != get_comments_number() ) :
      comments_template();
    endif;
  }
}

if ( ! function_exists( 'archetype_comment' ) ) {
  /**
   * Archetype comment template
   * @since 1.0.0
   */
  function archetype_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;

    if ( 'div' == $args['style'] ) {
      $tag = 'div';
      $add_below = 'comment';
    } else {
      $tag = 'li';
      $add_below = 'div-comment';
    }
    ?>
    <<?php echo esc_attr( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <div class="comment-body">
      
      <div id="div-comment-<?php comment_ID() ?>" class="comment-content">
        
        <div class="comment-meta commentmetadata">
          <div class="comment-author vcard">
            <?php echo get_avatar( $comment, 120 ); ?>
            <?php printf( __( '<cite class="fn">%s</cite>', 'archetype' ), get_comment_author_link() ); ?>
          </div>
          
           <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div>
          
          <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
            <?php echo '<time>' . human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago' . '</time>'; ?>
          </a>
          
          <?php if ( $comment->comment_approved == '0' ) : ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'archetype' ); ?></em>
          <?php endif; ?>

        </div>
      
        <?php comment_text(); ?>
        
        <?php edit_comment_link( __( 'Edit', 'archetype' ), '  ', '' ); ?>

      </div>
    
    </div>
  <?php
  }
}