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
	<?php
	$link_heading_left 		= carbon_get_post_meta($post->ID, "crb_bottom_link_heading_left");
	$link_button_text_left 	= carbon_get_post_meta($post->ID, "crb_bottom_link_button_text_left");
	$link_button_link_left 	= carbon_get_post_meta($post->ID, "crb_bottom_link_button_link_left");

	$link_heading_right 	= carbon_get_post_meta($post->ID, "crb_bottom_link_heading_right");
	$link_button_text_right = carbon_get_post_meta($post->ID, "crb_bottom_link_button_text_right");
	$link_button_link_right = carbon_get_post_meta($post->ID, "crb_bottom_link_button_link_right");
	?>
	<div class="linking-wrap"> 
		<div class="row">
			<div class="col-6 rm-pad">
				<div class="two-section-link">
					<?php
					if(!empty($link_heading_left))
					{
						?>
						<div class="section-content"><?php echo $link_heading_left; ?></div>
						<?php
					}
					if(!empty($link_button_text_left) && !empty($link_button_link_left))
					{
						?>
						<div class="cstm-btn-wrapper contact-email">
							<a href="<?php echo $link_button_link_left; ?>" class="cstm-btn arrow-btn text-center"><?php echo $link_button_text_left; ?></a>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="col-6 rm-pad">
				<div class="two-section-link">
					<?php
					if(!empty($link_heading_right))
					{
						?>
						<div class="section-content"><?php echo $link_heading_right; ?></div>
						<?php
					}
					if(!empty($link_button_text_right) && !empty($link_button_link_right))
					{
						?>
						<div class="cstm-btn-wrapper contact-email">
							<a href="<?php echo $link_button_link_right; ?>" class="cstm-btn arrow-btn text-center"><?php echo $link_button_text_right; ?></a>
						</div>
						<?php
					}
					?>
				</div>					
			</div>
		</div>
	</div>	
	<?php
		/*edit_post_link(
			sprintf(
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'leeucollection' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);*/
	?>

</article><!-- #post-## -->
