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
	<section id="site-main" class="clearfix">
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
								<div class="row media-container">
									<?php
									$args = array(
									    'post_type' => 'leeu-media-trades',
									    'posts_per_page' => -1,
									    'orderby' =>'menu_order',
									    'order' => 'ASC',
									    'post_parent' => 0
									);
									?>
									<?php $loop = new WP_Query( $args );
									 if ( $loop->have_posts() ) : 
										 while ( $loop->have_posts() ) : $loop->the_post(); 
											$hotel_name = carbon_get_post_meta($post->ID,'crb_media_hotel');
											$room_name = carbon_get_post_meta($post->ID,'crb_room_name');
											$first_dpi = carbon_get_post_meta($post->ID,'crb_first_dpi');
											$second_dpi = carbon_get_post_meta($post->ID,'crb_second_dpi');
										?>	
											<div class="col-6 rm-pad"> 
												<div class="content-part">
													<?php the_post_thumbnail('411x258');?>
													<div class="content-box media-box clearfix">
														<div class="media-content-left">
															<span class="hotel-name"><?php echo $hotel_name; ?></span>
															<span class="room-name"> <?php echo $room_name; ?></span>
														</div>
														<div class="media-content-right">
															<a href="javascript:void(0);" class="media-request">Request</a>
														</div>
														 <div class="radio-buttons">
														 	<div class="res-text">Resolution</div>
															<?php if(!empty($first_dpi)){?><label><span class="radio-dpi"><input type="radio" name="dpi-img" value="<?php echo $first_dpi; ?>" class="72-dpi"/></span> <span>72 DPI @ 1200 px</span></label><?php }?>
															<?php if(!empty($second_dpi)){?><label><span class="radio-dpi"><input type="radio" name="dpi-img" value="<?php echo $second_dpi; ?>" class="300-dpi"/></span><span> 300 DPI</span></label>
															<?php }?>
														</div>
													</div>
												</div>
											</div>
										<?php wp_reset_postdata(); 
									  endwhile;	
									endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="media-popup">
			<div class="rel_wrap">	
				<div class="leeu_logo"><a href="<?php echo site_url(); ?>" ><img src="<?php echo get_template_directory_uri();?>/images/main-logo-top.svg" alt="Leeucollection" class="custom-logo"></a></div>
				<div class="close_popup extext">Close</div>
			</div>
			<div class="media-popup-content">
				<div class="popup-heading">Request Form</div>
				<div class="header-text">REQUESTED IMAGE LINK WILL BE EMAILED TO</div>
				<?php dynamic_sidebar( 'request-form' ); ?>
			</div>
		</div>
	</section>
<?php get_footer(); ?>