<?php
/*
Template Name: Contact
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
						</div>
						<div class="contact-detail">
							<?php
					    	$contact_sections = carbon_get_post_meta($post->ID, "crb_contact_sections", 'complex');
					    	$x = 0;
					    	$cols = 3;
					    	foreach ($contact_sections as $cs_key => $contact_section)
					    	{
					    		foreach ($contact_section['crb_contact_detail'] as $key => $contact_info)
					    		{
						    		$x++;

						    		if($x == 1)
						    		{
						    			$col_div_class = "col-3 col-offset-right-2";
						    		}
						    		else if($x == 2)
						    		{
						    			$col_div_class = "col-4";
						    		}
						    		else if($x == 3)
						    		{
						    			$col_div_class = "col-3 contact-pad-left";
						    		}
						    		?>
									<div class="<?php echo $col_div_class; ?> rm-pad"> 
										<div class="contact-sub-head"><?php echo $contact_section['crb_contact_heading']; ?></div>
										<div class="address-contact contact-spacer">
											<div class="leeu-text">ADDRESS</div>
											<div class="content-part"> 
												<?php echo nl2br($contact_info['crb_contact_address']); ?>
											</div>
										</div>
										<?php
										if(!empty($contact_info['crb_contact_phone']))
										{
											?>
											<div class="phone-contact contact-spacer">
												<div class="leeu-text">PHONE</div>
												<div class="content-part"> 
													<?php echo $contact_info['crb_contact_phone']; ?>
												</div>
											</div>
											<?php
										}
										if(!empty($contact_info['crb_contact_fax']))
										{
											?>
											<div class="fax-contact contact-spacer">
												<div class="leeu-text">FACSIMILE</div>
												<div class="content-part"> 
													<?php echo $contact_info['crb_contact_fax']; ?>
												</div>
											</div>
											<?php
										}
										if(!empty($contact_info['crb_contact_email']))
										{
											?>
											<div class="cstm-btn-wrapper contact-email contact-spacer">
												<a href="mailto:<?php echo $contact_info['crb_contact_email']; ?>"  class="booktable cstm-btn arrow-btn text-center">Email</a>
											</div>
											<?php
										}
										?>
									</div>
						    		<?php
						    		if($x == $cols)
						    		{
						    			$x = 0;
						    		}
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