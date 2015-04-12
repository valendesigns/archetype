<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package archetype
 */
?>

    </div><!-- .col-full -->
  </div><!-- #content -->

  <?php do_action( 'archetype_before_footer' ); ?>

  <footer id="colophon" class="site-footer" role="content-info">
    <div class="col-full">

      <?php
      /**
       * @hooked archetype_footer_widgets - 10
       * @hooked archetype_credit - 20
       */
      do_action( 'archetype_footer' ); ?>

    </div><!-- .col-full -->
  </footer><!-- #colophon -->

  <?php do_action( 'archetype_after_footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
