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
								<div class="contact-sub-head">
									LEEU ESTATES	
								</div>
								<div class="detail-head-career">
									<div class="row">
										<div class="col-3 rm-pad">
											<div class="head-text-career">Location</div>
										</div>
										<div class="col-6 rm-pad">
											<div class="head-text-career">Position</div>
										</div>	
										<div class="col-3 rm-pad">
											<div class="head-text-career"></div>
										</div>																					
									</div>
								</div>
								<div class="detail-content-career"> 
									<div class="row"> 
										<div class="col-3 rm-pad"> 
											<div class="content-part"> 
												Franschhoek, SA
											</div>
										</div>
										<div class="col-6 rm-pad"> 
											<div class="content-part"> 
												Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed  <br> 
												do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.
											</div>
										</div>
										<div class="col-3 rm-pad"> 
										<div class="cstm-btn-wrapper contact-email carrer-spacer-left">
											<a href="javascript:void(0)" class="cstm-btn arrow-btn text-center">Apply</a>
										</div>
										</div>																				
									</div>
								</div>
								<div class="detail-content-career"> 
									<div class="row"> 
										<div class="col-3 rm-pad"> 
											<div class="content-part"> 
												Franschhoek, SA
											</div>
										</div>
										<div class="col-6 rm-pad"> 
											<div class="content-part"> 
												Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed  <br> 
												do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.
											</div>
										</div>
										<div class="col-3 rm-pad"> 
										<div class="cstm-btn-wrapper contact-email carrer-spacer-left">
											<a href="javascript:void(0)" class="cstm-btn arrow-btn text-center">Apply</a>
										</div>
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