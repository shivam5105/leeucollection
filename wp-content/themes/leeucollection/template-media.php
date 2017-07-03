<?php
/*
Template Name: Media & trades
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
							<div class="content-part-section career-content">
								<div class="row media-container">
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

										$args = array(
											'post_type' => 'leeu-media-trades',
											'meta_query' => array(
										        array(
										            'key' => '_crb_media_hotel',
										            'value' => $hotel_ID,
										            'compare' => '='
										        )
											)
										);
										$media_loop = new WP_Query( $args );
										if($media_loop->have_posts())
										{
											?>
												<?php
												while ($media_loop->have_posts())
												{
													$media_loop->the_post();
													$hotel_location = get_hotel_location_list($hotel_ID);
													$room_name = carbon_get_post_meta($post->ID,'crb_room_name');
													$shortcode = carbon_get_post_meta($post->ID,'crb_media_form_shortcode');
													?>
													<div class="col-6 rm-pad"> 
														<div class="content-part" itemprop="address">
															<?php the_post_thumbnail();?>
															<?php echo $hotel_location; ?>
															<p class="room-name"> <?php echo $room_name; ?></p>
														</div>
													</div>
													<?php
												}
												?>
											
										    <?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>