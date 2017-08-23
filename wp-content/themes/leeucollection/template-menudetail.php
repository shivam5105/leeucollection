<?php
/*
Template Name: Menu Detail
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
							<!-- <div class="leeu-text ucase" itemprop="name">
								<?php echo $top_most_parent_post->post_title;?>
							</div> -->
							<?php
							if($post->post_parent > 0)
							{
								?>
								<h2 class="ucase"><?php echo get_the_title($post->post_parent); ?></h2>
								<?php
							}
							?>
							<h1 class="ucase" itemprop="name"><?php echo $page_heading; ?> Menu</h1>
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
						<div class="listing-box listing-row">
							<div class="scroll-anim" data-anim="fade-up" itemprop="description">
								<?php
								$menus = carbon_get_post_meta($post->ID, "crb_menus", 'complex');
								if(is_array($menus) && !empty($menus))
								{
									foreach ($menus as $menus_key => $menu)
									{
										?>
										<div class="cmn_all">
											<div class="transformed_head">
												<h2><?php echo $menu['crb_menu_heading'];?></h2>
											</div>
											<div class="service-wrapper clearfix">
												<?php
												foreach ($menu['crb_menu_item_details'] as $mi_key => $menu_item)
												{
													if(!empty($menu_item['crb_menu_item_name']) || !empty($menu_item['crb_menu_item_price'])){?>
													<div class="row mgb-32">
														<div class="col-10 pd-0">
															<div class="summer_paragaraph">
																<p><?php echo $menu_item['crb_menu_item_name']; ?></p>
																<?php if(!empty($menu_item['crb_menu_item_details'])){?>
																	<div class="menu-details">
																		<?php echo $menu_item['crb_menu_item_details']; ?>
																	</div>
																<?php } ?>
															</div>
														</div>
														<div class="col-2">
															<div class="timing_func">
																<p><?php echo $menu_item['crb_menu_item_price']; ?></p>
															</div>
														</div>
													</div>
													<?php
												 }
												}
												?>
											</div>
										</div>
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
	</section>
<?php get_footer(); ?>