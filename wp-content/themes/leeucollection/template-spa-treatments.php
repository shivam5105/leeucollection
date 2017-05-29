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
						<div class="listing-box">
							<div class="scroll-anim" data-anim="fade-up">
								<?php
								if(is_array($post_meta['_crb_page_sub_heading']) && !empty($post_meta['_crb_page_sub_heading'][0]))
								{
									?>
									<div class="transformed_head">
										<h2 class="ucase"><?php echo $post_meta['_crb_page_sub_heading'][0];?></h2>
									</div>
									<?php
								}
								$services_sections = carbon_get_post_meta($post->ID, 'crb_services_sections', 'complex');
								foreach ($services_sections as $ss_key => $services_section)
								{
									$service_duration 	= $services_section['crb_service_duration'];
									$service_heading 	= $services_section['crb_service_heading'];
									?>
									<div class="service-wrapper clearfix">
										<div class="col-10 pd-0">
											<div class="transformed">
												<div class="summer_heading">
													<h3><?php echo $service_heading; ?></h3>
												</div>
											</div>
										</div>
										<div class="col-2">
											<div class="timing_func">
												<p><?php echo $service_duration; ?></p>
											</div>
										</div>
										<?php
										foreach ($services_section['crb_services'] as $s_key => $services)
										{
											?>
											<div class="col-10 pd-0">
												<div class="transformed">
													<div class="summer_paragaraph">
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
										?>
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
	</section>
<?php get_footer(); ?>