<?php
/*
Template Name: Hotel Listing
*/
get_header();
?>
	<?php
	$post_id 	= $post->ID;
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;

	$has_slider = false;
	$slider_data = carbon_get_post_meta($post->ID, "crb_header_images", 'complex');
	if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
	{
		$has_slider = true;
	}
	$slider_wrapper_class = "owl-carousel single_slider_home owl-theme";
	if(!$has_slider)
	{
		$slider_wrapper_class = "active-onload";
	}
	?>
	<section id="site-main">
		<div class="container home-slider-container hotel-slider-container <?php if(!$has_slider){ echo "no_slider_wrapper"; }?>">
			<div class="single_slider_wrapper scroll-anim <?php if(!$has_slider){ echo "no_slider"; }?>" data-anim="fade-up">
				<?php
				if($has_slider == true)
				{
					?>
					<div class="next"></div>
					<?php
				}?>
				<div class="<?php echo $slider_wrapper_class; ?> notranslate">
					<?php
					if(is_array($slider_data) && !empty($slider_data))
					{
						foreach ($slider_data as $slide_key => $slide_data)
						{
							$header_button_link 	= $slide_data['crb_header_button_link'];
							$header_button_text 	= $slide_data['crb_header_button_text'];
							$header_description 	= $slide_data['crb_header_description'];
							$header_heading 		= $slide_data['crb_header_heading'];
							$header_text_position 	= $slide_data['crb_header_text_position'];

							$header_button_text_color 	= @$slide_data['crb_header_button_text_color'];
							$header_description_color 	= @$slide_data['crb_header_description_color'];
							$header_heading_color 		= @$slide_data['crb_header_heading_color'];

							$banner_url = wp_get_attachment_image_src( $slide_data['crb_header_image'], '1240x600' );
							$banner_url = $banner_url[0];
							?>
							<div class="slide-img">
								<img class="for-mob-hide" src="<?php echo $banner_url; ?>" alt="">
								<div class="banner-img for-mob mht_homebanner" style="background-image:url('<?php echo $banner_url; ?>'); background-position: center center;"> </div>
								<div class="slider-text text-center ucase <?php echo $header_text_position; ?>">
									<div class="slider-txt-head" style="<?php if(!empty($header_heading_color)){ echo "color: ".$header_heading_color.";"; }?>">
										<?php echo nl2br($header_heading); ?>
									</div>
									<div class="slider-txt-con" style="<?php if(!empty($header_description_color)){ echo "color: ".$header_description_color.";"; }?>">
										<?php echo nl2br($header_description); ?>
									</div>
									<?php
									if(!empty($header_button_link) && !empty($header_button_text))
									{
										?>
										<div class="slider-txt-link">
											<div class="cstm-btn-wrapper">
												<a href="<?php echo $header_button_link; ?>" class="cstm-btn arrow-btn text-center" style="<?php if(!empty($header_button_text_color)){ echo "color: ".$header_button_text_color.";"." border-color: ".$header_button_text_color.";" ; }?>"><?php echo $header_button_text; ?></a>
											</div>
										</div>
										<?php
									}
									?>
								</div>
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
						<div class="slide-img">
							<img src="<?php echo $banner_url; ?>" alt="">
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
			<?php
			if($has_slider == true)
			{
				?>
				<div class="customdotwrapper">
					<div class="customdothover">
					</div>
					<div id="customDots"></div>
				</div>
				<?php
			}?>
		</div>
		<?php
		include_once("book-room-form.php");
		?>
		<?php
		$section_loop = 0;
		$hotel_sections = carbon_get_post_meta($post->ID, "crb_hotel_sections_new", 'complex');
		foreach ($hotel_sections as $hotel_key => $hotel_section)
		{
			$section_loop++;

			$hotel_name 			= $hotel_section['crb_hotel_name'];
			$hotel_logo 			= $hotel_section['crb_hotel_section_logo'];
			$section_description 	= $hotel_section['crb_hotel_section_description'];
			$more_button_link		= $hotel_section['crb_more_button_link'];
			$more_button_text		= $hotel_section['crb_more_button_text'];
			$booking_button_link 	= $hotel_section['crb_booking_button_link'];
			$booking_button_text 	= $hotel_section['crb_booking_button_text'];


			$schema_data 				= array();
			$schema_data['@type'] 		= "Hotel";
			$schema_data['name'] 		= $hotel_name;
			$schema_data['description']	= $section_description;
			?>
			<div class="container">
				<div class="home-hotel-wrap-<?php echo $section_loop; ?> pagination-slider " data-unique-class="home-hotel-wrap-<?php echo $section_loop; ?>">
					<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
						<?php
						if($section_loop == 1)
						{
							?>
							<h1 class="home-heading ucase notranslation"><?php echo $hotel_name; ?></h1>
							<?php
						}
						else
						{
							?>
							<h2 class="home-heading ucase notranslation"><?php echo $hotel_name; ?></h2>
							<?php
						}
						?>
					</div>
					<?php
					foreach ($hotel_section['crb_hotel_section_details'] as $sd_key => $links_details)
					{
						$hotel_locations = $links_details['crb_hotel_locations'];
						$schema_data['address'] = $hotel_locations;
						?>
						<div class="mobile-only">
							<div class="hotel-location-name"><?php echo $hotel_locations; ?></div>
						</div>
						<?php
						break;
					}
					?>
					<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
						<?php
						$col3_class = "rm-pad-left";
						$col9_class = "rm-pad-right flx-right";

						if($section_loop%2 == 0)
						{
							$col3_class = "rm-pad-right";
							$col9_class = "rm-pad-left";
						}
						ob_implicit_flush(true);
						ob_start();
						?>
						<div class="col-3 <?php echo $col3_class; ?>">
							<div class="sliding-detail-wrapper">
								<div class="sliding-detail active-detail-slide">
									<div class="inner-detail-content">
										<?php
										$hotel_logo_url = wp_get_attachment_image_src( $hotel_logo, 'original' );
										$hotel_logo_url = $hotel_logo_url[0];
										if(!empty($hotel_logo_url))
										{
											$schema_data['logo'] = $hotel_logo_url;
											?>
											<div class="detail-logo">
												<img src="<?php echo $hotel_logo_url; ?>" alt="">
											</div>
											<?php
										}?>
										<div class="content-part">
											<?php echo nl2br($section_description); ?>
										</div>
										<ul class="list-inline linking-wrap">
											<?php
											if(!empty($more_button_link) && !empty($more_button_text))
											{
												if(!empty($more_button_link) && $more_button_link != "#")
												{

													$schema_data['@id'] = $more_button_link;
													$schema_data['url'] = $more_button_link;
												}
												?>
												<li class="see-more-link"><a href="<?php echo $more_button_link; ?>"><?php echo $more_button_text; ?></a></li>
												<li class="book-link"><a class="popup-booking-button-anchor" href="javascript:void(0);" data-booking-at="<?php echo addslashes($hotel_name); ?>" data-booking-for="hotel">Book</a></li>
												<?php
											}
											if(!empty($booking_button_link) && !empty($booking_button_text))
											{
												?>
												<!-- <li class="book-link"><a href="<?php echo $booking_button_link; ?>"><?php echo $booking_button_text; ?></a></li> -->
												<?php
											}?>
										</ul>
									</div>
								</div>
							</div>
							<div class="main-nav-slider for-desk">
								<?php
								$loop = 0;
								foreach ($hotel_section['crb_hotel_section_details'] as $sd_key => $links_details)
								{
									$hotel_locations = $links_details['crb_hotel_locations'];
									$location_class = "";
									if($loop > 0)
									{
										$location_class = "spc-top";
									}
									?>
									<div class="gotoslidehead <?php echo $location_class; ?> ucase"><?php echo $hotel_locations; ?></div>
									<?php
									foreach ($links_details['crb_hotel_section_link_details'] as $ld_key => $links)
									{
										$section_name = $links['crb_hotel_section_name'];
										$section_link = $links['crb_hotel_section_link'];
										if(!empty($section_name) && !empty($section_link))
										{
											?>
											<div class="gotoslide"><a href="<?php echo $section_link; ?>"><?php echo $section_name; ?></a></div>
											<?php
										}
									}
									$loop++;
								}
								?>
							</div>
						</div>
						<?php
						$col3_content = ob_get_clean();
						ob_implicit_flush(true);
						ob_start();

						$has_slider = false;
						$slider_data = $hotel_section['crb_hotel_section_slider'];
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
						<div class="col-9 <?php echo $col9_class; ?>">
							<div class="single_slider_wrapper scroll-anim <?php if(!$has_slider){ echo "no_slider"; }?>" data-anim="fade-up">
								<?php
								if($has_slider == true)
								{
									?>
									<div class="next"></div>
									<?php
								}?>
								<div class="<?php echo $slider_wrapper_class; ?>">
									<?php
									foreach ($slider_data as $slide_key => $slide)
									{
										$section_image 		= $slide['crb_hotel_section_image'];
										$more_button_link	= $hotel_section['crb_more_button_link'];

										$section_image_url = wp_get_attachment_image_src( $section_image, '925x600' );
										$section_image_url = $section_image_url[0];
										if(!empty($section_image_url))
										{
											$schema_data['image'] = $section_image_url;
											?>
											<div class="slider-item">
												<a href="<?php echo $more_button_link; ?>"><img src="<?php echo $section_image_url; ?>" alt=""></a>
											</div>
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
						<?php
						$col9_content = ob_get_clean();	
						echo $col9_content;
						echo $col3_content;
						$schema_array[] = $schema_data;
						?>
					</div>
				</div>
			</div>
			<?php
		}
		/*$section_loop = 0;
		$hotel_sections = carbon_get_post_meta($post->ID, "crb_hotel_sections", 'complex');
		foreach ($hotel_sections as $hotel_key => $hotel_section)
		{
			$section_loop++;
			?>
			<div class="container">
				<div class="home-hotel-wrap-<?php echo $section_loop; ?> pagination-slider" data-unique-class="home-hotel-wrap-<?php echo $section_loop; ?>">
					<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
						<h2 class="home-heading ucase"><?php echo $hotel_section['crb_hotel_name']; ?></h2>
					</div>
					<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
						<?php
						$col3_class = "rm-pad-left";
						$col9_class = "rm-pad-right";

						if($section_loop%2 == 0)
						{
							$col3_class = "rm-pad-right";
							$col9_class = "rm-pad-left";
						}
						ob_implicit_flush(true);
						ob_start();
						?>
						<div class="col-3 <?php echo $col3_class; ?>">
							<div class="sliding-detail-wrapper">
								<?php
								$loop = 0;
								foreach ($hotel_section['crb_hotel_hotels'] as $slider_key => $hotel_slider)
								{
									foreach ($hotel_slider['crb_hotel_section_details'] as $slide_key => $slide)
									{
										$section_description 	= $slide['crb_hotel_section_description'];
										$hotel_logo 			= $slide['crb_hotel_section_logo'];
										$more_button_link		= $slide['crb_more_button_link'];
										$more_button_text		= $slide['crb_more_button_text'];
										$booking_button_link 	= $slide['crb_booking_button_link'];
										$booking_button_text 	= $slide['crb_booking_button_text'];

										$active_slide = "";
										if($loop == 0)
										{
											$active_slide = "active-detail-slide";
										}
										$hotel_logo_url = wp_get_attachment_image_src( $hotel_logo, 'original' );
										$hotel_logo_url = $hotel_logo_url[0];
										?>
										<div class="sliding-detail <?php echo $active_slide; ?>" data-object-closed="<?php echo $loop; ?>">
											<div class="inner-detail-content">
												<?php
												if(!empty($hotel_logo_url))
												{
													?>
													<div class="detail-logo">
														<img src="<?php echo $hotel_logo_url; ?>" alt="">
													</div>
													<?php
												}?>
												<div class="content-part">
													<?php echo nl2br($section_description); ?>
												</div>
												<ul class="list-inline linking-wrap">
													<?php
													if(!empty($more_button_link) && !empty($more_button_text))
													{
														?>
														<li class="see-more-link"><a href="<?php echo $more_button_link; ?>"><?php echo $more_button_text; ?></a></li>
														<?php
													}
													if(!empty($booking_button_link) && !empty($booking_button_text))
													{
														?>
														<li class="book-link"><a href="javascript:void(0);" data-connection-id="<?php echo $booking_button_link; ?>" id="booktable-<?php echo $section_loop.'-'.$loop; ?>" class="booktable"><?php echo $booking_button_text; ?></a></li>
														<?php
													}?>
												</ul>
											</div>
										</div>
										<?php
										$loop++;
									}
								}
								?>
							</div>
							<div class="main-nav-slider">
								<?php
								$loop = 0;
								foreach ($hotel_section['crb_hotel_hotels'] as $slider_key => $hotel_slider)
								{
									$hotel_locations = $hotel_slider['crb_hotel_locations'];
									$location_class = "";
									if($loop > 0)
									{
										$location_class = "spc-top";
									}
									?>
									<div class="gotoslidehead <?php echo $location_class; ?> ucase"><?php echo $hotel_locations; ?></div>
									<?php
									foreach ($hotel_slider['crb_hotel_section_details'] as $slide_key => $slide)
									{
										$section_name = $slide['crb_hotel_section_name'];
										$active_slide = "";
										if($loop == 0)
										{
											//$active_slide = "active-main-pagination";
										}
										$more_button_link = $slide['crb_more_button_link'];
										?>
										<!-- <div class="gotoslide <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>"><?php echo $section_name; ?></div> -->
										<div class="gotoslide <?php echo $active_slide; ?>" data-object-closed="<?php echo $loop; ?>"><a href="<?php echo $more_button_link; ?>"><?php echo $section_name; ?></a></div>
										<?php
										$loop++;
									}
								}
								?>
							</div>
						</div>
						<?php
						$col3_content = ob_get_clean();
						ob_implicit_flush(true);
						ob_start();
						?>
						<div class="col-9 <?php echo $col9_class; ?>">
							<div class="single_slider_wrapper">
								<div class="next"></div>
								<div class="owl-carousel single_slider owl-theme">
									<?php
									$loop = 0;
									foreach ($hotel_section['crb_hotel_hotels'] as $slider_key => $hotel_slider)
									{
										foreach ($hotel_slider['crb_hotel_section_details'] as $slide_key => $slide)
										{
											$section_image = $slide['crb_hotel_section_image'];

											$active_slide = "";
											if($loop == 0)
											{
												$active_slide = "active-detail-slide";
											}
											$section_image_url = wp_get_attachment_image_src( $section_image, '925x600' );
											$section_image_url = $section_image_url[0];
											if(!empty($section_image_url))
											{
												?>
												<div class="slider-item" data-object-closed="<?php echo $loop; ?>">
													<img src="<?php echo $section_image_url; ?>" alt="">
												</div>
												<?php
											}
											$loop++;
										}
									}
									?>
								</div>
								<div class="prev"></div>
							</div>
						</div>
						<?php
						$col9_content = ob_get_clean();

						if($section_loop%2 == 0)
						{
							echo $col9_content;
							echo $col3_content;
						}
						else
						{
							echo $col3_content;
							echo $col9_content;
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}*/
		?>
	</section>
<?php get_footer(); ?>
