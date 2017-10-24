<?php
/*
Template Name: Hotel's Restaurant Listing
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
				<div class="row listing-row hotel-restautant">
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
							$args = array(
								'post_type' => 'hotel',
								'numberposts' => -1,
								'orderby' => 'order',
								'order' => 'ASC',
								'post_status' => 'publish',
								'post_parent' => $post_id,
							);
							$child_post_array = get_posts($args);
							if(!empty($child_post_array) && count($child_post_array) > 0)
							{
								$logic_loop = 0;
								$loop = 0;

								foreach($child_post_array as $child_key => $child_post)
								{
									$loop++;
									if((count($child_post_array)%3) != 0 && $loop == count($child_post_array))
									{
										$logic_loop = 0;
									}
									$logic_loop++;
									$child_post_id = $child_post->ID;
									$child_post_img_url = wp_get_attachment_image_src(get_post_thumbnail_id($child_post_id),'821x478');

									$child_post_img_url = $child_post_img_url[0];

									$child_post_meta = ( $child_post ) ? get_post_meta( $child_post_id ) : null;
									$data_anim_delay = "";
									if($logic_loop <= 2)
									{
										?>
										<div class="listing-row clearfix">
										<?php
									}
									if($logic_loop == 1)
									{
										?>
										<div class="scroll-anim" data-anim="fade-up">
										<?php
									}
									else if($logic_loop == 2)
									{
										?>
										<div class="two-img-col">
										<?php
									}
									else if($logic_loop == 3)
									{
										$data_anim_delay = "data-anim-delay='100'";
									}
									if($logic_loop > 1)
									{
										?>
										<div class="col-6 rm-pad">
										<?php
									}
									?>
									<div itemscope itemtype="http://schema.org/Restaurant">
										<div class="banner-img scroll-anim" data-anim="fade-up" <?php echo $data_anim_delay; ?>>
											<img src="<?php echo $child_post_img_url; ?>" alt="" itemprop="image" />
											<a href="<?php echo get_permalink($child_post_id); ?>" class="main-link" itemprop="url"></a>
											<div class="inner-detail-wrapper">
												<div class="inner-detail">
													<div class="row">
														<div class="col-11 col-centered">
															<div class="inner-detail-content">
																<div class="content-part" itemprop="description">
																	<?php echo nl2br(@$child_post_meta['_crb_short_description'][0]); ?>
																</div>
																<ul class="list-inline linking-wrap">
																	<li class="see-more-link"><a href="<?php echo get_permalink($child_post_id); ?>">SEE MORE</a></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="img-desc" itemprop="name"><?php echo $child_post->post_title; ?></div>
									</div>
									<?php
									if($logic_loop > 1)
									{
										?>
										</div><!-- col-6 ends -->
										<?php
									}
									if($logic_loop == 1)
									{
										?>
										</div><!-- scroll-anim ends -->
										<?php
									}
									if($logic_loop == 1 || $logic_loop == 3)
									{
										?>
										</div><!-- listing-row ends -->
										<?php
									}
									if($logic_loop == 3)
									{
										$logic_loop = 0;
										?>
										</div><!-- two-img-col ends -->
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
	</section>
<?php get_footer(); ?>