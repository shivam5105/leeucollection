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
		<div class="container error-404-page">
			<div class="text-center">
				<h1 class="ucase"><?php _e( '404', 'leeucollection' ); ?></h1>
			</div>
			<div class="page-content">
				<p>sorry this page does not exist</p>
				<p>it might have been retired or moved</p>

				<div class="cstm-btn-wrapper text-center">
					<a href="<?php echo home_url(); ?>" class="cstm-btn arrow-btn">Home</a>
				</div>
			</div><!-- .page-content -->
		</div>
	</section>
<?php get_footer(); ?>
