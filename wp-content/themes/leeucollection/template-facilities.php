<?php
/*
Template Name: Facilities
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
						<div class="listing-box listing-row mgt-0">
							<div class="scroll-anim" data-anim="fade-up">
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
								<div class="listing-box">
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
											if(is_array($slider_data) && !empty($slider_data))
											{
												foreach ($slider_data as $slide_key => $slide_data)
												{
													$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '821x478' );
													$banner_url = $banner_url[0];
													?>
													<div class="slide-item">
														<div class="banner-img scroll-anim" data-anim="fade-up">
															<img src="<?php echo $banner_url; ?>" itemprop="image" alt="" />
														</div>
													</div>
													<?php
												}
											}
											else
											{
												/*$banner_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
												$banner_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '821x478' );
												$banner_url = $banner_url[0];
												?>
												<div class="slide-item">
													<div class="banner-img scroll-anim" data-anim="fade-up">
														<img src="<?php echo $banner_url; ?>" itemprop="image" alt="" />
													</div>
												</div>
												<?php
											}?>
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

						<div class="listing-box listing-row">
							<div class="text-right page-link"> </div>
							<?php
							$col = 2;
							$x = 0;
							$facilities_section = carbon_get_post_meta($post->ID, 'crb_facilities_section', 'complex');
							foreach ($facilities_section as $fs_key => $section_facility)
							{
								$facilities_heading = $section_facility['crb_facilities_heading'];
								if($x == 0)
								{
									?>
									<div class="row detail-row">
									<?php
								}?>
								<div class="col-6" itemprop="description">
									<div class="desc-heading"><?php echo $facilities_heading; ?></div>
									<div class="summary_details">
										<?php
										foreach ($section_facility['crb_facilities'] as $facility_key => $facilities)
										{
											?>
											<p><?php echo $facilities['crb_facility']; ?></p>
											<?php
										}
										?>
									</div>
								</div>
								<?php
								$x++;
								if($x == $col)
								{
									$x = 0;
									?>
									</div>
									<?php
								}
							}
							?>
						</div>
					<div class="half-layout-facility">
					<?php
					$half_layout = carbon_get_post_meta($post->ID, "crb_half_layout", 'complex');
					foreach ($half_layout as $re_key => $half_layout_section)
					{	
						$title 	= $half_layout_section['crb_half_layout_main_title'];
						$first_image 	= $half_layout_section['crb_half_layout_first_image'];
						$second_image 	= $half_layout_section['crb_half_layout_second_image'];
						$first_heading = $half_layout_section['crb_half_layout_first_heading'];		
						$second_heading = $half_layout_section['crb_half_layout_second_heading'];
						$first_image_url = wp_get_attachment_image_src( $first_image, '411x258' );
						$first_image_link = $first_image_url[0];
						$second_image_url = wp_get_attachment_image_src( $second_image, '411x258' );
						$second_image_link = $second_image_url[0];
						?>
						<div class="row clearfix">
							<?php if(!empty($title)){?>
								<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
									<h2 class="text-center fac-heading ucase"><?php echo $title; ?></h2>
								</div>
							<?php }?>
							<?php if(!empty($first_image_link) || !empty($first_heading)) {?>
								<div class="col-6 rm-pad" itemscope itemtype="http://schema.org/Product">
									<div class="half-layout-image scroll-anim animate-custom" data-anim="fade-up">
										<img src="<?php echo $first_image_link;?>" alt="<?php echo $first_heading; ?>" itempro="image">
									</div>
									<div class="desc-heading ucase" itemprop="name"><?php echo $first_heading; ?></div>
								</div>
							<?php }?>
							<?php if(!empty($second_image_link) || !empty($second_heading)) {?>
								<div class="col-6 rm-pad" itemscope itemtype="http://schema.org/Product">
									<div class="half-layout-image scroll-anim animate-custom" data-anim="fade-up">
										<img src="<?php echo $second_image_link;?>" alt="<?php echo $second_heading; ?>" itemprop="image">
									</div>
									<div class="desc-heading ucase" itemprop="name"><?php echo $second_heading; ?></div>
								</div>
							<?php }?>
					 	</div>
						<?php }
						?>
						</div>			
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>