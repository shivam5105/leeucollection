<?php
/*
Template Name: News
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
						<div class="scroll-anim" data-anim="fade-up">
							<?php
							$propImage = false;
					    	$accolades = carbon_get_post_meta($post->ID, "crb_accolades", 'complex');
							if(is_array($accolades) && !empty($accolades))
							{
								foreach ($accolades as $accolade_key => $accolade)
								{
									$accolade_title = $accolade['crb_accolade_title'];
									$link_text 		= $accolade['crb_accolade_link_text'];
									$link 			= $accolade['crb_accolade_link'];
									$accolade_images= $accolade['crb_accolade_images'];
									?>
									<div class="listing-box listing-row">
										<?php
										$has_slider = false;
										if(is_array($accolade_images) && count($accolade_images) > 1)
										{
											$has_slider = true;
										}

										$slider_wrapper_class 	= "single_slider_wrapper";
										$slider_theme_class 	= "owl-carousel single_slider owl-theme";

										if(!$has_slider)
										{
											$slider_theme_class = "";
										}
										?>
										<div class="<?php echo $slider_wrapper_class; ?> <?php if(!$has_slider){ echo "no_slider"; }?>">
											<?php
											if($has_slider)
											{
												?>
												<div class="next"></div>
												<?php
											}?>
											<div class="<?php echo $slider_theme_class; ?>">
												<?php
												foreach($accolade_images as $slider_key => $section_slider)
												{
													$slide_image 	= $section_slider['crb_image'];

													$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
													$slide_image_url = $slide_image_url[0];
													?>
													<div class="slide-item">
														<div class="scroll-anim" data-anim="fade-up">
															<img src="<?php echo $slide_image_url; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?>>
														</div>
													</div>
													<?php
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
										<div class="row detail-row">
											<div class="col-9">
												<div class="desc-heading"><?php echo $accolade_title; ?></div>
											</div>
											<div class="col-3">
												<?php
												if(!empty($link_text) && !empty($link))
												{
													?>
													<div class="dwnldlink desktop-only"><a href="<?php echo $link; ?>" target="_blank"><?php echo $link_text; ?></a></div>

													<div class="cstm-btn-wrapper mobile-only">
														<a class="cstm-btn arrow-btn text-center" href="<?php echo $link; ?>" target="_blank"><?php echo $link_text; ?></a>
													</div>
													<?php
												}
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