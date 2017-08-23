<?php
/*
Template Name: Room
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
		<div itemscope itemtype="http://schema.org/HotelRoom">
			<div class="container desktop-only">
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
								<div class="listing-box listing-row">
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
														<div class="banner-img scroll-anim full_img" data-anim="fade-up">
															<img src="<?php echo $banner_url; ?>" alt="" />
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
													<div class="banner-img scroll-anim full_img" data-anim="fade-up">
														<img src="<?php echo $banner_url; ?>" alt="" />
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

									<div class="row detail-row">
										<div class="col-3">
											<div class="desc-heading"><?php echo @$post_meta['_crb_slider_bottom_heading'][0]; ?></div>
										</div>
										<div class="col-9">
											<div class="desc-content" itemprop="description"> 
												<?php echo nl2br(@$post_meta['_crb_slider_bottom_description'][0]); ?>
											</div>
										</div>
									</div>
									<div class="row detail-row clearfix">
										<div class="col-3">
											<!-- <div class="leeu-text">Rate</div> -->
											<div class="cstm-btn-wrapper ">
												<!-- <div class="hotel-rate" itemprop="priceRange">
													<?php //echo @$post_meta['_crb_rate_amount'][0]; ?>
													<?php //echo @$post_meta['_crb_rate_for'][0]; ?>
												</div> -->
												<?php
												if(isset($post_meta['_crb_show_booking_button']) && is_array($post_meta['_crb_show_booking_button']) && $post_meta['_crb_show_booking_button'][0] == 'yes')
												{
													?>
													<a class="cstm-btn arrow-btn text-center popup-booking-button-anchor" href="javascript:void(0);" data-booking-at="<?php echo addslashes($top_most_parent_post->post_title); ?>" data-booking-for="hotel">Book</a>
													<?php
												}?>
											</div>
										</div>
										<div class="col-9">
											<div class="leeu-text"> SPECIAL FEATURES</div>
											<div class="row spl-features">
												<div class="col-6 rm-pad">
													<?php
													if(is_array($post_meta['_crb_special_feature']) && !empty($post_meta['_crb_special_feature'][0]))
													{
														?>
														<div class="desc-content special-features" itemprop="amenityFeature"> 
															<?php echo nl2br(@$post_meta['_crb_special_feature'][0]); ?>
														</div>
														<?php
													}
													?>
												</div>
												<div class="col-6 rm-pad">
													<?php
													if(isset($post_meta['_crb_special_feature_second']) && is_array($post_meta['_crb_special_feature_second']) && !empty($post_meta['_crb_special_feature_second'][0]))
													{
														?>
														<div class="desc-content special-features" itemprop="amenityFeature"> 
															<?php echo nl2br(@$post_meta['_crb_special_feature_second'][0]); ?>
														</div>
														<?php
													}
													?>
											   </div> 	
											</div>
										</div>
									</div>
								</div>
								<div class="hotel-menu hotel-gallery-wrapper">
									<div class="listing-row clearfix">
										<div class="three-img-col">
											<?php 
											$galleries 	= carbon_get_post_meta($post->ID, 'crb_room_gallery','complex');
											$videos 	= carbon_get_post_meta($post->ID, 'crb_room_video','complex'); 
											$floors 	= carbon_get_post_meta($post->ID, 'crb_room_floor_layout','complex'); 
											$total_cols = 0;	
											if(!empty($galleries))
											{
												$total_cols++;
											}
											if(!empty($videos))
											{
												$total_cols++;
											}
											if(!empty($floors))
											{
												$total_cols++;
											}
											$col_class = "";
											if($total_cols > 0)
											{
												$col_class = "col-".(12/$total_cols);
											}
											if(!empty($galleries))
											{
												?>
												<div class="<?php echo $col_class; ?> rm-pad gallery-thumb" data-rel="popup-slider-1">
													<div class="banner-img full_img scroll-anim" data-anim="fade-up">
														<img src="<?php echo get_template_directory_uri(); ?>/images/gallery-image-main.jpg" alt="" />
													</div>
													<div class="img-desc">
														Gallery
													</div>
												</div>
												<?php
											}
											if(!empty($videos))
											{
												?>
												<div class="<?php echo $col_class; ?> rm-pad gallery-thumb" data-rel="popup-slider-2">
													<div class="banner-img full_img scroll-anim" data-anim="fade-up" data-anim-delay="100">
														<img src="<?php echo get_template_directory_uri(); ?>/images/video-main.jpg" alt="" />
													</div>
													<div class="img-desc">VIDEO</div>
												</div>
												<?php
											}
											if(!empty($floors))
											{
												?>
												<div class="<?php echo $col_class; ?> rm-pad gallery-thumb" data-rel="popup-slider-3">
													<div class="banner-img full_img scroll-anim" data-anim="fade-up" data-anim-delay="200">
														<img src="<?php echo get_template_directory_uri(); ?>/images/floor-main.jpg" alt="" />
													</div>
													<div class="img-desc">FLOOR LAYOUT</div>
												</div>
												<?php
											}
											?>
										</div>
									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="slider-container popup-slider-1">
				<a href="javascript:void(0);" class="close-gallery">Close</a>
				<div class="gallery-slider owl-carousel owl-theme">
					<?php 
						foreach($galleries as $gallery_key => $gallery){
							$gallery_img = wp_get_attachment_image_src( $gallery['crb_gallery_image'], '821x478' );
							$gallery_img = $gallery_img[0];
							?>
						<div class="slides">
							<img src="<?php echo $gallery_img;?>" alt="" />
						</div>
					<?php }	
					?>
				</div>
			</div>
			<div class="slider-container popup-slider-2">
				<a href="javascript:void(0);" class="close-gallery">Close</a>
				<div class="gallery-slider owl-carousel owl-theme">
					<?php 
						foreach($videos as $video_key => $video){
							$video_text = $video['crb_room_video'];
							?>
						<div class="slides">
							<iframe width="821" height="478" src="<?php echo $video_text; ?>" frameborder="0" allowfullscreen></iframe>
						</div>
					<?php }	
					?>
				</div>
			</div>
			<div class="slider-container popup-slider-3">
				<a href="javascript:void(0);" class="close-gallery">Close</a>
				<div class="gallery-slider owl-carousel owl-theme">
					<?php 
						foreach($floors as $floor_key => $floor){
							$floor_img = wp_get_attachment_image_src( $floor['crb_floor_image'], '821x478' );
							$floor_img = $floor_img[0];
							?>
						<div class="slides">
							<img src="<?php echo $floor_img;?>" alt="" />
						</div>
					<?php }	
					?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>