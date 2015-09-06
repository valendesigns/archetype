<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Archetype
 */

?>

		<?php archetype_container_column( true ); ?>

	</div><!-- #content -->

	<?php do_action( 'archetype_before_footer' ); ?>

	<footer id="colophon" role="contentinfo">

		<?php
		/**
		 * Default hooks
		 *
		 * @hooked archetype_site_footer - 10
		 * @hooked archetype_social_icons - 20
		 * @hooked archetype_site_info - 30
		 */
		do_action( 'archetype_footer' ); ?>

	</footer><!-- #colophon -->

	<?php do_action( 'archetype_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
