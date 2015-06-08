<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Material Design
 */

if ( ! is_active_sidebar( 'sidebar-3' ) ) {
	return;
}
?>

<div class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-3' ); ?>
</div><!-- #secondary -->
