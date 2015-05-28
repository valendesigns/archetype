<?php
/**
 * Template functions used for the site comments.
 *
 * @package Archetype
 * @subpackage Comments
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_display_comments' ) ) {
	/**
	 * Archetype display comments
	 *
	 * @since 1.0.0
	 */
	function archetype_display_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || '0' != get_comments_number() ) {
			comments_template();
		}
	}
}

if ( ! function_exists( 'archetype_comment' ) ) {
	/**
	 * Archetype comment template
	 *
	 * @since 1.0.0
	 *
	 * @param		object	$comment Comment to display.
	 * @param		array		$args An array of arguments.
	 * @param		int			$depth Depth of comment.
	 */
	function archetype_comment( $comment, $args, $depth ) {
		// The first part of the selector used to identify the comment to respond below.
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}

		$comment_class = array();

		// Add parent class.
		if ( ! empty( $args['has_children'] ) ) {
			$comment_class[] = 'parent';
		}

		// Add avatar classes.
		if ( get_option( 'show_avatars' ) ) {
			$comment_class[] = 'show-avatars';
		}

		if ( $avatar = get_avatar( $comment, 120 ) ) {
			$comment_class[] = 'with-avatar';
			$avatar = str_replace( '<img', '<img itemprop="image"', $avatar );
		} else {
			$comment_class[] = 'without-avatar';
		}

		// Ratings.
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

		// Schema.
		$schema = array(
			'itemprop' => 'comment',
			'itemtype' => 'Comment',
		);

		// Viewing a WooCommerce product.
		if ( function_exists( 'is_product' ) && is_product() ) {
			// Change schema to a rating.
			$schema = array(
				'itemprop' => 'review',
				'itemtype' => 'Review',
			);

			// Verify purchase.
			$verified = get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' && wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID );
		}
		?>

		<<?php echo esc_attr( $tag ); ?> itemprop="<?php echo esc_attr( $schema['itemprop'] ); ?>" itemscope itemtype="https://schema.org/<?php echo esc_attr( $schema['itemtype'] ); ?>" <?php comment_class( $comment_class ) ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-body">

			<div id="div-comment-<?php comment_ID() ?>" class="comment-content">

				<div class="comment-meta commentmetadata">
					<?php if ( $rating && 'yes' === get_option( 'woocommerce_enable_review_rating' ) ) : ?>

						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'archetype' ), $rating ) ?>">
							<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'archetype' ); ?></span>
						</div>

					<?php endif; ?>

					<div class="comment-author vcard">
						<?php
						// Avatar.
						echo $avatar;

						// Author.
						printf( __( '<cite class="fn" itemprop="author">%s</cite>', 'archetype' ), get_comment_author_link() );

						// Verified owner.
						if ( isset( $verified ) && true === $verified ) {
							echo '<em class="verified">(' . __( 'verified owner', 'archetype' ) . ')</em> ';
						}
						?>
					</div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>

					<a href="<?php echo esc_url( htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ); ?>" class="comment-date">
						<?php echo '<time itemprop="datePublished" datetime="' . get_comment_date( 'c' ) . '">' . human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) . ' ago' . '</time>'; ?>
					</a>

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'archetype' ); ?></em>
					<?php endif; ?>

				</div>

				<div itemprop="description" class="description"><?php comment_text(); ?></div>

				<?php edit_comment_link( __( 'Edit', 'archetype' ), '	', '' ); ?>

			</div>

		</div>
	<?php
	}
}
