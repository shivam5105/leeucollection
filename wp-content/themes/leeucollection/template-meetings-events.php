<?php
/*
Template Name: Meetings & Events
*/
get_header(); ?>
	<?php
	the_post();
	$post_id 	= $post->ID;
	$hotel_id 	= get_hotel_id($post_id);
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;
    
	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);
	$hotel_location = @$post_meta['_crb_page_country'][0];
	$page_heading = (@$post_meta['_crb_page_heading'][0]) ? $post_meta['_crb_page_heading'][0] : $post->post_title;
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
			$slider_wrapper_class = "owl-carousel single_slider owl-theme";
			if(!$has_slider)
			{
				$slider_wrapper_class = "";
			}
			?>
			<div class="single_slider_wrapper main_slider scroll-anim <?php if(!$has_slider){ echo "no_slider"; }?>" data-anim="fade-up">
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
							$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '1240x600' );
							$banner_url = $banner_url[0];
							?>
							<div class="banner-img-wrapper">
								<img  class="for-mob-hide" src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
								<div class="banner-img for-mob mht_homebanner" style="background-image:url('<?php echo $banner_url; ?>'); background-position: center center;"> </div>
							</div>
							<?php
						}
					}
					else
					{
						/*$banner_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
						$banner_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '1240x600' );
						$banner_url = $banner_url[0];
						?>
						<div class="banner-img-wrapper">
							<img class="for-mob-hide" src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
							<div class="banner-img for-mob mht_homebanner" style="background-image:url('<?php echo $banner_url; ?>'); background-position: center center;"> </div>
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
				<div class="banner-text text-center pos-abs-top">
					<!-- <div class="location-text ucase" itemprop="name"><?php echo $top_most_parent_post->post_title;?></div> -->
					<h2 itemprop="name" class="ucase"><?php echo $page_heading; ?></h2>
				</div>
			</div>
			<div class="intro-blurb scroll-anim" data-anim="fade-up">
				<div class="col-10 col-centered">
					<div class="text-center" itemprop="description">
						<?php the_content(); ?>
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
						$section_sliders = carbon_get_post_meta($post->ID, "crb_section_slider", 'complex');
						if(is_array($section_sliders) && !empty($section_sliders))
						{
							foreach($section_sliders as $slider_key => $section_slider)
							{
								$crb_sliders = $section_slider['crb_slider'];

								$has_slider = false;
								if(is_array($crb_sliders) && count($crb_sliders) > 1)
								{
									$has_slider = true;
								}

								$slider_wrapper_class 	= "single_slider_wrapper";
								$slider_theme_class 	= "owl-carousel single_slider owl-theme";

								if(!$has_slider)
								{
									$slider_theme_class = "";
								}
								?>
								<div class="scroll-anim" data-anim="fade-up" itemscope itemtype="http://schema.org/Place">
									<div class="section-slider-heading-wrapper">
										<h2 class="ucase"><?php echo $section_slider['crb_section_slider_heading']; ?></h2>
									</div>
									<div class="listing-box listing-row">
										<div class="<?php echo $slider_wrapper_class; ?> <?php if(!$has_slider){ echo "no_slider"; }?>">
											<?php
											if($has_slider)
											{
												?>
												<div class="next-wrapper">
													<div class="next"></div>
												</div>
												<?php
											}?>
											<div class="<?php echo $slider_theme_class; ?>">
												<?php
												if(is_array($crb_sliders) && !empty($crb_sliders))
												{
													foreach($crb_sliders as $crb_slider_key => $crb_slider)
													{
														$slide_image 	= $crb_slider['crb_section_slide_image'];
														$slide_title 	= $crb_slider['crb_section_slide_title'];
														$slide_desc 	= $crb_slider['crb_section_slide_desc'];

														$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
														$slide_image_url = $slide_image_url[0];
														?>
														<div class="slide-item">
															<div class="scroll-anim" data-anim="fade-up">
																<img src="<?php echo $slide_image_url; ?>" alt="" itemprop="image">
															</div>
															<div class="row detail-row">
																<div class="col-3">
																	<div class="desc-heading" itemprop="name"><?php echo nl2br($slide_title); ?></div>
																</div>
																<div class="col-9">
																	<div class="desc-content" itemprop="description"> 
																		<?php echo nl2br($slide_desc); ?>
																	</div>
																</div>
															</div>
														</div>
														<?php
													}
												}
												?>
											</div>
											<?php
											if($has_slider)
											{
												?>
												<div class="prev-wrapper">
													<div class="prev"></div>
												</div>
												<?php
											}?>
										</div>
									</div>
								</div>
								<?php
							}
						}

						if(!empty($post_meta['_crb_form_heading'][0]) && !empty($post_meta['_crb_short_code'][0]))
						{
							?>
							<div class="scroll-anim" data-anim="fade-up">
								<div class="listing-box listing-row">
									<div class="row detail-row meetings-form">
										<div class="the_founder">
											<h2 class="ucase"><?php echo @$post_meta['_crb_form_heading'][0]; ?></h2>
										</div>
										<div class="form_field">
											<div class="inside_pd">
												<?php echo do_shortcode($post_meta['_crb_short_code'][0]); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
						?>
						<div class="scroll-anim" data-anim="fade-up">
							<?php
					    	$content_sections = carbon_get_post_meta($post->ID, "crb_2_col_content_section", 'complex');
							if(is_array($content_sections) && !empty($content_sections))
							{
								foreach ($content_sections as $section_key => $content_section)
								{
									$section_heading 	= $content_section['crb_section_heading'];
									$section_sliders	= $content_section['crb_section_slider'];

									$has_slider = false;
									if(is_array($section_sliders) && count($section_sliders) > 1)
									{
										$has_slider = true;
									}

									$slider_wrapper_class 	= "two-slide-carousel two-img-col";
									$slider_theme_class 	= "owl-carousel two_slider owl-theme";
									$data_anim_delay 		= "data-anim-delay='100'";

									if(!$has_slider)
									{
										$slider_theme_class = "";
									}
									?>
									<div itemscope itemtype="http://schema.org/Place" class="listing-box listing-row relative <?php if($section_link == '') { echo "no-page-link"; } ?>">
										<div class="text-center scroll-anim section-heading-wrapper" data-anim="fade-up">
											<h2 class="ucase"><?php echo $section_heading; ?></h2>
										</div>
										<div class="<?php echo $slider_wrapper_class; ?>  <?php if(!$has_slider){ echo "no_slider"; }?>">
											<?php
											if($has_slider)
											{
												?>
												<div class="next-wrapper">
													<div class="next"></div>
												</div>	
												<?php
											}?>
											<div class="<?php echo $slider_theme_class; ?>">
												<?php
												$slide_counter = 0;
												foreach($section_sliders as $slider_key => $section_slider)
												{
													$slide_counter++;
													$slide_image 	= $section_slider['crb_section_slide_image'];
													$slide_title 	= $section_slider['crb_section_slide_title'];
													$slide_link 	= @$section_slider['crb_section_slide_link'];
													$slide_image_url = wp_get_attachment_image_src( $slide_image, '411x258' );
													$slide_image_url = $slide_image_url[0];
													?>
													<div class="slide-item">
														<div class="banner-img scroll-anim" data-anim="fade-up" <?php if($slide_counter > 1){ echo $data_anim_delay; }?>>
															<img src="<?php echo $slide_image_url; ?>" alt="" itemprop="image" />
															<?php
															if(!empty($slide_link))
															{
																?>
																<a href="<?php echo $slide_link; ?>" itemprop="url" class="main-link"></a>
																<?php
															}
															?>
														</div>
														<div class="desc-heading ucase" itemprop="name"><?php echo $slide_title; ?></div>
													</div>
													<?php
												}
												?>
											</div>
											<?php
											if($has_slider)
											{
												?>
												<div class="prev-wrapper">
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