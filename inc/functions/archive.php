<?php
/**
 * Template functions used for archives.
 *
 * @package Archetype
 * @subpackage Archive
 * @since 1.0.0
 */

if ( ! function_exists( 'archetype_archive_header' ) ) :
	/**
	 * Display the archive header & description
	 *
	 * @since 1.0.0
	 */
	function archetype_archive_header() {
		?>
		<header class="page-header">
			<h1 class="page-title">
				<?php the_archive_title(); ?>
			</h1>

			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header><!-- .page-header -->
		<?php
	}
endif;
