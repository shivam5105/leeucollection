<?php
/*
Template Name: Home Page
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
		$slider_wrapper_class = "active";
	}
	?>
	<section id="site-main">
		<div class="container home-slider-container">
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
					if(is_array($slider_data) && !empty($slider_data))
					{
						foreach ($slider_data as $slide_key => $slide_data)
						{
							$header_button_link 	= $slide_data['crb_header_button_link'];
							$header_button_text 	= $slide_data['crb_header_button_text'];
							$header_description 	= $slide_data['crb_header_description'];
							$header_heading 		= $slide_data['crb_header_heading'];
							$header_text_position 	= $slide_data['crb_header_text_position'];

							$banner_url = wp_get_attachment_image_src( $slide_data['crb_header_image'], '1240x600' );
							$banner_url = $banner_url[0];
							?>
							<div class="slide-img">
								<img src="<?php echo $banner_url; ?>" alt="">
								<div class="slider-text text-center ucase <?php echo $header_text_position; ?>">
									<div class="slider-txt-head">
										<?php echo nl2br($header_heading); ?>
									</div>
									<div class="slider-txt-con" >
										<?php echo nl2br($header_description); ?>
									</div>
									<?php
									if(!empty($header_button_link) && !empty($header_button_text))
									{
										?>
										<div class="slider-txt-link">
											<div class="cstm-btn-wrapper">
												<a href="<?php echo $header_button_link; ?>" class="cstm-btn arrow-btn text-center"><?php echo $header_button_text; ?></a>
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

		<div class="container booking-form-object">
			<div class="scroll-anim" data-anim="fade-up">
				<form action="#">
					<div class="row booking-object-form-row">
						<div class="col-3 rm-pad">
							<div class="form-item select-item first-item">
								<select>
									<option value="volvo">Select a hotel</option>
									<option value="saab">Leeu Estate</option>
									<option value="mercedes">Leeu House</option>
								</select>
							</div>
						</div>
						<div class="col-3 rm-pad">
							<div class="form-item input-item"> 
								<input name="date" value="Sep 17, 2017 – Sep 18, 2017" placeholder="" required="required" type="text"> 
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item select-item">
								<select>
									<option value="volvo">1 room</option>
									<option value="saab">2 room</option>
									<option value="mercedes">3 room</option>
									<option value="audi">4 room</option>
								</select>
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item select-item">
								<select>
									<option value="volvo">2 guests</option>
									<option value="saab">3 guests</option>
								option value="mercedes">4 guests</option>
								option value="audi">5 guests</option>
								</select>
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item">
								<button type="submit" class="submit-btn ucase">CHECK AVAILABILITY</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php
		$hotel_section_heading = carbon_get_post_meta($post->ID, "crb_hotel_section_heading");
		$slider_data = carbon_get_post_meta($post->ID, "crb_home_hotels", 'complex');
		?>
		<div class="container">
			<div class="home-hotel-wrap pagination-slider" data-unique-class="home-hotel-wrap">
				<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
					<h2 class="home-heading ucase"><?php echo $hotel_section_heading; ?></h2>
				</div>
				<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
					<div class="col-3 rm-pad-left">
						<div class="sliding-detail-wrapper">
							<?php
							$loop = 0;
							foreach ($slider_data as $slider_key => $hotel_slider)
							{
								foreach ($hotel_slider['crb_home_hotels'] as $slide_key => $slide)
								{
									$hotel_description 		= $slide['crb_hotel_description'];
									$hotel_logo 			= $slide['crb_hotel_logo'];
									$hotel_name 			= $slide['crb_hotel_name'];
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
									<div class="sliding-detail <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>">
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
												<?php echo nl2br($hotel_description); ?>
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
													<li class="book-link"><a href="<?php echo $booking_button_link; ?>"><?php echo $booking_button_text; ?></a></li>
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
							foreach ($slider_data as $slider_key => $hotel_slider)
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
								foreach ($hotel_slider['crb_home_hotels'] as $slide_key => $slide)
								{
									$hotel_name = $slide['crb_hotel_name'];
									$active_slide = "";
									if($loop == 0)
									{
										$active_slide = "active-main-pagination";
									}
									?>
									<div class="gotoslide <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>"><?php echo $hotel_name; ?></div>
									<?php
									$loop++;
								}
							}
							?>
						</div>
					</div>
					<div class="col-9 rm-pad-right">
						<div class="single_slider_wrapper">
							<div class="next"></div>
							<div class="owl-carousel single_slider_home_2 owl-theme">
								<?php
								$loop = 0;
								foreach ($slider_data as $slider_key => $hotel_slider)
								{
									foreach ($hotel_slider['crb_home_hotels'] as $slide_key => $slide)
									{
										$hotel_image = $slide['crb_hotel_image'];

										$active_slide = "";
										if($loop == 0)
										{
											$active_slide = "active-detail-slide";
										}
										$hotel_image_url = wp_get_attachment_image_src( $hotel_image, '925x600' );
										$hotel_image_url = $hotel_image_url[0];
										if(!empty($hotel_image_url))
										{
											?>
											<div class="slider-item" data-object="<?php echo $loop; ?>">
												<img src="<?php echo $hotel_image_url; ?>" alt="">
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
				</div>
			</div>
		</div>

		<?php
		$restaurant_section_heading = carbon_get_post_meta($post->ID, "crb_restaurant_section_heading");
		$slider_data = carbon_get_post_meta($post->ID, "crb_home_restaurants", 'complex');
		?>
		<div class="container">
			<div class="home-res-wrap pagination-slider" data-unique-class="home-res-wrap">
				<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
					<h2 class="home-heading ucase"><?php echo $restaurant_section_heading; ?></h2>
				</div>
				<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
					<div class="col-9 rm-pad-left">
						<div class="single_slider_wrapper">
							<div class="next"></div>
							<div class="owl-carousel single_slider_home_2 owl-theme">
								<?php
								$loop = 0;
								foreach ($slider_data as $slider_key => $slide)
								{
									$restaurant_image = $slide['crb_restaurant_image'];

									$active_slide = "";
									if($loop == 0)
									{
										$active_slide = "active-detail-slide";
									}
									$restaurant_image_url = wp_get_attachment_image_src( $restaurant_image, '925x600' );
									$restaurant_image_url = $restaurant_image_url[0];
									if(!empty($restaurant_image_url))
									{
										?>
										<div class="slider-item" data-object="<?php echo $loop; ?>">
											<img src="<?php echo $restaurant_image_url; ?>" alt="">
										</div>
										<?php
									}
									$loop++;
								}
								?>
							</div>
							<div class="prev"></div>
						</div>
					</div>
					<div class="col-3 rm-pad-right">
						<div class="sliding-detail-wrapper">
							<?php
							$loop = 0;
							foreach ($slider_data as $slider_key => $slide)
							{
								$restaurant_description = $slide['crb_restaurant_description'];
								$restaurant_logo 		= $slide['crb_restaurant_logo'];
								$restaurant_name 		= $slide['crb_restaurant_name'];
								$more_button_link		= $slide['crb_more_button_link'];
								$more_button_text		= $slide['crb_more_button_text'];
								$booking_button_link 	= $slide['crb_booking_button_link'];
								$booking_button_text 	= $slide['crb_booking_button_text'];

								$active_slide = "";
								if($loop == 0)
								{
									$active_slide = "active-detail-slide";
								}
								$restaurant_logo_url = wp_get_attachment_image_src( $restaurant_logo, 'original' );
								$restaurant_logo_url = $restaurant_logo_url[0];
								?>
								<div class="sliding-detail <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>">
									<div class="inner-detail-content">
										<div class="detail-logo"> 
											<img src="<?php echo $restaurant_logo_url; ?>" alt="">
										</div>
										<div class="content-part">
											<?php echo $restaurant_description; ?>
										</div>
										<ul class="list-inline linking-wrap">
											<?php
											if(!empty($more_button_text) && !empty($more_button_link))
											{
												?>
												<li class="see-more-link"><a href="<?php echo $more_button_link; ?>"><?php echo $more_button_text; ?></a></li>
												<?php
											}
											if(!empty($booking_button_text) && !empty($booking_button_link))
											{
												?>
												<li class="book-link"><a href="javascript:void(0);" data-connection-id="<?php echo $booking_button_link; ?>" id="booktable-<?php echo $loop; ?>" class="booktable"><?php echo $booking_button_text; ?></a></li>
												<?php
											}
											?>
										</ul>
									</div>
								</div>
								<?php
								$loop++;
							}
							?>
						</div>
						<div class="main-nav-slider">
							<?php
							$loop = 0;
							foreach ($slider_data as $slider_key => $slide)
							{
								$restaurant_name = $slide['crb_restaurant_name'];
								$active_slide = "";
								if($loop == 0)
								{
									$active_slide = "active-main-pagination";
								}
								?>
								<div class="gotoslide <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>"><?php echo $restaurant_name; ?></div>
								<?php
								$loop++;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="listing-row clearfix">
				<div class="two-img-col mgt-topp">
					<div class="col-6 rm-pad">
						<div class="scroll-anim" data-anim="fade-up">
							<div class="img-desc align_center">
								<h2><?php echo @$post_meta['_crb_two_cols_section_1_heading_left'][0];?></h2>
							</div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up">
							<?php
							$section_image_url = wp_get_attachment_image_src( $post_meta['_crb_two_cols_section_1_image_left'][0], '621x386' );
							$section_image_url = $section_image_url[0];
							?>
							<img src="<?php echo $section_image_url; ?>" alt="" />
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													<?php echo @$post_meta['_crb_two_cols_section_1_description_left'][0];?>
												</div>
												<ul class="list-inline linking-wrap">
													<?php
													$see_more_link = (null !== @$post_meta['_crb_two_cols_section_1_more_button_link_left'][0]) ? $post_meta['_crb_two_cols_section_1_more_button_link_left'][0] : "";
													$see_more_text = (null !== @$post_meta['_crb_two_cols_section_1_more_button_text_left'][0]) ? $post_meta['_crb_two_cols_section_1_more_button_text_left'][0] : "";

													$booking_link = (null !== @$post_meta['_crb_two_cols_section_1_booking_button_link_left'][0]) ? $post_meta['_crb_two_cols_section_1_booking_button_link_left'][0] : "";
													$booking_text = (null !== @$post_meta['_crb_two_cols_section_1_booking_button_text_left'][0]) ? $post_meta['_crb_two_cols_section_1_booking_button_text_left'][0] : "";
													if(!empty($see_more_text) && !empty($see_more_link))
													{
														?>
														<li class="see-more-link"><a href="<?php echo $see_more_link; ?>"><?php echo $see_more_text; ?></a></li>
														<?php
													}
													if(!empty($booking_text) && !empty($booking_link))
													{
														?>
														<li class="book-link"><a href="<?php echo $booking_link; ?>"><?php echo $booking_text; ?></a></li>
														<?php
													}
													?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 rm-pad">
						<div class="scroll-anim" data-anim="fade-up">
							<div class="img-desc align_center">
								<h2><?php echo @$post_meta['_crb_two_cols_section_1_heading_right'][0];?></h2>
							</div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up" data-anim-delay="100">
							<?php
							$section_image_url = wp_get_attachment_image_src( $post_meta['_crb_two_cols_section_1_image_right'][0], '621x386' );
							$section_image_url = $section_image_url[0];
							?>
							<img src="<?php echo $section_image_url; ?>" alt="" />
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													<?php echo @$post_meta['_crb_two_cols_section_1_description_right'][0];?>
												</div>
												<ul class="list-inline linking-wrap">
													<?php
													$see_more_link = (null !== @$post_meta['_crb_two_cols_section_1_more_button_link_right'][0]) ? $post_meta['_crb_two_cols_section_1_more_button_link_right'][0] : "";
													$see_more_text = (null !== @$post_meta['_crb_two_cols_section_1_more_button_text_right'][0]) ? $post_meta['_crb_two_cols_section_1_more_button_text_right'][0] : "";

													$booking_link = (null !== @$post_meta['_crb_two_cols_section_1_booking_button_link_right'][0]) ? $post_meta['_crb_two_cols_section_1_booking_button_link_right'][0] : "";
													$booking_text = (null !== @$post_meta['_crb_two_cols_section_1_booking_button_text_right'][0]) ? $post_meta['_crb_two_cols_section_1_booking_button_text_right'][0] : "";
													if(!empty($see_more_text) && !empty($see_more_link))
													{
														?>
														<li class="see-more-link"><a href="<?php echo $see_more_link; ?>"><?php echo $see_more_text; ?></a></li>
														<?php
													}
													if(!empty($booking_text) && !empty($booking_link))
													{
														?>
														<li class="book-link"><a href="<?php echo $booking_link; ?>"><?php echo $booking_text; ?></a></li>
														<?php
													}
													?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$wine_section_heading 	= carbon_get_post_meta($post->ID, "crb_wine_section_heading");
		$slider_data 			= carbon_get_post_meta($post->ID, "crb_home_wines", 'complex');
		$bottom_links 			= carbon_get_post_meta($post->ID, "crb_wines_section_bottom_links", 'complex');
		$has_slider				= false;
		$slider_wrapper_class 	= "";
		if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
		{
			$slider_wrapper_class 	= "owl-carousel single_slider_home_2 owl-theme";
			$has_slider 			= true;
		}
		?>
		<div class="container">
			<div class="home-wine-wrap pagination-slider" data-unique-class="home-wine-wrap">
				<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
					<h2 class="home-heading ucase"><?php echo $wine_section_heading; ?></h2>
				</div>
				<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
					<div class="col-9 rm-pad-left">
						<div class="single_slider_wrapper <?php if(!$has_slider){ echo "no_slider"; }?>">
							<?php
							if($has_slider)
							{
								?>
								<div class="next"></div>
								<?php
							}?>
							<div class="<?php echo $slider_wrapper_class; ?>">
								<?php
								$loop = 0;
								foreach ($slider_data as $slider_key => $slide)
								{
									$wine_image = $slide['crb_wine_image'];

									$active_slide = "";
									if($loop == 0)
									{
										$active_slide = "active-detail-slide";
									}
									$wine_image_url = wp_get_attachment_image_src( $wine_image, '925x600' );
									$wine_image_url = $wine_image_url[0];
									?>
									<div class="slider-item" data-object="<?php echo $loop; ?>">
										<img src="<?php echo $wine_image_url; ?>" alt="">
									</div>
									<?php
									$loop++;
									break;
								}
								?>
							</div>
							<?php
							if($has_slider)
							{
								?>
								<div class="prev"></div>
								<?php
							}?>
						</div>
					</div>
					<div class="col-3 rm-pad-right">
						<div class="sliding-detail-wrapper">
							<?php
							$loop = 0;
							foreach ($slider_data as $slider_key => $slide)
							{
								$wine_description 		= $slide['crb_wine_description'];
								$wine_name 				= $slide['crb_wine_name'];
								$more_button_link		= $slide['crb_more_button_link'];
								$more_button_text		= $slide['crb_more_button_text'];
								$booking_button_link 	= $slide['crb_booking_button_link'];
								$booking_button_text 	= $slide['crb_booking_button_text'];

								$active_slide = "";
								if($loop == 0)
								{
									$active_slide = "active-detail-slide";
								}
								?>
								<div class="sliding-detail <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>">
									<div class="inner-detail-content">
										<div class="content-part">
											<?php echo $wine_description; ?>
										</div>
										<ul class="list-inline linking-wrap">
											<?php
											if(!empty($more_button_text) && !empty($more_button_link))
											{
												?>
												<li class="see-more-link"><a href="<?php echo $more_button_link; ?>"><?php echo $more_button_text; ?></a></li>
												<?php
											}
											if(!empty($booking_button_text) && !empty($booking_button_link))
											{
												?>
												<li class="book-link"><a href="<?php echo $booking_button_link; ?>"><?php echo $booking_button_text; ?></a></li>
												<?php
											}
											?>
										</ul>
									</div>
								</div>
								<?php
								$loop++;
							}
							?>
						</div>
						<div class="main-nav-slider d_b">
							<?php
							foreach ($bottom_links as $links_key => $link)
							{
								$button_text = $link['crb_button_text'];
								$button_link = $link['crb_button_link'];
								?>
								<a href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="listing-row clearfix">
				<div class="two-img-col mgt-topp">
					<div class="col-6 rm-pad">
						<div class="scroll-anim" data-anim="fade-up">
							<div class="img-desc align_center"><?php echo @$post_meta['_crb_two_cols_section_2_heading_left'][0];?></div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up">
							<?php
							$section_image_url = wp_get_attachment_image_src( $post_meta['_crb_two_cols_section_2_image_left'][0], '621x386' );
							$section_image_url = $section_image_url[0];
							?>
							<img src="<?php echo $section_image_url; ?>" alt="" />
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													<?php echo @$post_meta['_crb_two_cols_section_2_description_left'][0];?>
												</div>
												<ul class="list-inline linking-wrap">
													<?php
													$see_more_link = (null !== @$post_meta['_crb_two_cols_section_2_more_button_link_left'][0]) ? $post_meta['_crb_two_cols_section_2_more_button_link_left'][0] : "";
													$see_more_text = (null !== @$post_meta['_crb_two_cols_section_2_more_button_text_left'][0]) ? $post_meta['_crb_two_cols_section_2_more_button_text_left'][0] : "";

													$booking_link = (null !== @$post_meta['_crb_two_cols_section_2_booking_button_link_left'][0]) ? $post_meta['_crb_two_cols_section_2_booking_button_link_left'][0] : "";
													$booking_text = (null !== @$post_meta['_crb_two_cols_section_2_booking_button_text_left'][0]) ? $post_meta['_crb_two_cols_section_2_booking_button_text_right'][0] : "";
													if(!empty($see_more_text) && !empty($see_more_link))
													{
														?>
														<li class="see-more-link"><a href="<?php echo $see_more_link; ?>"><?php echo $see_more_text; ?></a></li>
														<?php
													}
													if(!empty($booking_text) && !empty($booking_link))
													{
														?>
														<li class="book-link"><a href="<?php echo $booking_link; ?>"><?php echo $booking_text; ?></a></li>
														<?php
													}
													?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 rm-pad">
						<div class="scroll-anim" data-anim="fade-up">
							<div class="img-desc align_center"><?php echo @$post_meta['_crb_two_cols_section_2_heading_right'][0];?></div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up"data-anim-delay="100" >
							<?php
							$section_image_url = wp_get_attachment_image_src( $post_meta['_crb_two_cols_section_2_image_right'][0], '621x386' );
							$section_image_url = $section_image_url[0];
							?>
							<img src="<?php echo $section_image_url; ?>" alt="" />
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													<?php echo @$post_meta['_crb_two_cols_section_2_description_right'][0];?>
												</div>
												<ul class="list-inline linking-wrap">
													<?php
													$see_more_link = (null !== @$post_meta['_crb_two_cols_section_2_more_button_link_right'][0]) ? $post_meta['_crb_two_cols_section_2_more_button_link_right'][0] : "";
													$see_more_text = (null !== @$post_meta['_crb_two_cols_section_2_more_button_text_right'][0]) ? $post_meta['_crb_two_cols_section_2_more_button_text_right'][0] : "";

													$booking_link = (null !== @$post_meta['_crb_two_cols_section_2_booking_button_link_right'][0]) ? $post_meta['_crb_two_cols_section_2_booking_button_link_right'][0] : "";
													$booking_text = (null !== @$post_meta['_crb_two_cols_section_2_booking_button_text_right'][0]) ? $post_meta['_crb_two_cols_section_2_booking_button_text_right'][0] : "";
													if(!empty($see_more_text) && !empty($see_more_link))
													{
														?>
														<li class="see-more-link"><a href="<?php echo $see_more_link; ?>"><?php echo $see_more_text; ?></a></li>
														<?php
													}
													if(!empty($booking_text) && !empty($booking_link))
													{
														?>
														<li class="book-link"><a href="<?php echo $booking_link; ?>"><?php echo $booking_text; ?></a></li>
														<?php
													}
													?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>
