<?php
/*
Template Name: Work
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
	    <div class="mobile-page-heading">
	    	<?php echo $page_heading;?>
	    </div>
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
											$propImage = false;
											if(is_array($slider_data) && !empty($slider_data))
											{
												foreach ($slider_data as $slide_key => $slide_data)
												{
													$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '821x478' );
													$banner_url = $banner_url[0];
													?>
													<div class="slide-item">
														<div class="banner-img scroll-anim" data-anim="fade-up">
															<img src="<?php echo $banner_url; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?> />
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
														<img src="<?php echo $banner_url; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?> />
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
						<div class="listing-box listing-row">
							<div class="text-right page-link"> </div>
							<div class="row detail-row">
								<div class="col-12">
									<div class="desc-heading"><?php echo @$post_meta['_crb_slider_bottom_heading'][0]; ?>
										<span class="description mgt-0"><?php echo nl2br(@$post_meta['_crb_slider_bottom_description'][0]); ?></span>
									</div>
								</div>
							</div>
						</div>


						<div class="listing-box listing-row work-masonry-grid">
							<?php
							$artists_details = carbon_get_post_meta($post->ID, "crb_artists_details", 'complex');
							$cols = 2;
							$x = 0;
							foreach ($artists_details as $ad_key => $artists_detail)
							{
								$artist_image 	= $artists_detail['crb_artist_image'];
								$artist_name 	= $artists_detail['crb_artist_name'];
								$artist_date 	= $artists_detail['crb_artist_date'];
								$artist_location= $artists_detail['crb_artist_location'];

								/*if($x == 0)
								{
									?>
									<div class="scroll-anim full_img animate-custom" data-anim="fade-up">
										<div class="row detail-row">
											<div class="mgb-30 clearfix art-temp">
									<?php
								}*/
								if($artist_image)
								{
									/*$artist_image = wp_get_attachment_image_src($artist_image, '411x258');*/
									$artist_image = wp_get_attachment_image_src($artist_image, 'full');
									$artist_image = $artist_image[0];
								}
								/*$col6_class 		= "pdr-0";
								$scroll_anim_class 	= "";
								$scroll_anim_attr 	= "";
								$art_cat_class 		= "art_cat";
								if($x == 1)
								{
									$col6_class 		= "pdl-0";
									$scroll_anim_class 	= "scroll-anim animate-custom";
									$scroll_anim_attr 	= 'data-anim="fade-up" data-anim-delay="100"';
									$art_cat_class 		= "art_cat2";
								}*/
								?>
								<div class="col-6 <?php echo $col6_class; ?> grid-item">
									<div class="<?php echo $scroll_anim_class; ?>" <?php echo $scroll_anim_attr; ?>>
										<div class="<?php echo $art_cat_class; ?> full-img">
											<?php
											if(!empty($artist_image))
											{
												?>
												<img src="<?php echo $artist_image; ?>" alt="" />
												<?php
											}
											?>
										</div>
										<div class="desc-heading mgt-25"><?php echo $artist_name; ?>
											<span class="session_rate mgt-0 ucase">
												<?php echo trim($artist_date); ?><?php if(!empty($artist_location)){ echo ", "; } echo trim($artist_location); ?>
											</span>
										</div>
									</div>
								</div>
								<?php
								/*$x++;
								if($x == $cols)
								{
									$x = 0;
									?>
											</div>
										</div>
									</div>
									<?php
								}*/
							}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>