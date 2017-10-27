<?php
/*
Template Name: Spa Treatments
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
	    	<?php
	    	if(!empty($post) && $post->post_parent > 0)
	    	{
		    	?>
		    	<a href="<?php echo get_permalink($post->post_parent); ?>" class="mobile-prev-page fa fa-angle-left"></a>
		    	<?php
		    }
		    ?>
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
						<div class="listing-box">
							<div class="scroll-anim" data-anim="fade-up">
								<?php
								$services_sections_group = carbon_get_post_meta($post->ID, 'crb_services_sections_group', 'complex');
								foreach ($services_sections_group as $sg_key => $services_section_group)
								{
									$service_main_heading = $services_section_group['crb_service_main_heading'];

									if($service_main_heading && !empty($service_main_heading))
									{
										?>
										<div class="transformed_head">
											<h2 class="ucase"><?php echo $service_main_heading;?></h2>
										</div>
										<?php
									}
									if(isset($services_section_group['crb_services_sections']) && is_array($services_section_group['crb_services_sections']))
									{
										foreach ($services_section_group['crb_services_sections'] as $ss_key => $services_section)
										{
											$service_duration 	= $services_section['crb_service_duration'];
											$service_heading 	= $services_section['crb_service_heading'];
											$remove_bottom_margin 	= @$services_section['crb_remove_bottom_margin'];
											?>
											<div itemscope itemtype="http://schema.org/Product" class="service-wrapper clearfix <?php if($remove_bottom_margin == 'yes'){ echo 'rm-margin-bottom'; } ?>">
												<div class="col-10 pd-0">
													<div class="transformed">
														<div class="summer_heading">
															<h3 itemprop="name"><?php echo $service_heading; ?></h3>
														</div>
													</div>
												</div>
												<div class="col-2">
													<div class="timing_func">
														<p><?php echo $service_duration; ?></p>
													</div>
												</div>
												<?php
												if(isset($services_section['crb_services']) && is_array($services_section['crb_services']))
												{
													foreach ($services_section['crb_services'] as $s_key => $services)
													{
														?>
														<div class="col-10 pd-0">
															<div class="transformed">
																<div class="summer_paragaraph" itemprop="description">
																	<p><?php echo $services['crb_service_details']; ?></p>
																</div>
															</div>
														</div>
														<div class="col-2">
															<div class="timing_func">
																<p><?php echo $services['crb_service_price']; ?></p>
															</div>
														</div>
														<?php
													}
												}
												?>
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
			</div>
		</div>
	</section>
<?php get_footer(); ?>