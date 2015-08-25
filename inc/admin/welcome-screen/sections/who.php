<?php
/**
 * Welcome screen who are woo template
 * @package Archetype
 * @subpackage Welcome
 * @since 1.0.0
 */

?>
<div id="who" class="feature-section three-col" style="margin-bottom: 1.618em; padding-top: 1.618em; overflow: hidden;">
	<div class="col">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/valen.png'; ?>" alt="<?php esc_html_e( 'The Valen Designs Team', 'archetype' ); ?>" class="image-50" width="440" />
		<h4><?php esc_html_e( 'Who is Valen Designs?', 'archetype' ); ?></h4>
		<p><?php esc_html_e( 'The simple answer is WordPress Core contributing developer & Customizer component maintainer Derek Herman.', 'archetype' ); ?></p>
		<p><a href="http://valendesigns.com" class="button"><?php esc_html_e( 'Come Visit Me', 'archetype' ); ?></a></p>
	</div>

	<div class="col">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/github.png'; ?>" alt="<?php esc_html_e( 'Can I contribute to Archetype?', 'archetype' ); ?>" class="image-50" width="440" />
		<h4><?php esc_html_e( 'Can I Contribute?', 'archetype' ); ?></h4>
		<p><?php esc_html_e( 'Found a bug? Want to contribute a patch or create a new feature? GitHub is the place to go! Or would you like to translate Archetype into your language? Get involved at Transifex.', 'archetype' ); ?></p>
		<p>
			<a href="http://github.com/valendesigns/archetype-issues/" class="button"><?php esc_html_e( 'Archetype at GitHub', 'archetype' ); ?></a>
			<a href="https://www.transifex.com/projects/p/archetype/" class="button"><?php esc_html_e( 'Archetype at Transifex', 'archetype' ); ?></a>
		</p>
	</div>

	<div class="col">
		<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/themeforest.png'; ?>" alt="<?php esc_html_e( 'Give us a ThemeForest.net review.', 'archetype' ); ?>" class="image-50" width="440" />
		<h4><?php esc_html_e( 'Are you enjoying Archetype?', 'archetype' ); ?></h4>
		<p><?php echo sprintf( esc_html__( 'Why not leave a review on %sThemeForest.net%s? We\'d really appreciate it! :-)', 'archetype' ), '<a href="http://themeforest.net/user/valendesigns">', '</a>' ); ?></p>
	</div>
</div>
