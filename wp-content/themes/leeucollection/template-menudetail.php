<?php
/*
Template Name: Menu Detail
*/
get_header(); ?>
	<?php
	$post_id = $post->ID;
	$hotel_location = get_hotel_location_list($post_id);
	$hotel_id 		= get_hotel_id($post_id);
    $post_meta 		= ( $post ) ? get_post_meta( $post->ID ) : null;
    
	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);
    ?>
    <section id="site-main">
		<div class="container">
			<?php
			$has_slider = false;
	    	$slider_data = carbon_get_post_meta($post->ID, "crb_slider_images", 'complex');
			if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
			{
				$has_slider = true;
			}
			?>
			<div class="single_slider_wrapper scroll-anim mht_homebanner" data-anim="fade-up">
				<?php
				if($has_slider == true)
				{
					?>
					<div class="next"></div>
					<?php
				}?>
				<div class="owl-carousel single_slider owl-theme">
					<?php
					if(is_array($slider_data) && !empty($slider_data))
					{
						foreach ($slider_data as $slide_key => $slide_data)
						{
							$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '1240x600' );
							$banner_url = $banner_url[0];
							?>
							<div class="banner-img mht_homebanner"  style="background-image:url('<?php echo $banner_url; ?>');"></div>
							<?php
						}
					}
					else
					{
						/*$banner_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
						$banner_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '1240x600' );
						$banner_url = $banner_url[0];
						?>
						<div class="banner-img mht_homebanner"  style="background-image:url('<?php echo $banner_url; ?>');"></div>
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
				<div class="banner-text text-center pos-abs-top">
					<div class="location-text ucase" itemprop="address"><?php echo $hotel_location; ?></div>
					<h1 itemprop="legalName" class="ucase"><?php echo $post->post_title;?></h1>
				</div>
			</div>
			<div class="intro-blurb scroll-anim" data-anim="fade-up">
				<div class="col-10 col-centered">
					<div class="text-center" itemprop="description">
						<?php echo $post->post_content; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col-12 rm-pad room-listing-contain">
				<div class="row listing-row">
					<div class="col-2">
						<div class="side-nav-contain">
							<div class="scroll-anim" data-anim="fade-up">
								<div class="side-nav-wrap">
									<?php
									include_once("leeu_sidebar.php")
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="scroll-anim" data-anim="fade-up">
						<div class="col-8">
							<?php
					    	$content_sections = carbon_get_post_meta($post->ID, "crb_content_section", 'complex');
							if(is_array($content_sections) && !empty($content_sections))
							{
								foreach ($content_sections as $section_key => $content_section)
								{
									$section_heading 	= $content_section['crb_section_heading'];
									$section_layout 	= $content_section['crb_section_layout'];
									$section_link_text 	= $content_section['crb_section_link_text'];
									$section_link 		= $content_section['crb_section_link'];
									$section_show_link	= $content_section['crb_section_show_link'];
									$section_sliders	= $content_section['crb_section_slider'];

									$slider_wrapper_class 	= "single_slider_wrapper";
									$slider_theme_class 	= "single_slider";
									$mht_homebanner_class 	= "mht_homebanner";
									$data_anim_delay 		= "";
									if($section_layout == 2)
									{
										$slider_wrapper_class 	= "two-slide-carousel two-img-col";
										$slider_theme_class 	= "two_slider";
										$mht_homebanner_class 	= "";
										$data_anim_delay 		= "data-anim-delay='100'";
									}
									?>
									<div class="listing-box listing-row">
										<div class="text-center scroll-anim" data-anim="fade-up">
											<h2 class="ucase"><?php echo $section_heading; ?></h2>
										</div>
										<div class="text-right page-link"> 
											<?php
											if($section_show_link == 'yes')
											{
												?>
												<a href="<?php echo $section_link; ?>"><?php echo $section_link_text; ?></a>
												<?php
											}
											?>
										</div>
										<div class="<?php echo $slider_wrapper_class; ?>">
											<?php
											if(is_array($section_sliders) && count($section_sliders) > 1)
											{
												?>
												<div class="<?php echo $mht_homebanner_class; ?> next-wrapper">
													<div class="next"></div>
												</div>
												<?php
											}?>
											<div class="owl-carousel <?php echo $slider_theme_class; ?> owl-theme">
												<?php
												$slide_counter = 0;
												foreach($section_sliders as $slider_key => $section_slider)
												{
													$slide_counter++;
													$slide_image 	= $section_slider['crb_section_slide_image'];
													$slide_title 	= $section_slider['crb_section_slide_title'];
													$slide_desc 	= $section_slider['crb_section_slide_desc'];
													$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
													$slide_image_url = $slide_image_url[0];
													?>
													<div class="slide-item">
														<div class="banner-img <?php echo $mht_homebanner_class; ?> scroll-anim" data-anim="fade-up" style="background-image:url('<?php echo $slide_image_url; ?>');" <?php if($section_layout == 2 && $slide_counter > 1){ echo $data_anim_delay; }?>>
														</div>
														<?php
														if($section_layout == 2)
														{
															?>
															<div class="desc-heading ucase"><?php echo $slide_title; ?></div>
															<?php
														}
														else
														{
															?>
															<div class="row detail-row">
																<div class="col-3">
																	<div class="desc-heading"><?php echo $slide_title; ?></div>
																</div>
																<div class="col-9">
																	<div class="desc-content"> 
																		<?php echo $slide_desc; ?>
																	</div>
																</div>
															</div>
															<?php
														}?>
													</div>
													<?php
												}
												?>
											</div>
											<?php
											if(is_array($section_sliders) && count($section_sliders) > 1)
											{
												?>
												<div class="<?php echo $mht_homebanner_class; ?> prev-wrapper">
													<div class="prev"></div>
												</div>
												<?php
											}?>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>