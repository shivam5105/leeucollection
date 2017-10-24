<?php
/*
Template Name: Restaurant
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
												<?php if(!empty($banner_url)){?>
													<div class="slide-item">
														<div class="banner-img scroll-anim" data-anim="fade-up">
															<img src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
														</div>
													</div>
												<?php
											   }
											}
										}
										else
										{
											/*$banner_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
											$banner_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '821x478' );
											$banner_url = $banner_url[0];
											?>
											<?php if(!empty($banner_url)){?>
												<div class="slide-item">
													<div class="banner-img scroll-anim" data-anim="fade-up">
														<img src="<?php echo $banner_url; ?>" alt="" itemprop="image" />
													</div>
												</div>
											<?php
										}
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
								<?php if(!empty($post_meta['_crb_slider_bottom_description'][0])){?>
								<div class="row detail-row">
									<div class="col-9">
										<?php if(!empty($post_meta['_crb_slider_bottom_description'][0])){?>
										<div class="desc-content" itemprop="description"> 
											<?php echo nl2br(@$post_meta['_crb_slider_bottom_description'][0]); ?>
										</div>
										<?php } ?>
									</div>
									<div class="col-3">
										<?php
										if(is_array($post_meta['_crb_booking_buton_text']) && !empty($post_meta['_crb_booking_buton_link'][0]))
										{
											?>
											<div class="cstm-btn-wrapper pull-right text-center">
												<a href="javascript:void(0)" data-connection-id="<?php echo $post_meta['_crb_booking_buton_link'][0]; ?>" id="booktable-1" class="booktable cstm-btn arrow-btn" target="_blank"><?php echo $post_meta['_crb_booking_buton_text'][0]; ?></a>
											</div>
											<?php
										}?>
									</div>
								</div>
								<?php } ?>
								<div class="row detail-row hotel-info-row">
									<div class="col-6">
										<?php
										$hours_reservations = carbon_get_post_meta($post->ID, "crb_hours_reservations", 'complex');
										if(is_array($hours_reservations) && count($hours_reservations) > 0)
										{
											?>
											<div class="leeu-text">OPENING HOURS</div>
											<?php
										}
										foreach ($hours_reservations as $hr_key => $hours_reservation)
										{
											if(!empty($hours_reservation['crb_reservation_for']) || !empty($hours_reservation['crb_reservation_time'])){
											?>
											<div class="hotel-food-info" itemprop="openingHours">
												<?php if(!empty($hours_reservation['crb_reservation_for'])){ ?>
													<div class="food-head">
														<?php echo $hours_reservation['crb_reservation_for']; ?>:
													</div>
												<?php }?>
												<?php if(!empty($hours_reservation['crb_reservation_time'])){ ?>
													<div class="foo-desc">
														<?php echo nl2br($hours_reservation['crb_reservation_time']); ?>
													</div>
												<?php }?>
											</div>
											<?php
										}
										}
										?>
									</div>
									<div class="col-6">
										<?php
										if(is_array($post_meta['_crb_policy']) && !empty($post_meta['_crb_policy'][0]))
										{
											?>
											<div class="leeu-text">Policy</div>
											<div class="hotel-info-desc"> 
												<?php echo nl2br($post_meta['_crb_policy'][0]); ?>
											</div>
											<?php
										}
										?>
									</div>
								</div>																
							</div>
							<div class="hotel-menu">
								<?php
								$menu_types_terms = get_terms(array(
									'taxonomy' => 'menu-types',
									'orderby' => 'name',
									'order' => 'DESC',
									));

								$prev_menu_type_id = 0;
								$loop = 0;

								foreach($menu_types_terms as $menu_type)
								{
								    wp_reset_query();
								    $args = array(
										'orderby' => 'orderby',
										'order' => 'ASC',
										'post_parent' => $post_id,
										'post_status' => 'publish',
										/*'post_type' => 'hotel',*/
								        'tax_query' => array(
								            array(
								                'taxonomy' => 'menu-types',
								                'field' => 'term_id',
								                'terms' => $menu_type->term_id,
								            ),
								        ),
									);

									$the_query = new WP_Query($args);
									if($the_query->have_posts())
									{
										$cols = 2;
										$X = 0;
								        while($the_query->have_posts())
										{
											$loop++;
											if($loop == 1)
											{
												?>
												<div class="text-center">
													<div class="menu-head">MENU</div>
												</div>
												<?php
											}
											$X++;
											$the_query->the_post();
											$child_post 	= $post;
											$child_post_id 	= $child_post->ID;

											$image_col_class 	= "two-img-col";
											$item_col_class 	= "col-6";
											$data_anim_delay 	= "";
											if($prev_menu_type_id != 0)
											{
												$cols = 3;
												$image_col_class 	= "three-img-col";
												$item_col_class 	= "col-4";
												
												$child_post_img_url = wp_get_attachment_image_src(get_post_thumbnail_id($child_post_id),'275x173');
												$child_post_img_url = $child_post_img_url[0];
											}
											else
											{
												$child_post_img_url = wp_get_attachment_image_src(get_post_thumbnail_id($child_post_id),'411x258');
												$child_post_img_url = $child_post_img_url[0];
											}
											if($X == 1)
											{
												?>
												<div class="listing-row clearfix full_img">
													<div class="<?php echo $image_col_class; ?>">
												<?php
											}
											else
											{
												$data_anim_delay = "data-anim-delay='".(100*($X-1))."'";
											}
											?>
											<div class="<?php echo $item_col_class; ?> rm-pad">
												<div class="link-wrapper-box">
													<a class="main-link" href="<?php echo get_permalink($child_post_id); ?>" itemprop="menu"></a>
													<div class="banner-img scroll-anim" data-anim="fade-up" <?php echo $data_anim_delay; ?>>
														<img src="<?php echo $child_post_img_url; ?>" alt="" />
													</div>
													<div class="img-desc"><?php echo $child_post->post_title; ?></div>
												</div>
											</div>
											<?php
											if($X == $cols)
											{
													?>
													</div>
												</div>
												<?php
												$X = 0;
											}
								        }
								        wp_reset_postdata();
								    }
								    $prev_menu_type_id = $menu_type->term_id;
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