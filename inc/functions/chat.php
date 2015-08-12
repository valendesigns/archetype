<?php
/**
 * Archetype chat functions.
 *
 * @package Archetype
 * @subpackage Chat
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_chat_content' ) ) :
	/**
	 * This function filters the post content when viewing a post with the "chat" post format.
	 * It formats the content with structured HTML markup to make it easy for theme developers
	 * to style chat posts. The advantage of this solution is that it allows for more than
	 * two speakers (like most solutions). You can have 100s of speakers in your chat post,
	 * each with their own, unique classes for styling.
	 *
	 * Based on the collaborative work of David Chandra & Justin Tadlock.
	 *
	 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
	 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @param string $content The content of the post.
	 * @return string $chat_content The formatted content of the post.
	 */
	function archetype_chat_content( $content ) {
		// If this is not a 'chat' post, return the content.
		if ( ! has_post_format( 'chat' ) ) {
			return $content;
		}

		// Set the global variable of speaker IDs to a new, empty array for this chat.
		$_post_format_chat_ids = array();

		// Set the post ID.
		$post_id = get_the_ID();

		/**
		 * Filter the regular expression for the 'header: text' separator.
		 *
		 * @since 1.0.0
		 *
		 * @param string $header_regex The regex separator for 'header: text'. Default is '/:\s/'.
		 * @param int    $post_id      The post ID.
		 */
		$header_regex = apply_filters( 'archetype_chat_header_regex', '/:\s/', $post_id );

		/**
		 * Filter the regular expression for the '[date] author' separator.
		 *
		 * @since 1.0.0
		 *
		 * @param string $date_regex The regex separator for '[date] author'. Default is '/\[(.*?)\]\s/'.
		 * @param int    $post_id    The post ID.
		 */
		$date_regex = apply_filters( 'archetype_chat_date_regex', '/\[(.*?)\]\s/', $post_id );

		/**
		 * Filter the number of chat responses that are displayed in the archive view.
		 *
		 * You can filter this to a specific number, or to -1 or 0 to display all chat responses.
		 *
		 * @since 1.0.0
		 *
		 * @param int $chat_excerpt_responses The number of chat responses. Default is '5'.
		 * @param int $post_id                The post ID.
		 */
		$chat_excerpt_responses = apply_filters( 'archetype_chat_excerpt_responses', 5, $post_id );

		/**
		 * Filter the read more text for chats.
		 *
		 * @since 1.0.0
		 *
		 * @param string $chat_more_text The more text. Default is 'Continue reading'.
		 * @param int    $post_id        The post ID.
		 */
		$chat_more_text = apply_filters( 'archetype_chat_more_text', __( 'Continue reading', 'archetype' ), $post_id );

		// Set response count.
		$chat_excerpt_response_count = 0;

		// Set chat row to open.
		$chat_start = true;

		// Split the content to get individual chat rows.
		$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

		// Set the content vars to empty strings for some trickiness later.
		$original_content = $content;
		$content = '';
		$chat_content = '';

		// Loop through each row and format the output.
		foreach ( $chat_rows as $chat_row ) {
			if ( ! is_singular() && $chat_excerpt_response_count >= $chat_excerpt_responses && $chat_excerpt_responses > 0 ) {
				continue;
			}

			// Look for the date.
			preg_match_all( $date_regex, $chat_row, $date_matches );

			// Look for the separator.
			preg_match( $header_regex, $chat_row, $header_matches );

			// If a separator is found, create a new chat row with header and text.
			if ( isset( $header_matches[0] ) ) {
				// Iterate response count.
				$chat_excerpt_response_count++;

				// Split the chat row into header/text.
				$chat_row_split = explode( $header_matches[0], trim( $chat_row ), 2 );

				// Get the chat header and strip tags.
				$get_chat_header = trim( $chat_row_split[0] );

				// Get the chat text.
				$get_chat_text = trim( $chat_row_split[1] );

				// Has formated date.
				if ( isset( $date_matches[1][0] ) ) {
					// Remove the date from the author string.
					$get_chat_text = str_replace( $date_matches[0][0], '', strip_tags( $get_chat_text ) );
					$get_chat_author = str_replace( $date_matches[0][0], '', strip_tags( $get_chat_header ) );

					// Add time markup & filter.
					$get_chat_date = '<time class="chat-datetime" datetime="' . $date_matches[1][0] . '">' . date_i18n( get_option( 'time_format' ), strtotime( $date_matches[1][0] ) ) . '</time>';
				} else {
					// No date but we need these variables later.
					// Set the author to the header string since there is not a date in it.
					$get_chat_author = strip_tags( $get_chat_header );

					// Date is left empty.
					$get_chat_date = '';
				}

				// Let's sanitize the chat author to avoid craziness and differences like "John" and "john".
				$_chat_author = str_replace( array( ' ', '8217' ), array( '-', '' ), strtolower( strip_tags( $get_chat_author ) ) );

				// Add the chat author to the array.
				$_post_format_chat_ids[] = $_chat_author;

				// Make sure the array only holds unique values.
				$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

				// Fix array keys.
				$_post_format_chat_ids = array_values( $_post_format_chat_ids );

				/*
				 * Get the chat row ID (based on chat author) to give a specific class to each row for styling.
				 * Uses the array key for the chat author and adds "1" to avoid an ID of "0".
				 */
				$speaker_id = absint( array_search( $_chat_author, $_post_format_chat_ids ) ) + 1;

				/**
				 * Filter the chat author.
				 *
				 * @since 1.0.0
				 *
				 * @param string $chat_text  The chat author.
				 * @param int    $post_id    The post ID.
				 * @param int    $speaker_id The speaker ID.
				 */
				$chat_author = apply_filters( 'archetype_chat_author', $get_chat_author, $post_id, $speaker_id );

				// Add markup around the chat author.
				$chat_author = '<cite class="fn">' . $chat_author . '</cite>';

				/**
				 * Filter the chat text.
				 *
				 * @since 1.0.0
				 *
				 * @param string $chat_text  The chat text.
				 * @param int    $post_id    The post ID.
				 * @param int    $speaker_id The speaker ID.
				 */
				$chat_text = apply_filters( 'archetype_chat_text', $get_chat_text, $post_id, $speaker_id );

				// Remove line breaks.
				$chat_text = str_replace( array( "\r", "\n", "\t" ), '', $chat_text );

				// Close the chat row.
				$chat_content .= ! $chat_start ? "</div>\n\t\t" . '</li><!-- .chat-row -->' : '';

				// Set open row.
				$chat_start = false;

				// Open the chat row.
				$chat_content .= "\n\t\t" . '<li class="chat-response ' . sanitize_html_class( "chat-author-{$speaker_id}" ) . '">';

				// Add the chat header.
				$chat_content .= "\n\t\t\t" . '<header class="chat-header">';

				// Add the chat date.
				$chat_content .= $get_chat_date ? "\n\t\t\t\t" . $get_chat_date : '';

				// Add the chat author.
				$chat_content .= "\n\t\t\t\t" . '<figure class="chat-author ' . sanitize_html_class( "chat-author-{$_chat_author}" ) . ' vcard">' . $chat_author . '</figure>';

				// Close the chat header.
				$chat_content .= "\n\t\t\t" . '</header>';

				// Add the chat text.
				$chat_content .= "\n\t\t\t" . '<div class="chat-content">' . $chat_text;
			} else if ( ! empty( $chat_row ) ) {
				// Add to the chat.
				if ( $chat_start ) {
					// Add text found at the beginning of the post back to the content.
					$content .= $chat_row;
				} else {
					/**
					 * Filter the chat text.
					 *
					 * @since 1.0.0
					 *
					 * @param string $chat_text  The chat text.
					 * @param int    $post_id    The post ID.
					 * @param int    $speaker_id The speaker ID.
					 */
					$chat_text = apply_filters( 'archetype_chat_text', $chat_row, $post_id, $speaker_id );

					$chat_content .= str_replace( array( "\r", "\n", "\t" ), '', $chat_text );
				}
			}
		}

		if ( ! empty( $chat_content ) ) {
			// Open the chat transcript and give it a unique ID based on the post ID.
			$chat_content = $content . "\t" . '<ol id="chat-transcript-' . esc_attr( $post_id ) . '" class="chat-transcript">' . $chat_content;

			// Close the chat row.
			$chat_content .= "</div>\n\t\t" . '</li><!-- .chat-response -->';

			// Close the chat transcript.
			$chat_content .= "\n\t</ol><!-- .chat-transcript -->\n";

			if ( ! is_singular() && $chat_excerpt_response_count >= $chat_excerpt_responses && $chat_excerpt_responses > 0 ) {

				$chat_content .= "\n\t\t" . '<p><a href="' . get_permalink( $post_id ) . '" class="more-link">' . $chat_more_text . '</a></p>';

			}
		} else {
			$chat_content = $original_content;
		}

		/**
		 * Filter the chat content.
		 *
		 * @since 1.0.0
		 *
		 * @param string $chat_content The chat content.
		 * @param int    $post_id      The post ID.
		 */
		return apply_filters( 'archetype_chat_content', $chat_content, $post_id );
	}
endif;
