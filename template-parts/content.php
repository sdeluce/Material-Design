<?php
/**
 * Template part for displaying posts.
 *
 * @package Material Design
 */

?>

<div class="col l4 m6 s12">
	<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
		<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'blog'); ?>

		<div class="card-image waves-effect waves-block waves-light">
			<img src="<?php echo $thumb[0]; ?>">
		</div>
		
		<div class="card-content">
			<header class="card-title">
				<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php materialdesign_categories(); ?>
			</header><!-- .entry-header -->

			<?php
				the_excerpt();/* translators: %s: Name of current post */
				// the_content( sprintf(
				// 	wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'materialdesign' ), array( 'span' => array( 'class' => array() ) ) ),
				// 	the_title( '<span class="screen-reader-text">"', '"</span>', false )
				// ) );
			?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php //materialdesign_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'materialdesign' ),
					'after'  => '</div>',
				) );
			?>
			<footer>
				<?php materialdesign_card_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-content -->
	
		
	</article><!-- #post-## -->
</div>
