<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Material Design
 */

?>

	</div><!-- #content -->
	<footer class="page-footer primary">
		<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) ): ?>
			<div class="container">
				<div class="row">
					<?php if ( is_active_sidebar( 'sidebar-2' ) ): ?>
						<div class="col l6 s12">
								<?php get_sidebar('footerleft'); ?>
						</div>
					<?php endif; ?>
					<?php if ( is_active_sidebar( 'sidebar-3' ) ): ?>
						<div class="col l4 offset-l2 s12">
								<?php get_sidebar('footerright'); ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			</div>
			<div class="footer-copyright">
				<div class="container">
				© <?php echo date('Y'); ?> Copyright <?php bloginfo( 'name' ); ?>
				<a class="grey-text text-lighten-4 right" href="#!">More Links</a>
				</div>
			</div>
		</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
