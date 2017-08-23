<?php
/*
Template Name: Hotel Landing
*/
get_header(); ?>
	<?php
	the_post();
	$post_id 		= $post->ID;
	$hotel_location = get_hotel_location_list($post_id);
	$hotel_id 		= get_hotel_id($post_id);
    $post_meta 		= ( $post ) ? get_post_meta( $post->ID ) : null;
    
	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);
    ?>
    <a href="<?php echo get_permalink($post_id); ?>" style="display:none" itemprop="url"><?php the_title(); ?></a> <!-- used for schema only please do not remove it. -->
    <section id="site-main">
		<div class="container">
			<?php
	    	$hotel_closed = carbon_get_post_meta($post->ID, "crb_hotel_closed");
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
								<img class="for-mob-hide" src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
								<div class="banner-img for-mob mht_homebanner" style="background-image:url('<?php echo $banner_url; ?>')"> </div>
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
							<div class="banner-img for-mob mht_homebanner" style="background-image:url('<?php echo $banner_url; ?>')"> </div>
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
					<h2 itemprop="name" class="ucase"><?php echo $post->post_title;?></h2>
					<div class="location-text ucase" itemprop="address"><?php echo $hotel_location; ?></div>
					<?php
					if(!empty($hotel_closed) && $hotel_closed == 'yes')
					{
	    				$hotel_closed_reason 		= carbon_get_post_meta($post->ID, "crb_hotel_closed_reason");
	    				$hotel_closed_button_text 	= carbon_get_post_meta($post->ID, "crb_hotel_closed_button_text");
	    				$hotel_closed_button_link 	= carbon_get_post_meta($post->ID, "crb_hotel_closed_button_link");
	    				
	    				if(!empty($hotel_closed_reason))
	    				{
							?>
							<div class="hotel-closed-reason">
								<?php echo nl2br($hotel_closed_reason); ?>
							</div>
							<?php
						}
	    				if(!empty($hotel_closed_button_text) && !empty($hotel_closed_button_link))
	    				{
							?>
							<div class="hotel-closed-btn-wrapper">
								<a href="<?php echo $hotel_closed_button_link; ?>" class="cstm-btn arrow-btn text-center blk-btn"><?php echo $hotel_closed_button_text; ?></a>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
			<?php
			if(empty($hotel_closed) || $hotel_closed == 'no')
			{
				?>
				<div class="intro-blurb scroll-anim" data-anim="fade-up">
					<div class="col-10 col-centered">
						<div class="text-center" itemprop="description">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
		<?php
		if(empty($hotel_closed) || $hotel_closed == 'no')
		{
			?>
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

										$has_slider = false;
										if(is_array($section_sliders) && count($section_sliders) > 1)
										{
											$has_slider = true;
										}

										$slider_wrapper_class 	= "single_slider_wrapper";
										$slider_theme_class 	= "owl-carousel single_slider owl-theme";
										$data_anim_delay 		= "";
										if($section_layout == 2)
										{
											$slider_wrapper_class 	= "two-slide-carousel two-img-col";
											$slider_theme_class 	= "owl-carousel two_slider owl-theme";
											$data_anim_delay 		= "data-anim-delay='100'";
										}
										if(!$has_slider)
										{
											$slider_theme_class = "";
										}
										?>
										<div itemscope itemtype="http://schema.org/Place" class="listing-box listing-row relative <?php if($section_link == '') { echo "no-page-link"; } ?>">
											<div class="text-center scroll-anim section-heading-wrapper" data-anim="fade-up">
												<?php
												if($section_layout == 1)
												{
													?>
													<h1 class="ucase" itemprop="name"><?php echo $section_heading; ?></h1>
													<?php
												}
												else
												{
													?>
												    <h2 class="ucase" itemprop="name"><?php echo $section_heading; ?></h2>
													<?php
												}?>
											</div>
											<?php if(!empty($section_link)){?>
											<div class="text-right page-link view-all-link"> 
												<?php
												if($section_show_link == 'yes')
												{
													?>
													<a href="<?php echo $section_link; ?>" itemprop="url"><?php echo $section_link_text; ?></a>
													<?php
												}
												?>
											</div>
											<?php }?>
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
														$slide_desc 	= $section_slider['crb_section_slide_desc'];
														$slide_link 	= @$section_slider['crb_section_slide_link'];
														if($section_layout == 2)
														{
															$slide_image_url = wp_get_attachment_image_src( $slide_image, '411x258' );
														}
														else
														{
															$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
														}
														$slide_image_url = $slide_image_url[0];

														$schema_for = "http://schema.org/Place";
														if(stripos($section_heading, "meeting") !== false)
														{
															$schema_for = "http://schema.org/MeetingRoom";
														}
														else if(stripos($section_heading, "room") !== false)
														{
															$schema_for = "http://schema.org/HotelRoom";
														}
														?>
														<div itemscope itemtype="<?php echo $schema_for; ?>" class="slide-item">
															<div class="banner-img scroll-anim" data-anim="fade-up" <?php if($section_layout == 2 && $slide_counter > 1){ echo $data_anim_delay; }?>>
																<img src="<?php echo $slide_image_url; ?>" alt="" itemprop="image" />
																<?php
																if(!empty($slide_link))
																{
																	?>
																	<a href="<?php echo $slide_link; ?>" class="main-link" itemprop="url"></a>
																	<?php
																}
																?>
															</div>
															<?php
															if($section_layout == 2)
															{
																?>
																<div class="desc-heading ucase" itemprop="name"><?php echo $slide_title; ?></div>
																<?php
															}
															else
															{
																?>
																<div class="row detail-row">
																	<div class="col-3">
																		<div class="desc-heading" itemprop="name"><?php echo $slide_title; ?></div>
																	</div>
																	<div class="col-9">
																		<div class="desc-content" itemprop="description">
																			<?php echo nl2br($slide_desc); ?>
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
			<?php
		}
		?>
	</section>

<?php get_footer(); ?>