<?php
/*
Template Name: Artists Listing
*/

get_header(); ?>
	<?php
	$post_id 	= $post->ID;
	$hotel_id 	= get_hotel_id($post_id);
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;

	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);

	$page_heading = (@$post_meta['_crb_page_heading'][0]) ? $post_meta['_crb_page_heading'][0] : $post->post_title;
    ?>
	<section id="site-main">
	    <div class="mobile-page-heading">
	    	<?php echo $page_heading;?>
	    </div>
		<div class="container">
			<div class="leeu-heading-wrap scroll-anim" data-anim="fade-up">
				<div class="row">
					<div class="col-2 rm-pad"></div>
					<div class="col-8 rm-pad">
						<div class="text-center">
							<div class="leeu-text ucase" itemprop="name">
								<?php
								if($top_most_parent_post)
								{
									echo $top_most_parent_post->post_title;
								}
								?>
							</div>
							<h1 class="ucase" itemprop="name"><?php echo $page_heading; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col-12 rm-pad room-listing-contain">
				<div class="row listing-row">
					<div class="col-2 rm-pad-left">
						<div class="side-nav-contain">
							<div class="scroll-anim" data-anim="fade-up">
								<div class="side-nav-wrap">
									<?php
									include_once("leeu_sidebar.php");
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-8">
						<?php
						$args = array(
							'posts_per_page' => '-1',
							'orderby' => 'post_date',
							'order' => 'DESC',
							'post_type' => 'leeu-discover',
							'post_parent' => $post->ID,
						);

						$the_query = new WP_Query( $args );
						if($the_query->have_posts())
						{
							?>
							<div class="listing-box listing-row">
								<?php
								$x = 0;
								$cols = 2;
								while($the_query->have_posts())
								{
									$the_query->the_post();
									$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), '500x334');
									if($x == 0)
									{
										?>
										<div class="scroll-anim full_img animate-custom" data-anim="fade-up">
											<div class="row detail-row">
												<div class="mgb-30 clearfix">
										<?php
									}
									$col6_class 		= "pdr-0";
									$scroll_anim_class 	= "";
									$scroll_anim_attr 	= "";
									$art_cat_class 		= "art_cat";
									if($x == 1)
									{
										$col6_class 		= "pdl-0";
										$scroll_anim_class 	= "scroll-anim animate-custom";
										$scroll_anim_attr 	= 'data-anim="fade-up" data-anim-delay="100"';
										$art_cat_class 		= "art_cat2";
									}
									?>
									<div class="col-6 <?php echo $col6_class; ?>">
										<div class="<?php echo $scroll_anim_class; ?>" <?php echo $scroll_anim_attr; ?>>
											<div class="<?php echo $art_cat_class; ?> full-img">
												
												<?php
												if(!empty($image[0]))
												{
													?>
													<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="" /></a>
													<?php
												}
												?>
											</div>
											<div class="desc-heading mgt-25">
												<?php the_title(); ?>
											</div>
										</div>
									</div>
									<?php
									$x++;
									if($x == $cols)
									{
										$x = 0;
										?>
												</div>
											</div>
										</div>
										<?php
									}
								}
								wp_reset_postdata();
								?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>