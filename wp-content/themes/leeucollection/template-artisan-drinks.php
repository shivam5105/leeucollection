<?php
/*
Template Name: Artisan Drinks
*/
get_header(); 
?>

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
						<div class="leeu-text ucase" itemprop="legalName">
							<?php
							$page_small_heading = @$post_meta['_crb_page_small_heading'][0];
							if(!empty($page_small_heading))
							{
								echo $page_small_heading;
							}
							else
							{
								if($top_most_parent_post)
								{
									echo $top_most_parent_post->post_title;
								}
							}
							?>
						</div>
						<h1 class="ucase" itemprop="name"><?php echo $page_heading; ?></h1>
					</div>
				</div>
			</div>
		</div>		
	</div>
	<div class="container"> 
		<div class="col-12 rm-pad artisan-drink-listing-contain"> 
			<div class="row listing-row"> 
				<div class="col-2">
	             	<div class="side-nav-contain">
		                <div class="scroll-anim animate-custom" data-anim="fade-up">
		                   <div class="side-nav-wrap">
		                      <ul class="side-nav">
		                         <li><a href="#">GEOMETRIC GIN</a></li>
		                         <li><a href="#">TUK TUK BEER</a></li>
		                      </ul>
		                   </div>
		                </div>
	            	</div>
	            </div>
	            <div class="col-8">
	            	<div class="no_slider rm_line_height">
						<div class="scroll-anim animate-custom" data-anim="fade-up"><img src="http://54.191.201.248/leeucollection/wp-content/uploads/2017/03/first-room.jpg" alt=""></div>
						<div class="row"> 
							<div class="col-6 rm-pad"> 
								<img src="http://54.191.201.248/leeucollection/wp-content/uploads/2017/03/the-estate-thumb-410x258.jpg" alt="">
							</div>
							<div class="col-6 rm-pad">
								<img src="http://54.191.201.248/leeucollection/wp-content/uploads/2017/03/the-estate-thumb-410x258.jpg" alt="">
							</div>
						</div>
					</div>
					<div class="row detail-row">
						<div class="col-3">
							<div class="desc-heading">Executive Suites</div>
						</div>
						<div class="col-9">
							<div class="desc-content"> 
								The individually styled bedrooms feature superbly comfortable beds with high quality linen, and are fitted with sisal carpets, and curtains and upholstery in natural linens, contributing to the relaxed yet sophisticated feel.
							</div>
						</div>
					</div>					
	            </div>				
			</div>
		</div>
	</div>

	
</section>

<?php get_footer(); ?>