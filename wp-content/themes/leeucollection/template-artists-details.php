<?php
/*
Template Name: Artists Details
*/

get_header(); ?>
	<?php
	the_post();
	$post_id 	= $post->ID;
	$hotel_id 	= get_hotel_id($post_id);
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;

	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);

	$page_heading = (@$post_meta['_crb_page_heading'][0]) ? $post_meta['_crb_page_heading'][0] : $post->post_title;
    ?>
	<section id="site-main">
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
						<div class="listing-box listing-row clearfix">
							<div class="col-6 pdl-0">
								<div class="anton">
									<div class="grey_bg">
										<?php
										$propImage = false;
										$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '411x258' );
										if(!empty($image[0]))
										{
											?>
											<img src="<?php echo $image[0]; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?> />
											<?php
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-6 pdr-0">
								<div class="anton_paragaraph">
									<?php the_content(); ?>
								</div>
								<div class="gallery_link">
									<a href="#">LINK TO GALLERY</a>
								</div>
							</div>
						</div>
						<div class="listing-box listing-row mgb-0">
							<?php
							$has_slider = false;
					    	$slider_data = carbon_get_post_meta($post->ID, "crb_slider_images", 'complex');
							if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
							{
								$has_slider = true;
							}
							$slider_wrapper_class = "owl-carousel single_slider owl-theme";
							if(!$has_slider)
							{
								$slider_wrapper_class = "";
							}
							?>
							<div class="scroll-anim" data-anim="fade-up">
								<div class="single_slider_wrapper <?php if(!$has_slider){ echo "no_slider"; }?>">
									<?php
									if($has_slider == true)
									{
										?>
										<div class="next"></div>
										<?php
									}?>
									<div class="<?php echo $slider_wrapper_class; ?>">
										<?php
										foreach ($slider_data as $slide_key => $slide_data)
										{
											$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '821x478' );
											$banner_url = $banner_url[0];
											?>
											<div class="slide-item">
												<div class="scroll-anim" data-anim="fade-up">
													<img src="<?php echo $banner_url; ?>" alt="">
												</div>
												<div class="row detail-row">
													<div class="col-3">
														<div class="desc-heading"><?php echo $slide_data['crb_slider_bottom_heading']; ?></div>
														<span class="anton_locat"><?php echo $slide_data['crb_slider_bottom_sub_heading']; ?></span>
													</div>
													<div class="col-9">
														<div class="desc-content"> 
															<?php echo nl2br($slide_data['crb_slider_bottom_description']); ?>
														</div>
													</div>
												</div>
											</div>
											<?php
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
						</div>
					</div>
					<div class="col-2">
						<div class="map_img">
							<?php
							$map_image = @($post_meta['_crb_small_map_image'][0]);
							if($map_image)
							{
								$map_image = wp_get_attachment_image_src($map_image, '193x129');
								$map_image = $map_image[0];
							}
							if(!empty($post_meta['_crb_small_map_link'][0]) && !empty($map_image))
							{
								?>
								<a href="<?php echo @$post_meta['_crb_small_map_link'][0]; ?>" target="_blank"><img src="<?php echo $map_image; ?>" alt="map_controll"/></a>
								<div class="locator">
									<a href="<?php echo @$post_meta['_crb_small_map_link'][0]; ?>" target="_blank" class="ucase"><?php echo @$post_meta['_crb_small_map_heading'][0]; ?></a>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>