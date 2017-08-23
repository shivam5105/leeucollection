<?php
/*
Template Name: Founder & Team
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
							<div class="leeu-text ucase" itemprop="name">
								<?php
								$page_small_heading = @$post_meta['_crb_page_small_heading'][0];
								if(!empty($page_small_heading))
								{
									echo $page_small_heading;
								}
								else
								{
									if($top_most_parent_post)
									{
										echo $top_most_parent_post->post_title;
									}
								}
								?>
							</div>
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
						<div class="listing-box listing-row">
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
							<div class="scroll-anim" data-anim="fade-up">
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
										foreach ($slider_data as $slide_key => $slide_data)
										{
											$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '821x478' );
											$banner_url = $banner_url[0];
											?>
											<div class="slide-item">
												<div class="scroll-anim" data-anim="fade-up">
													<img src="<?php echo $banner_url; ?>" alt="">
												</div>
											</div>
											<?php
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

							<div class="row detail-row">
								<div class="col-12">
									<div class="the_founder ucase">
										<h2><?php echo @$post_meta['_crb_founder_name'][0]; ?></h2>
									</div>
									<div class="leeu-text founder_txt">
										<?php echo @$post_meta['_crb_text_under_founder_name'][0]; ?>
									</div>
								</div>
							</div>
							<div class="row detail-row">
								<div class="col-6">
									<div class="desc-content">
										<p> 
											<?php echo nl2br(@$post_meta['_crb_founder_description_left'][0]); ?>
										</p>
									</div>
								</div>
								<div class="col-6">
									<div class="desc-content">
										<p> 
											<?php echo nl2br(@$post_meta['_crb_founder_description_right'][0]); ?>
										</p>
									</div>
								</div>
							</div>
						</div>

						<div class="row detail-row">
							<div class="col-12">
								<div class="the_founder mgb-15 ucase">
									<h2><?php echo @$post_meta['_crb_team_heading'][0]; ?></h2>
								</div>
							</div>
						</div>
						<div class="listing-box listing-row">
							<?php
							$team_details = carbon_get_post_meta($post->ID, "crb_team_details", 'complex');
							$cols = 2;
							$x = 0;
							foreach ($team_details as $team_key => $team)
							{
								if($x == 0)
								{
									?>
									<div class="scroll-anim full_img animate-custom" data-anim="fade-up">
										<div class="row detail-row">
											<div class="mgb-30 clearfix">
									<?php
								}
								$member_image = $team['crb_member_image'];
								if($member_image)
								{
									$member_image = wp_get_attachment_image_src($member_image, '411x258');
									$member_image = $member_image[0];
								}
								$col6_class 		= "pdr-0";
								$scroll_anim_class 	= "";
								$scroll_anim_attr 	= "";
								$art_cat_class 		= "art_cat";
								if($x == 1)
								{
									$col6_class 		= "pdl-0";
									$scroll_anim_class 	= "scroll-anim animate-custom";
									$scroll_anim_attr 	= 'data-anim="fade-up" data-anim-delay="100"';
									$art_cat_class 		= "art_cat2";
								}
								?>
								<div class="col-6 <?php echo $col6_class; ?>">
									<div class="<?php echo $scroll_anim_class; ?>" <?php echo $scroll_anim_attr; ?>>
										<div class="<?php echo $art_cat_class; ?> full-img">
											<?php
											if(!empty($member_image))
											{
												?>
												<img src="<?php echo $member_image; ?>" alt="" />
												<?php
											}
											?>
										</div>
										<div class="desc-heading mgt-25">
											<?php echo $team['crb_member_name']; ?>
										</div>
									</div>
								</div>
								<?php
								$x++;
								if($x == $cols)
								{
									$x = 0;
									?>
											</div>
										</div>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>