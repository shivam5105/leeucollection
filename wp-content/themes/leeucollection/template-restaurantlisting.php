<?php
/*
Template Name: Restaurant Listing
*/

get_header(); ?>
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
		<div class="container home-slider-container res-slider-container">
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
									<?php
									for($i=2; $i<9; $i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?> room<?php if($i > 1){ echo "s"; }?></option>
										<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-2 rm-pad">
							<div class="form-item select-item">
								<select>
									<?php
									for($i=2; $i<9; $i++)
									{
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?> guest<?php if($i > 1){ echo "s"; }?></option>
										<?php
									}
									?>
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
		$section_loop = 0;
		$res_sections = carbon_get_post_meta($post->ID, "crb_res_sections_new", 'complex');
		foreach ($res_sections as $res_key => $res_section)
		{
			$section_loop++;

			$res_name 				= $res_section['crb_res_name'];
			$res_logo 				= $res_section['crb_res_section_logo'];
			$section_description 	= $res_section['crb_res_section_description'];
			$more_button_link		= $res_section['crb_more_button_link'];
			$more_button_text		= $res_section['crb_more_button_text'];
			$booking_button_link 	= $res_section['crb_booking_button_link'];
			$booking_button_text 	= $res_section['crb_booking_button_text'];
			?>
			<div class="container">
				<div class="home-hotel-wrap-<?php echo $section_loop; ?> pagination-slider" data-unique-class="home-hotel-wrap-<?php echo $section_loop; ?>">
					<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
						<h2 class="home-heading ucase"><?php echo $res_name; ?></h2>
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
												<li class="book-link"><a href="<?php echo $booking_button_link; ?>"><?php echo $booking_button_text; ?></a></li>
												<?php
											}?>
										</ul>
									</div>
								</div>
							</div>
							<div class="main-nav-slider">
								<?php
								if(is_array($res_section['crb_res_section_details']) && count($res_section['crb_res_section_details']) > 0)
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
								?>
							</div>
						</div>
						<?php
						$col3_content = ob_get_clean();
						ob_implicit_flush(true);
						ob_start();

						$has_slider = false;
						$slider_data = $res_section['crb_res_section_slider'];
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
										$section_image = $slide['crb_res_section_image'];

										$section_image_url = wp_get_attachment_image_src( $section_image, '925x600' );
										$section_image_url = $section_image_url[0];
										if(!empty($section_image_url))
										{
											?>
											<div class="slider-item">
												<img src="<?php echo $section_image_url; ?>" alt="">
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
		}
		?>						
	</section>
<?php get_footer(); ?>
