<?php
get_header(); ?>
	<?php
	$post_id 	= $post->ID;
	$hotel_id 	= get_hotel_id($post_id);
    $post_meta 	= ( $post ) ? get_post_meta( $post->ID ) : null;

	$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);

	$page_heading = (@$post_meta['_crb_page_heading'][0]) ? $post_meta['_crb_page_heading'][0] : "Careers";
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
							<div class="content-part-section career-content">
								<?php
								while ( have_posts() )
								{
									the_post();
									$hotel_ID 		= carbon_get_post_meta($post->ID, "crb_career_hotel");
									$hotel_location = get_hotel_location_list($hotel_ID);
									$hotel_name 	= get_the_title($hotel_ID);
									$career_form_shortcode = carbon_get_post_meta($post->ID, "crb_career_form_shortcode");
									?>
									<div class="contact-sub-head career-main-heading"><?php echo $hotel_name; ?></div>
									<div class="h1 ucase"><?php echo get_the_title(); ?></div>
									<div class="head-text-career"><?php echo $hotel_name." ".$hotel_location; ?></div>
									<div class="career-description"><?php the_content(); ?></div>
									<div class="career-form">
										<?php
										if(!empty($career_form_shortcode))
										{
											echo do_shortcode($career_form_shortcode);
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