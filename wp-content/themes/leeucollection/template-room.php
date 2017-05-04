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
		<div class="container">
			<div class="leeu-heading-wrap scroll-anim" data-anim="fade-up">
				<div class="row">
					<div class="col-2 rm-pad"></div>
					<div class="col-8 rm-pad">
						<div class="text-center">
							<!-- <div class="leeu-text ucase" itemprop="legalName"><?php echo $top_most_parent_post->post_title;?></div> -->
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
										<div class="desc-content"> 
											<?php echo nl2br(@$post_meta['_crb_slider_bottom_description'][0]); ?>
										</div>
									</div>
								</div>
								<div class="row detail-row clearfix">
									<div class="col-3">
										<div class="leeu-text">Rate</div>
										<div class="cstm-btn-wrapper ">
											<div class="hotel-rate" itemprop="priceRange">
												<?php echo @$post_meta['_crb_rate_amount'][0]; ?>
												<?php echo @$post_meta['_crb_rate_for'][0]; ?>
											</div>
											<?php
											if(is_array($post_meta['_crb_booking_buton_link']) && !empty($post_meta['_crb_booking_buton_link'][0]))
											{
												?>
												<a href="<?php echo $post_meta['_crb_booking_buton_link'][0]; ?>" class="cstm-btn arrow-btn text-center" target="_blank"><?php echo $post_meta['_crb_booking_buton_text'][0]; ?></a>
												<?php
											}?>
										</div>
									</div>
									<div class="col-9">
										<div class="leeu-text"> SPECIAL FEATURES</div>
										<div class="desc-content desc-content-two-col" itemprop="amenityFeature"> 
											<?php echo nl2br(@$post_meta['_crb_special_feature'][0]); ?>
										</div>
									</div>
								</div>
							</div>
							<div class="hotel-menu hotel-gallery-wrapper">
								<div class="listing-row clearfix">
									<div class="three-img-col">
										<div class="col-4 rm-pad">
											<div class="banner-img  full_img scroll-anim" data-anim="fade-up">
												<img src="<?php echo get_template_directory_uri(); ?>/images/gallery-image-main.jpg" alt="" />
											</div>
											<div class="img-desc">gallery</div>
										</div>
										<div class="col-4 rm-pad">
											<div class="banner-img full_img scroll-anim" data-anim="fade-up" data-anim-delay="100">
												<img src="<?php echo get_template_directory_uri(); ?>/images/video-main.jpg" alt="" />
											</div>
											<div class="img-desc">VIDEO</div>
										</div>
										<div class="col-4 rm-pad">
											<div class="banner-img full_img scroll-anim" data-anim="fade-up" data-anim-delay="200">
												<img src="<?php echo get_template_directory_uri(); ?>/images/floor-main.jpg" alt="" />
											</div>
											<div class="img-desc">FLOOR LAYOUT</div>
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
