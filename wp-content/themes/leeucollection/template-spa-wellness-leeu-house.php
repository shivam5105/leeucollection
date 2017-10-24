<?php
/*
Template Name: Spa & Wellness Leeu House
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
						<?php
						$content_sections = carbon_get_post_meta($post->ID, "crb_spa_content_section2", 'complex');
						if(is_array($content_sections) && !empty($content_sections))
						{
							foreach ($content_sections as $section_key => $content_section)
							{
								$section_sliders	= (@$content_section['crb_spa_section_slider']);
								$slide_link_text	= $content_section['crb_spa_section_slide_link_text'];
								$slide_link_url		= $content_section['crb_spa_section_slide_link_url'];
								$slide_desc 		= $content_section['crb_spa_section_slide_desc'];	
								$has_slider 		= false;
								if(is_array($section_sliders) && count($section_sliders) > 1)
									{
										$has_slider = true;
									}
									$slider_wrapper_class = "owl-carousel single_slider owl-theme";
									if(!$has_slider)
									{
										$slider_wrapper_class = "";
									}
								?>
								<?php if(is_array($section_sliders) || is_object($section_sliders)){ ?>
								<div class="listing-box listing-row" itemscope itemtype="http://schema.org/Place">
									<div class="scroll-anim" data-anim="fade-up">
										<div class="listing-box">
											<div class="single_slider_wrapper <?php if(!$has_slider){ echo "no_slider"; }?>">
												<?php
												if($has_slider)
												{
													?>
													<div class="next"></div>
													<?php
												}?>
												<div class="<?php echo $slider_wrapper_class; ?>">
													<?php
													
													foreach($section_sliders as $slider_key => $section_slider)
													{
														$slide_image 	= $section_slider['crb_spa_section_slide_image'];
														$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
														$slide_image_url = $slide_image_url[0];
														?>
														<div class="slide-item">
															<div class="banner-img scroll-anim" data-anim="fade-up">
																<img src="<?php echo $slide_image_url; ?>" alt="" itemprop="image" />
																<?php
																if(!empty($slide_link_url))
																{
																	?>
																	<a href="<?php echo $slide_link_url; ?>" class="main-link"></a>
																	<?php
																}?>
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
											<div class="row detail-row spa-wellness-row">
												<div class="col-9">
													<div class="desc-content" itemprop="description"> 
														<?php echo nl2br($slide_desc); ?>
													</div>
												</div>
												<div class="col-3">
													<?php
													if(!empty($slide_link_text) && !empty($slide_link_url))
													{
														?>
														<div class="cstm-btn-wrapper pull-right text-center">
															<a href="<?php echo $slide_link_url; ?>" class="cstm-btn arrow-btn"><?php echo $slide_link_text; ?></a>
														</div>
														<?php
													}?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>