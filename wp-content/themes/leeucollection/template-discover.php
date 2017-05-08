<?php
/*
Template Name: Discover Page
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
		<div class="container home-slider-container discover-slider-container">
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
		$slider_data = carbon_get_post_meta($post->ID, "crb_page_content_section", 'complex');
		$unique_index = 0;
		foreach ($slider_data as $slider_key => $slider_content)
		{
			$has_slider = false;
			$slider_data = $slider_content['crb_section_detail'];
			if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
			{
				$has_slider = true;
			}
			$slider_wrapper_class = "owl-carousel single_slider_home_2 owl-theme";
			if(!$has_slider)
			{
				$slider_wrapper_class = "active";
			}
			?>
			<div class="container">
				<div class="home-hotel-wrap-<?php echo $unique_index; ?> pagination-slider" data-unique-class="home-hotel-wrap-<?php echo $unique_index; ?>">
					<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
						<h2 class="home-heading ucase"><?php echo $slider_content['crb_page_section_heading']; ?></h2>
					</div>		
					<div class="row scroll-anim animate-custom flx" data-anim="fade-up">
						<?php 
						if ($unique_index % 2 == 0) {
							$image_space = 'rm-pad-right';
							$nav_space = 'rm-pad-left';
  							include('template-parts/discover-slide-nav.php'); 
  							include('template-parts/discover-slide-image.php');
						}else{
							$image_space = 'rm-pad-left';
							$nav_space = 'rm-pad-right';
							include('template-parts/discover-slide-image.php');	
  							include('template-parts/discover-slide-nav.php'); 
						}
						?>
					</div>
				</div>	
			</div>	
			<?php 
			$unique_index++;
		}
		?>
	</section>

<?php get_footer(); ?>