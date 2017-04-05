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
		<div class="container">
			<div class="leeu-heading-wrap scroll-anim" data-anim="fade-up">
				<div class="row">
					<div class="col-2 rm-pad"></div>
					<div class="col-8 rm-pad">
						<div class="text-center">
							<div class="leeu-text ucase" itemprop="legalName"><?php echo $top_most_parent_post->post_title;?></div>
							<h1 class="ucase" itemprop="name"><?php echo $page_heading; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="col-12 rm-pad room-listing-contain">
				<div class="row listing-row">
					<div class="col-2">
						<div class="side-nav-contain">
							<div class="scroll-anim" data-anim="fade-up">
								<div class="side-nav-wrap">
									<?php
									include_once("leeu_sidebar.php")
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="scroll-anim" data-anim="fade-up">
						<div class="col-8">
							<?php
							$has_slider = false;
					    	$slider_data = carbon_get_post_meta($post->ID, "crb_slider_images", 'complex');
							if(is_array($slider_data) && !empty($slider_data) && count($slider_data) > 1)
							{
								$has_slider = true;
							}
							?>
							<div class="listing-box listing-row">
								<div class="single_slider_wrapper">
									<?php
									if($has_slider == true)
									{
										?>
										<div class="mht_homebanner next-wrapper">
											<div class="next"></div>
										</div>
										<?php
									}?>
									<div class="owl-carousel single_slider owl-theme">
										<?php
										if(is_array($slider_data) && !empty($slider_data))
										{
											foreach ($slider_data as $slide_key => $slide_data)
											{
												$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '1240x600' );
												$banner_url = $banner_url[0];
												?>
												<div class="slide-item">
													<div class="banner-img mht_homebanner scroll-anim" data-anim="fade-up" style="background-image:url('<?php echo $banner_url; ?>');">
													</div>
												</div>
												<?php
											}
										}
										else
										{
											/*$banner_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
											$banner_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '1240x600' );
											$banner_url = $banner_url[0];
											?>
											<div class="slide-item">
												<div class="banner-img mht_homebanner scroll-anim" data-anim="fade-up" style="background-image:url('<?php echo $banner_url; ?>');">
												</div>
											</div>
											<?php
										}?>
									</div>
									<?php
									if($has_slider == true)
									{
										?>
										<div class="mht_homebanner prev-wrapper">
											<div class="prev"></div>
										</div>
										<?php
									}?>
									<div class="row detail-row">
										<div class="col-9">
											<div class="desc-content"> 
												<?php echo @$post_meta['_crb_slider_bottom_description'][0]; ?>
											</div>
										</div>
										<div class="col-3">
											<?php
											if(is_array($post_meta['_crb_booking_buton_link']) && !empty($post_meta['_crb_booking_buton_link'][0]))
											{
												?>
												<div class="cstm-btn-wrapper pull-right text-center">
													<a href="<?php echo $post_meta['_crb_booking_buton_link'][0]; ?>" class="cstm-btn arrow-btn" target="_blank"><?php echo $post_meta['_crb_booking_buton_text'][0]; ?></a>
												</div>
												<?php
											}?>
										</div>
									</div>
											<div class="row detail-row hotel-info-row">
												<div class="col-6">
													<div class="leeu-text">HOURS & RESERVATIONS</div>
													<?php
													$hours_reservations = carbon_get_post_meta($post->ID, "crb_hours_reservations", 'complex');

													foreach ($hours_reservations as $hr_key => $hours_reservation)
													{
														?>														
														<div class="hotel-food-info">
															<div class="food-head">
																<?php echo $hours_reservation['crb_reservation_for']; ?>:
															</div>
															<div class="foo-desc">
																<?php echo nl2br($hours_reservation['crb_reservation_time']); ?>
															</div>
														</div>
														<?php
													}
													?>
												</div>
												<div class="col-6">
													<div class="leeu-text">Policy</div>
													<div class="hotel-info-desc"> 
														<?php echo $post_meta['_crb_policy'][0]; ?>
													</div>
												</div>
											</div>
								</div>
							</div>
							<div class="hotel-menu">
								<div class="text-center">
									<div class="menu-head">MENU</div>
								</div>
								<div class="listing-row clearfix">
									<div class="two-img-col">
										<div class="col-6 rm-pad">
											<div class="banner-img  scroll-anim" data-anim="fade-up" style="background-image:url('img/breakfast-dn.jpg');">   
											</div>
											<div class="img-desc">Breakfast</div>
										</div>
										<div class="col-6 rm-pad">
											<div class="banner-img scroll-anim" data-anim="fade-up" data-anim-delay="100" style="background-image:url('img/lunch-dn.jpg');">                                                    
											</div>
											<div class="img-desc">Lunch</div>
										</div>
									</div>
								</div>
								<div class="listing-row clearfix">
									<div class="two-img-col">
										<div class="col-6 rm-pad">
											<div class="banner-img  scroll-anim" data-anim="fade-up" style="background-image:url('img/dinner-dn.jpg');">   
											</div>
											<div class="img-desc">dinner</div>
										</div>
										<div class="col-6 rm-pad">
											<div class="banner-img scroll-anim" data-anim="fade-up" data-anim-delay="100" style="background-image:url('img/dinner-ap.jpg');">                                                    
											</div>
											<div class="img-desc">APPETISERS</div>
										</div>
									</div>
								</div>
								<div class="listing-row clearfix">
									<div class="three-img-col">
										<div class="col-4 rm-pad">
											<div class="banner-img  scroll-anim" data-anim="fade-up" style="background-image:url('img/art-tea.jpg');">   
											</div>
											<div class="img-desc">AFTERNOON TEA</div>
										</div>
										<div class="col-4 rm-pad">
											<div class="banner-img scroll-anim" data-anim="fade-up" data-anim-delay="100" style="background-image:url('img/dn-cocktail.jpg');">                                                    
											</div>
											<div class="img-desc">COCKTAILS</div>
										</div>
										<div class="col-4 rm-pad">
											<div class="banner-img scroll-anim" data-anim="fade-up" data-anim-delay="200" style="background-image:url('img/dn-wine.jpg');">                                                    
											</div>
											<div class="img-desc">WINE</div>
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