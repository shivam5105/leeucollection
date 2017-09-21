<?php
/*
Template Name: Restaurant Listing
*/

get_header(); ?>
	<?php
	the_post();
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
		<div class="container home-slider-container res-slider-container <?php if(!$has_slider){ echo "no_slider_wrapper"; }?>">
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

							$banner_url = wp_get_attachment_image_src( $slide_data['crb_header_image'], '1240x600' );
							$banner_url = $banner_url[0];
							?>
							<div class="slide-img">
								<div class="banner-img for-mob mht_homebanner" style="background-image:url('<?php echo $banner_url; ?>')"> </div>
								<img class="for-mob-hide" src="<?php echo $banner_url; ?>" alt="">
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
		<?php 
			$theContent = get_the_content();
			if(!empty($theContent)){?>
			<div class="intro-blurb scroll-anim restaurant-description" data-anim="fade-up">
				<div class="col-10 col-centered">
					<div class="text-center" itemprop="description">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			<?php }?>
		<?php
		$section_loop = 0;
		$res_sections = carbon_get_post_meta($post->ID, "crb_res_sections_new", 'complex');
		if(is_array($res_sections) && !empty($res_sections)){
		foreach ($res_sections as $res_key => $res_section)
		{
			$section_loop++;

			$res_name 				= $res_section['crb_res_name'];
			$res_logo 				= $res_section['crb_res_section_logo'];
			$sub_heading 			= @$res_section['crb_res_sub_heading'];
			$section_description 	= $res_section['crb_res_section_description'];
			$more_button_link		= $res_section['crb_more_button_link'];
			$more_button_text		= $res_section['crb_more_button_text'];
			$booking_button_link 	= $res_section['crb_booking_button_link'];
			$booking_button_text 	= $res_section['crb_booking_button_text'];
			?>
			<?php if(!empty($res_name) || !empty($res_logo) || !empty($sub_heading) || !empty($section_description) || !empty($more_button_link) || !empty($more_button_text) || !empty($booking_button_link) || !empty($booking_button_text)){?>
			<div class="container">
				<div class="home-hotel-wrap-<?php echo $section_loop; ?> pagination-slider" data-unique-class="home-hotel-wrap-<?php echo $section_loop; ?>">
					<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
						<h2 class="home-heading ucase"><?php echo $res_name; ?></h2>
					</div>
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
										$res_logo_url = wp_get_attachment_image_src( $res_logo, 'original' );
										$res_logo_url = $res_logo_url[0];
										if(!empty($res_logo_url))
										{
											?>
											<div class="detail-logo">
												<img src="<?php echo $res_logo_url; ?>" alt="">
											</div>
											<?php
										}?>
										<?php if(!empty($sub_heading))
										{
											?>
											<div class="detail-logo desc-heading">
												<?php echo $sub_heading; ?>
											</div>
											<?php
										}?>
										<!-- <div class="section-title-mobile"><?php echo $res_name; ?></div> -->
										<?php if(!empty($section_description)){?>
											<div class="content-part">
												<?php echo nl2br($section_description); ?>
											</div>
										<?php } ?>
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
												<li class="book-link"><a href="javascript:void(0)" data-connection-id="<?php echo $booking_button_link; ?>" id="booktable-res-<?php echo $section_loop; ?>" class="booktable" target="_blank"><?php echo $booking_button_text; ?></a></li>
												<?php
											}?>
										</ul>
									</div>
								</div>
							</div>
							<div class="main-nav-slider for-desk">
								<?php
								$res_section_details = @$res_section['crb_res_section_details'];
								if(is_array($res_section_details) || is_object($res_section_details)){
								if(count($res_section['crb_res_section_details']) > 0)
								{
									$loop = 0;
									foreach ($res_section['crb_res_section_details'] as $sd_key => $links_details)
									{
										$res_locations = $links_details['crb_res_locations'];
										$location_class = "";
										if($loop > 0)
										{
											$location_class = "spc-top";
										}
										?>
										<div class="gotoslidehead <?php echo $location_class; ?> ucase"><?php echo $res_locations; ?></div>
										<?php
										foreach ($links_details['crb_res_section_link_details'] as $ld_key => $links)
										{
											$section_name = $links['crb_res_section_name'];
											$section_link = $links['crb_res_section_link'];
											if(!empty($section_name) && !empty($section_link))
											{
												?>
												<div class="gotoslide"><a href="<?php echo $section_link; ?>"><?php echo $section_name; ?></a></div>
												<?php
											}
										}
										$loop++;
									}
								}
								}
								?>
							</div>
						</div>
						<?php
						$col3_content = ob_get_clean();
						ob_implicit_flush(true);
						ob_start();

						$has_slider = false;
						$slider_data = @$res_section['crb_res_section_slider'];
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
									if(is_array($slider_data)){
									foreach ($slider_data as $slide_key => $slide)
									{
										$section_image = $slide['crb_res_section_image'];

										$section_image_url = wp_get_attachment_image_src( $section_image, '925x600' );
										$section_image_url = $section_image_url[0];
										if(!empty($section_image_url))
										{
											?>
											<div class="slider-item">
												<img src="<?php echo $section_image_url; ?>" alt="">
												<?php
												if(!empty($more_button_link))
												{
													?>
													<a href="<?php echo $more_button_link; ?>" class="main-link"></a>
													<?php
												}
												?>
											</div>
											<?php
										}
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
						?>
					</div>
				</div>
			</div>
			<?php
		}
		}
		}
		?>
		<div class="container half-layout-section">
			<?php
			$half_layout = carbon_get_post_meta($post->ID, "crb_half_layout", 'complex');
			if(is_array($half_layout) && !empty($half_layout)){
			foreach ($half_layout as $re_key => $half_layout_section)
			{	
				$title 	= $half_layout_section['crb_half_layout_main_title'];
				$first_image 	= $half_layout_section['crb_half_layout_first_image'];
				$second_image 	= $half_layout_section['crb_half_layout_second_image'];
				$first_heading = $half_layout_section['crb_half_layout_first_heading'];
				$second_heading = $half_layout_section['crb_half_layout_second_heading'];
				$first_image_url = wp_get_attachment_image_src( $first_image, 'original' );
				$first_image_link = $first_image_url[0];
				$second_image_url = wp_get_attachment_image_src( $second_image, 'original' );
				$second_image_link = $second_image_url[0];
				?>
			<?php if(!empty($title) || !empty($first_image_link) || !empty($first_heading) || !empty($second_image_link) || !empty($second_heading)){ ?>
			<div class="row clearfix space-top half-layouts">
				<?php if(!empty($title)){?>
					<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
						<h2 class="text-center home-heading ucase"><?php echo $title; ?></h2>
					</div>
				<?php }?>
				<?php if(!empty($first_image_link) || !empty($first_heading)) {?>
					<div class="col-6 rm-pad">
						<div class="half-layout-image scroll-anim animate-custom" data-anim="fade-up">
							<img src="<?php echo $first_image_link;?>" alt="<?php echo $first_heading; ?>">
						</div>
						<div class="sub-heading"><h2 class="text-center ucase"><?php echo $first_heading; ?></h2></div>
					</div>
				<?php }?>
				<?php if(!empty($second_image_link) || !empty($second_heading)) {?>
					<div class="col-6 rm-pad">
						<div class="half-layout-image scroll-anim animate-custom" data-anim="fade-up">
							<img src="<?php echo $second_image_link;?>" alt="<?php echo $second_heading; ?>">
						</div>
						<div class="sub-heading"><h2 class="text-center ucase"><?php echo $second_heading; ?></h2></div>
					</div>
				<?php }?>
		 	</div>
			<?php }
				}
				}
			?>
		</div>								
	</section>
<?php get_footer(); ?>
