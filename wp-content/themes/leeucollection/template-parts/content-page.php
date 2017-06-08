<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Leeu_Collection
 * @since Leeu Collection 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="leeu-heading-wrap scroll-anim" data-anim="fade-up">
			<div class="text-center">
				<?php the_title( '<h1 class="entry-title ucase">', '</h1>' ); ?>
			</div>	
		</div>
	</header><!-- .entry-header -->

	<?php leeucollection_post_thumbnail(); ?>

	<div class="entry-content scroll-anim" data-anim="fade-up" data-anim-delay="100">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'leeucollection' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'leeucollection' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->
	<div class="linking-wrap"> 
		<div class="row">
			<div class="col-6 rm-pad">
				<div class="two-section-link"> 
					<div class="section-content">Leeu Estates Executive Suite LC</div>
					<div class="cstm-btn-wrapper contact-email">
						<a href="javascript:void(0)" class="cstm-btn arrow-btn text-center">REQUEST</a>
					</div>
				</div>
			</div>
			<div class="col-6 rm-pad">
				<div class="two-section-link"> 
					<div class="section-content">Leeu Estates Executive Suite LC</div>
					<div class="cstm-btn-wrapper contact-email">
						<a href="javascript:void(0)" class="cstm-btn arrow-btn text-center">REQUEST</a>
					</div>
				</div>					
			</div>
		</div>
	</div>	
	<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'leeucollection' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>

</article><!-- #post-## -->
