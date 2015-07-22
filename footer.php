<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Archetype
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'archetype_before_footer' ); ?>

	<footer id="colophon" role="contentinfo">
		
		<div class="<?php archetype_site_footer_classes(); ?>" style="<?php archetype_site_footer_styles(); ?>">

			<div class="col-full">

				<?php
				/**
				 * Default hooks
				 *
				 * @hooked archetype_footer_widgets - 10
				 */
				do_action( 'archetype_footer_widgets' ); ?>

			</div><!-- .col-full -->

		</div><!-- .site-footer -->

		<?php
		/**
		 * Default hooks
		 *
		 * @hooked archetype_social_icons - 10
		 */
		do_action( 'archetype_between_footers' ); ?>

		<div class="<?php archetype_site_info_classes(); ?>" style="<?php archetype_site_info_styles(); ?>">

			<div class="col-full">

				<?php
				/**
				 * Default hooks
				 *
				 * @hooked archetype_credit - 20
				 */
				do_action( 'archetype_site_info_footer' ); ?>

			</div><!-- .col-full -->

		</div><!-- .site-info -->

	</footer><!-- #colophon -->

	<?php do_action( 'archetype_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
