<?php
/*
Template Name: Career
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
						<div class="scroll-anim" data-anim="fade-up">
							<div class="content-part-section career-content" itemprop="description">
								<?php
								$args = array(
								    'post_type' => 'hotel',
								    'posts_per_page' => -1,
								    'orderby' =>'menu_order',
								    'order' => 'ASC',
								    'post_parent' => 0
								);
								$loop = new WP_Query( $args );
								while ( $loop->have_posts() )
								{
								    $loop->the_post();
								    $hotel_ID  = $loop->post->ID;
									$hotel_location = get_hotel_location_list($hotel_ID);

									$args = array(
										'post_type' => 'leeu-careers',
										'meta_query' => array(
									        array(
									            'key' => '_crb_career_hotel',
									            'value' => $hotel_ID,
									            'compare' => '='
									        )
										)
									);
									$career_loop = new WP_Query( $args );
									if($career_loop->have_posts())
									{
										?>
										<div class="locations-career-wrapper">
											<div class="contact-sub-head">
												<?php echo $loop->post->post_title; ?>
											</div>
											<div class="career-location"><?php echo $hotel_location; ?></div>
											<div class="detail-head-career">
												<div class="row">
													<div class="col-4 rm-pad">
														<div class="head-text-career">Location</div>
													</div>
													<div class="col-4 rm-pad">
														<div class="head-text-career">Position</div>
													</div>	
													<div class="col-4 rm-pad">
														<div class="head-text-career"></div>
													</div>
												</div>
											</div>
											<?php
											$location_career_loop = 0;
											while ($career_loop->have_posts())
											{
												$location_career_loop++;

												$career_loop->the_post();
												?>
												<div class="detail-content-career detail-content-career-<?php echo $location_career_loop; ?>"> 
													<div class="row"> 
														<div class="col-4 rm-pad"> 
															<div class="content-part">
																<?php echo $hotel_location; ?>
															</div>
														</div>
														<div class="col-4 rm-pad"> 
															<div class="content-part"> 
																<?php echo nl2br(carbon_get_post_meta($post->ID, "crb_career_position"));?>
															</div>
														</div>
														<div class="col-4 rm-pad"> 
															<div class="cstm-btn-wrapper contact-email carrer-spacer-left">
																<a href="<?php echo get_permalink($post->ID); ?>" class="cstm-btn arrow-btn text-center">Apply</a>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
											wp_reset_postdata();
											?>
										</div>
									    <?php
									}
								}
								wp_reset_postdata();
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>