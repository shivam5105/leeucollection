<?php
/*
Template Name: Home Page
*/
get_header();
?>
	<?php
	$post_id 	= $post->ID;
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;
    ?>
	<?php
	$has_slider = false;
	$slider_data = carbon_get_post_meta($post->ID, "crb_header_images", 'complex');
	if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
	{
		$has_slider = true;
	}
	$slider_wrapper_class = "owl-carousel single_slider_home owl-theme";
	if(!$has_slider)
	{
		$slider_wrapper_class = "";
	}
	?>
	<section id="site-main">
		<div class="container home-slider-container">
			<div class="single_slider_wrapper scroll-anim" data-anim="fade-up">
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
			<div class="customdotwrapper">
				<div class="customdothover">                
				</div>
				<div id="customDots"></div>
			</div>
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
									<option value="mercedes">4 guests</option>
									<option value="audi">5 guests</option>
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
									$hotel_image 			= $slide['crb_hotel_image'];
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
									$hotel_logo_url = wp_get_attachment_image_src( $hotel_logo );
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
									$active_nav = "";
									if($loop == 0)
									{
										$active_slide = "active-main-pagination";
									}
									?>
									<div class="gotoslide <?php echo $active_nav; ?>" data-object="<?php echo $loop; ?>"><?php echo $hotel_name; ?></div>
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
										$hotel_description 		= $slide['crb_hotel_description'];
										$hotel_image 			= $slide['crb_hotel_image'];
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
										$hotel_image_url = wp_get_attachment_image_src( $hotel_image, '1240x600' );
										$hotel_image_url = $hotel_image_url[0];
										?>
										<div class="slider-item" data-object="<?php echo $loop; ?>">
											<img src="<?php echo $hotel_image_url; ?>" alt="">
										</div>
										<?php
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
		<!-- <div class="container">
			<div class="home-res-wrap pagination-slider" data-unique-class="home-res-wrap">
				<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
					<h2 class="home-heading">RESTAURANTS</h2>
				</div>
				<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
					<div class="col-9 rm-pad-left">
						<div class="single_slider_wrapper">
							<div class="next"></div>
							<div class="owl-carousel single_slider_home_2 owl-theme">
								<div class="slider-item" data-object="0">  
									<img src="img/home-hotel-1.jpg" alt="">                  
								</div>
								<div class="slider-item" data-object="1">
									<img src="img/home-hotel-2.jpg" alt="">
								</div>
								<div class="slider-item" data-object="2">  
									<img src="img/home-hotel-3.jpg" alt="">                  
								</div>
								<div class="slider-item" data-object="3">  
									<img src="img/home-hotel-1.jpg" alt="">                  
								</div>
							</div>
							<div class="prev"></div>
						</div>
					</div>
					<div class="col-3 rm-pad-right">
						<div class="sliding-detail-wrapper">
							<div class="sliding-detail active-detail-slide" data-object="0">
								<div class="inner-detail-content">
									<div class="detail-logo"> 
										<img src="img/home-hotel-logo.svg" alt="">
									</div>
									<div class="content-part">
										Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
									</div>
									<ul class="list-inline linking-wrap">
										<li class="see-more-link"><a href="#">SEE MORE</a></li>
										<li class="book-link"><a href="#">BOOK</a></li>
									</ul>
								</div>
							</div>
							<div class="sliding-detail" data-object="1">
								<div class="inner-detail-content">
									<div class="detail-logo"> 
										<img src="img/home-hotel-logo.svg" alt="">
									</div>
									<div class="content-part">
										Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque,
									</div>
									<ul class="list-inline linking-wrap">
										<li class="see-more-link"><a href="#">SEE MORE</a></li>
										<li class="book-link"><a href="#">BOOK</a></li>
									</ul>
								</div>
							</div>
							<div class="sliding-detail" data-object="2">
								<div class="inner-detail-content">
									<div class="detail-logo"> 
										<img src="img/home-hotel-logo.svg" alt="">
									</div>
									<div class="content-part">
										Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
									</div>
									<ul class="list-inline linking-wrap">
										<li class="see-more-link"><a href="#">SEE MORE</a></li>
										<li class="book-link"><a href="#">BOOK</a></li>
									</ul>
								</div>
							</div>
							<div class="sliding-detail" data-object="3">
								<div class="inner-detail-content">
									<div class="detail-logo"> 
										<img src="img/home-hotel-logo.svg" alt="">
									</div>
									<div class="content-part">
										Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
									</div>
									<ul class="list-inline linking-wrap">
										<li class="see-more-link"><a href="#">SEE MORE</a></li>
										<li class="book-link"><a href="#">BOOK</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="main-nav-slider">
							<div class="gotoslidehead">FRANSCHHOEK, SOUTH AFRICA</div>
							<div class="gotoslide active-main-pagination" data-object="0">LEEU ESTATES</div>
							<div class="gotoslide" data-object="1">LEEU HOUSE</div>
							<div class="gotoslide" data-object="2">LE QUARTIER FRANÇAIS</div>
							<div class="gotoslidehead spc-top">LAKE DISTRICT, UNITED KINGDOM</div>
							<div class="gotoslide" data-object="3">LINTHWAITE HOUSE</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="container">
			<div class="listing-row clearfix">
				<div class="two-img-col mgt-topp">
					<div class="col-6 rm-pad">
						<div class="scroll-anim" data-anim="fade-up">
							<div class="img-desc align_center">
								<h2> meeting and events </h2>
							</div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up">
							<img src="img/meeting-and-events.jpg" alt="" />	
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
												</div>
												<ul class="list-inline linking-wrap">
													<li class="see-more-link"><a href="#">SEE MORE</a></li>
													<li class="book-link"><a href="#">BOOK</a></li>
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
								<h2> weddings </h2>
							</div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up" data-anim-delay="100">
							<img src="img/wedding.jpg" alt="" />
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
												</div>
												<ul class="list-inline linking-wrap">
													<li class="see-more-link"><a href="#">SEE MORE</a></li>
													<li class="book-link"><a href="#">BOOK</a></li>
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

		<div class="container">
			<div class="home-res-wrap pagination-slider" data-unique-class="home-res-wrap">
				<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
					<h2 class="home-heading">WINE</h2>
				</div>
				<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
					<div class="col-9 rm-pad-left">
						<div class="single_slider_wrapper">
							<div class="slider-item">  
								<img src="img/homepagewine.jpg" alt="">                  
							</div>
						</div>
					</div>
					<div class="col-3 rm-pad-right">
						<div class="sliding-detail-wrapper">
							<div class="sliding-detail active-detail-slide">
								<div class="inner-detail-content2">
									<div class="scroll-anim" data-anim="fade-up">
										<div class="desc-heading">Mullineux & Leeu Family Wines</div>
									</div>
									<div class="content-part">
										Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
									</div>
									<ul class="list-inline linking-wrap">
										<li class="see-more-link"><a href="#">SEE MORE</a></li>
										<li class="book-link"><a href="#">BOOK</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="main-nav-slider d_b">                                            
							<a href="#"> TOUR</a>  
							<a href="#">AWARDS</a>   
							<a href="#">INTERVIEW </a>   
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
							<div class="img-desc align_center"> art / gardens </div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up">
							<img src="img/artgarden.jpg" alt="" />	
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
												</div>
												<ul class="list-inline linking-wrap">
													<li class="see-more-link"><a href="#">SEE MORE</a></li>
													<li class="book-link"><a href="#">BOOK</a></li>
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
							<div class="img-desc align_center"> founder's tour of leeu estates </div>
						</div>
						<div class="banner-img hover_anim scroll-anim img_full" data-anim="fade-up"data-anim-delay="100" >
							<img src="img/founder_tour.jpg" alt="" />
							<div class="inner-detail-wrapper">
								<div class="inner-detail">
									<div class="row">
										<div class="col-11 col-centered">
											<div class="inner-detail-content">
												<div class="content-part">
													Lorem ipsum dolor sit amet, consectetur  adipiscing elit. Quisque lacus interdum imperdiet ultricies. Aliquam scelerisque, turpis ut iaculis suscipit lorem.
												</div>
												<ul class="list-inline linking-wrap">
													<li class="see-more-link"><a href="#">SEE MORE</a></li>
													<li class="book-link"><a href="#">BOOK</a></li>
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
		</div> -->
	</section>


<?php get_footer(); ?>
