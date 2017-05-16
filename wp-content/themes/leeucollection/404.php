<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Leeu_Collection
 * @since Leeu Collection 1.0
 */

get_header(); ?>
    <section id="site-main">
		<div class="container">
			<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
				<h1 class="ucase"><?php _e( 'Oops! That page can&rsquo;t be found.', 'leeucollection' ); ?></h1>
			</div>
			<div class="page-content">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'leeucollection' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->
		</div>
	</section>
<?php get_footer(); ?>
