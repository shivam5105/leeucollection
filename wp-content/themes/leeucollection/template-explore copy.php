<?php
/*
Template Name: Explore
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
					<div class="col-8">
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
													<div class="banner-img scroll-anim" data-anim="fade-up">
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
												<div class="banner-img scroll-anim" data-anim="fade-up">
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
							</div>							
							<div class="listing-box listing-row">
								<div class="follower">
									<h2 class="ucase"><?php echo @$post_meta['_crb_explore_instagram_heading'][0]; ?></h2>
								</div>
								<div class="feed_insta">
									<div id="instafeed"></div>
								</div>
								<?php
								$limit 			= @$post_meta['_crb_explore_instagram_limit'][0];
								$userid 		= @$post_meta['_crb_explore_instagram_userid'][0];
								$access_token 	= @$post_meta['_crb_explore_instagram_access_token'][0];
								if(empty($limit) || $limit < 1)
								{
									$limit = 6;
								}
								if(!empty($limit) && !empty($userid) && !empty($access_token))
								{
									?>
									<script type="text/javascript">
										userFeed = new Instafeed({
									        get:'user',
											limit:"<?php echo $limit; ?>",
									        userId:"<?php echo $userid; ?>",
									        accessToken:"<?php echo $access_token; ?>",
											resolution: 'standard_resolution'
									    });
									    userFeed.run();
									</script>
									<?php
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>