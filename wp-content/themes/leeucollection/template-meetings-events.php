<?php
/*
Template Name: Meetings & Events
*/
get_header(); ?>
	<?php
	the_post();
	$post_id 	= $post->ID;
	$hotel_id 	= get_hotel_id($post_id);
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;
    
	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);
	$hotel_location = @$post_meta['_crb_page_country'][0];
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
							$section_sliders = carbon_get_post_meta($post->ID, "crb_section_slider", 'complex');
							$has_slider = false;
							if(is_array($section_sliders) && count($section_sliders) > 1)
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
							<div class="listing-box listing-row">
								<div class="<?php echo $slider_wrapper_class; ?> <?php if(!$has_slider){ echo "no_slider"; }?>">
									<?php
									if($has_slider)
									{
										?>
										<div class="next-wrapper">
											<div class="next"></div>
										</div>
										<?php
									}?>
									<div class="<?php echo $slider_theme_class; ?>">
										<?php
										if(is_array($section_sliders) && !empty($section_sliders))
										{
											foreach($section_sliders as $slider_key => $section_slider)
											{
												$slide_image 	= $section_slider['crb_section_slide_image'];
												$slide_title 	= $section_slider['crb_section_slide_title'];
												$slide_desc 	= $section_slider['crb_section_slide_desc'];

												$slide_image_url = wp_get_attachment_image_src( $slide_image, '821x478' );
												$slide_image_url = $slide_image_url[0];
												?>
												<div class="slide-item">
													<div class="scroll-anim" data-anim="fade-up">
														<img src="<?php echo $slide_image_url; ?>" alt="">
													</div>
													<div class="row detail-row">
														<div class="col-3">
															<div class="desc-heading"><?php echo nl2br($slide_title); ?></div>
														</div>
														<div class="col-9">
															<div class="desc-content"> 
																<?php echo nl2br($slide_desc); ?>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
										}
										?>
									</div>
									<?php
									if($has_slider)
									{
										?>
										<div class="prev-wrapper">
											<div class="prev"></div>
										</div>
										<?php
									}?>
								</div>
							</div>

							<div class="listing-box listing-row">
								<div class="row detail-row meetings-form">
									<div class="the_founder">
										<h2 class="ucase"><?php echo @$post_meta['_crb_form_heading'][0]; ?></h2>
									</div>
									<div class="form_field">
										<div class="inside_pd">
											<?php the_content(); ?>
											<!-- <div class="email_sec">
												<div class="name_opt"> NAME </div>
												<div class="name_field">
													<input type="text" name="firstname" placeholder="your name">
												</div>
											</div>
											<div class="enq_sec">
												<div class="enquiry_opt"> ENQUIRY TYPE </div>
												<div class="opt_field">
													<select>
														<option value="volvo" selected>Select an option</option>
														<option value="saab">Saab</option>
														<option value="vw">VW</option>
														<option value="audi">Audi</option>
													</select>
												</div>
											</div>
											<div class="msg_opt">MESSAGE</div>
											<div class="message_field clearfix">
												<div class="textarea_field"> 
													<textarea name="textarea" rows="6" cols="70" placeholder="Enter your message here" type="text"></textarea>
												</div>
												<div class="send_msg pull-right"> 
													<button type="button"> SEND MESSAGE</button>
												</div>
											</div> -->
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