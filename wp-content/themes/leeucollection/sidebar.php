<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Leeu_Collection
 * @since Leeu Collection 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
