<?php
/*
Template Name: Press
*/	
get_header(); ?>
	<?php
	$post_id 	= $post->ID;
	$hotel_id 	= get_hotel_id($post_id);
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;

	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);

	$page_heading = (@$post_meta['_crb_page_heading'][0]) ? $post_meta['_crb_page_heading'][0] : $post->post_title;
    ?>
	<section id="site-main" class="clearfix">
		<div class="container">
			<div class="leeu-heading-wrap scroll-anim" data-anim="fade-up">
				<div class="row">
					<div class="col-2 rm-pad"></div>
					<div class="col-8 rm-pad">
						<div class="text-center">
							<!-- <div class="leeu-text ucase" itemprop="name"><?php echo $top_most_parent_post->post_title;?></div> -->
							<h1 class="ucase" itemprop="name"><?php echo $page_heading; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		$args = array(
		    'post_type' => 'leeu-press',
		    'posts_per_page' => -1,
		    'orderby' =>'menu_order',
		    'order' => 'ASC',
		    'post_parent' => 0
		);
		?>
		<?php $loop = new WP_Query( $args );
		$press_num = 0;
		if ( $loop->have_posts() ) : 
			 while ( $loop->have_posts() ) : $loop->the_post(); 
				$post_data[$press_num] = $post;
				$press_num++;
				wp_reset_postdata(); 
		  endwhile;	
		endif;

		$col = 4;

		$mod = $press_num % $col;
		$div = $press_num / $col;

		if($mod == 0)
		{
		      $total_rows = $div;
		}
		else
		{
		   $total_rows = ($press_num + ($col - $mod)) / $col;
		}
		$col_loop = 1;
		$col_detail_loop = 1;
		for($row = 1; $row <= $total_rows; $row++)
		{
			?>
			<div class="container">
				<div class="scroll-anim" data-anim="fade-up">
					<div class="row press-cols-row clearfix">
						<?php
						for($j = (($row - 1) * $col); $j < ($row * $col) && $col_loop <= $press_num; $j++, $col_loop++)
						{
							$post = $post_data[$j];
							
							$press_thumb_image = carbon_get_post_meta($post->ID,'crb_press_thumb_image');
							$crb_press_slider = carbon_get_post_meta($post->ID,'crb_press_slider', 'complex');
							$press_release_date = carbon_get_post_meta($post->ID,'crb_press_release_date');
							$press_detail_link = carbon_get_post_meta($post->ID,'crb_press_detail_link');

							$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
							$featured_image_url = isset($featured_image[0]) ? $featured_image[0] : '';
							$press_thumb_image_url = $press_thumb_image[0];

							$press_release_date_str = !empty($press_release_date) ? date('F Y', strtotime($press_release_date)) : "";
							?>
							<div class="col-<?php echo (12/$col); ?> press-cols <?php if(!empty($crb_press_slider)){ echo "has-slider-images"; } ?>" data-id="<?php echo $post->ID; ?>">
								<div class="press-cols-content-wrapper">
									<?php
									if(!empty($press_thumb_image_url))
									{
										?>
										<img src="<?php echo $press_thumb_image_url; ?>" alt="" itemprop="image" />
										<?php
									}
									else
									{
										?>
										<img src="<?php echo get_template_directory_uri(); ?>/images/lite-brown-image.jpg" alt="" />
										<?php
									}
									if(!empty($press_detail_link))
									{
										?>
										<a href="<?php echo $press_detail_link; ?>" class="main-link" target="_blank"></a>
										<?php
									}
									?>
									<?php if(!empty($press_detail_link))
									{
										?>
										<a href="<?php echo $press_detail_link; ?>" class="press-title" itemprop="url" target="_blank"><?php echo $post->post_title; ?></a>
										<?php
									}
									else
									{
										?>
										<div class="press-title"><?php echo $post->post_title; ?></div>
										<?php
									}?>
									<div class="press-release-date"><?php echo $press_release_date_str; ?></div>
								</div>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="row press-detail-row clearfix">
				<div class="container">
					<?php
					for($j = (($row - 1) * $col); $j < ($row * $col) && $col_detail_loop <= $press_num; $j++, $col_detail_loop++)
					{
						$post = $post_data[$j];
						$crb_press_slider = carbon_get_post_meta($post->ID,'crb_press_slider', 'complex');
						
						$press_release_date = carbon_get_post_meta($post->ID,'crb_press_release_date');
						$press_detail_link = carbon_get_post_meta($post->ID,'crb_press_detail_link');
						//$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full');
						//$featured_image_url = isset($featured_image[0]) ? $featured_image[0] : '';
						if(!empty($crb_press_slider))
						{
							$press_release_date_str = !empty($press_release_date) ? date('F Y', strtotime($press_release_date)) : "";
							$has_slider = false;
							$slider_wrapper_class 	= "";
							if(is_array($crb_press_slider) && !empty($crb_press_slider) && count($crb_press_slider) > 1)
							{
								$has_slider = true;
								$slider_wrapper_class = "owl-carousel single_slider owl-theme";
							}
							?>
							<div class="press-detail-<?php echo $post->ID; ?> press-detail-wrapper">
								<div class="press-detail-content-wrapper">
									<div class="row">
										<div class="col-6">
											<div class="single_slider_wrapper <?php if($has_slider){ echo "no_slider"; }?>">
												<?php
												if($has_slider == true)
												{
													?>
													<div class="next"></div>
													<?php
												}?>
												<div class="<?php echo $slider_wrapper_class; ?>">
													<?php
													foreach ($crb_press_slider as $key => $slide)
													{
														$slide_image = wp_get_attachment_image_src( $slide['crb_press_slide_image'], '588x380' );
														$slide_image_url = isset($slide_image) ? $slide_image[0] : "";
														if(!empty($slide_image_url))
														{
															?>
															<a href="<?php echo $press_detail_link; ?>" class="press-featured-img-link" target="_blank"><img src="<?php echo $slide_image_url; ?>" alt="" /></a>
															<?php
														}
													}
													?>
												</div>
												<?php
												if($has_slider == true)
												{
													?>
													<div class="prev"></div>
													<?php
												}?>
											</div>
										</div>
										<div class="col-5">
											<a href="<?php echo $press_detail_link; ?>" class="press-detail-title" target="_blank"><?php echo $post->post_title; ?></a>
											<div class="press-release-date"><?php echo $press_release_date_str; ?></div>
										</div>
									</div>
								</div>
								<a href="javascript:void(0)" class="press-detail-close">Close</a>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
		}
		?>
	</section>
<?php get_footer(); ?>