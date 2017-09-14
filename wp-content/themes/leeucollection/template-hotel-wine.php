<?php
/*
Template Name: Wine
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
			<div class="col-12 rm-pad room-listing-contain wine-listing-contain">
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
						<div class="listing-box mgt-0">
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
															<img src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
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
														<img src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
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
						<div class="row detail-row listing-row">
							<?php
							$both_given = true;
							if(trim(@$post_meta['_crb_slider_bottom_heading'][0]) == "" || trim(@$post_meta['_crb_slider_bottom_description'][0]) == "")
							{
								$both_given = false;
							}
							if(trim(@$post_meta['_crb_slider_bottom_heading'][0]) != "")
							{
								?>
								<div class="<?php if($both_given){ echo "col-3"; }else{ echo "col-12"; } ?>">
									<div class="desc-heading <?php if(!$both_given){ echo "text-center"; }?>"><?php echo @$post_meta['_crb_slider_bottom_heading'][0]; ?></div>
								</div>
								<?php
							}
							if(trim(@$post_meta['_crb_slider_bottom_description'][0]) != "")
							{
								?>
								<div class="<?php if($both_given){ echo "col-9"; }else{ echo "col-12"; } ?>">
									<div class="desc-content <?php if(!$both_given){ echo "text-center"; }?>" itemprop="description"> 
										<?php echo nl2br(@$post_meta['_crb_slider_bottom_description'][0]); ?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
						<?php
				    	$content_sections = carbon_get_post_meta($post->ID, "crb_content_section1", 'complex');
						if(is_array($content_sections) && !empty($content_sections))
						{
							foreach ($content_sections as $section_key => $content_section)
							{
								$section_heading	= $content_section['crb_section_heading'];
								$section_sliders	= $content_section['crb_section_slider'];

								$has_slider = false;
								if(is_array($section_sliders) && count($section_sliders) > 1)
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
								<div class="listing-box listing-row" itemscope itemtype="http://schema.org/Place">
									<div class="text-center scroll-anim" data-anim="fade-up">
										<?php
										if(!empty($section_heading))
										{
											?>
											<h2 class="ucase"><?php echo $section_heading; ?></h2>
											<?php
										}
										?>
									</div>
									<div class="text-right page-link"></div>
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
											$slide_counter = 0;
											foreach($section_sliders as $slider_key => $section_slider)
											{
												$slide_counter++;

												$slide_image 		= $section_slider['crb_section_slide_image'];
												$slide_title 		= $section_slider['crb_section_slide_title'];
												$slide_desc			= $section_slider['crb_section_slide_desc'];
												$section_link_text 	= $section_slider['crb_section_link_text'];
												$section_link 		= $section_slider['crb_section_link'];

												$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
												$slide_image_url = $slide_image_url[0];

												$target = "";
												if(strpos($section_link, "http://") !== false || strpos($section_link, "https://") !== false || strpos($section_link, "www.") !== false)
												{
													$target = "target='_blank'";
												}
												?>
												<div class="slide-item">
													<div class="banner-img scroll-anim" data-anim="fade-up">
														<img src="<?php echo $slide_image_url; ?>" alt="" itemprop="image" />
														<?php
														if(!empty($section_link) && !empty($section_link_text))
														{
															?>
															<a href="<?php echo $section_link; ?>" <?php echo $target; ?> class="main-link" itemprop="url"></a>
															<?php
														}
														?>
													</div>
													<div class="row detail-row">
														<div class="col-3">
															<div class="desc-heading mg-l-20" itemprop="name"><?php echo $slide_title; ?></div>
														</div>
														<div class="col-9">
															<div class="desc-content" itemprop="description"> 
																<?php echo nl2br($slide_desc); ?>
															</div>
														</div>
														<div class="clearfix"></div>
														<div class="see_option_wrapper">
															<?php
															if(!empty($section_link) && !empty($section_link_text))
															{
																?>
																<ul class="list-inline linking-wrap">
																	<li class="see-more-link">
																		<a href="<?php echo $section_link; ?>" <?php echo $target; ?>><?php echo $section_link_text; ?></a>
																	</li>
																</ul>
																<?php
															}
															?>
														</div>
														<!--<div class="see_option ucase">
															<?php
															if(!empty($section_link) && !empty($section_link_text))
															{
																?>
																<span><a href="<?php echo $section_link; ?>" <?php echo $target; ?>><?php echo $section_link_text; ?></a></span>
																<?php
															}
															?>
														</div>-->
													</div>
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

						$wine_section_heading 		= carbon_get_post_meta($post->ID, "crb_wine_section_heading");
						$wine_section_description 	= carbon_get_post_meta($post->ID, "crb_wine_section_description");
						$wine_slider_details 		= carbon_get_post_meta($post->ID, "crb_wine_slider_details", 'complex');
						if(!empty($wine_section_heading) && !empty($wine_slider_details))
						{
							?>
							<div class="listing-box listing-row wine-slider-section-wrapper" itemscope itemtype="http://schema.org/Product">
								<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
									<h2 class="ucase small_heading"><?php echo $wine_section_heading; ?></h2>
								</div>
								<div class="wine-section-description col-12 col-centered" itemprop="description"><?php echo $wine_section_description; ?></div>
								<div class="two-slide-carousel two-img-col">
									<?php
									if(count($wine_slider_details) > 2)
									{
										?>
										<div class="next-wrapper">
											<div class="next"></div>
										</div>
										<?php
									}?>
									<div class="owl-carousel two_slider owl-theme">
										<?php
										$loop = 0;
										foreach ($wine_slider_details as $wsd_key => $wine_slider_detail)
										{
											$loop++;
											$wine_image = $wine_slider_detail['crb_wine_image'];
											$wine_name 	= $wine_slider_detail['crb_wine_name'];
											$wine_type 	= $wine_slider_detail['crb_wine_type'];
											$wine_date 	= $wine_slider_detail['crb_wine_date'];

											$wine_image = wp_get_attachment_image_src( $wine_image, '411x258' );
											$wine_image = $wine_image[0];
											?>
											<div class="slide-item">
												<div class="banner-img scroll-anim animate-custom" data-anim="fade-up" <?php if($loop == 1) { echo 'data-anim-delay="100"'; } ?>>
													<img src="<?php echo $wine_image; ?>" alt="" itemprop="image">
												</div>
												<div class="wine-name-date-wrapper">
													<span class="wine-name" itemprop="name"><?php echo $wine_name; ?></span>
													<span class="wine-type"><?php echo $wine_type; ?>,</span>
													<span class="wine-date"><?php echo $wine_date; ?></span>
												</div>
											</div>
											<?php
										}
										?>
									</div>
									<?php
									if(count($wine_slider_details) > 2)
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
						?>
					</div>
					<div class="col-2">
						<div class="map_img">
							<?php
							$map_image = @$post_meta['_crb_small_map_image'][0];
							if($map_image)
							{
								$map_image = wp_get_attachment_image_src($map_image, '193x129');
								$map_image = $map_image[0];
							}
							if(isset($post_meta['_crb_small_map_link'][0]) && !empty($post_meta['_crb_small_map_link'][0]) && !empty($map_image))
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