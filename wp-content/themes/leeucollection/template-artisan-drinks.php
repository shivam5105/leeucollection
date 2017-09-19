<?php
/*
Template Name:  Drinks
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
							<div class="leeu-text ucase" itemprop="name">
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
		            	<?php
		            	$propImage = false;
					    $artisan_drinks_contents = carbon_get_post_meta($post->ID, "crb_artisan_drinks_content", 'complex');
					    if(isset($_GET['d']) && $_GET['d'] == 1)
					    {
					    	?>
					    	<pre style="text-align:left;">
					    		<?php print_r($artisan_drinks_contents); ?>
					    	</pre>
					    	<?php
					    }
					    foreach ($artisan_drinks_contents as $adc_key => $artisan_drinks_content)
					    {
					    	$artisan_drink_image1 = @$artisan_drinks_content['crb_artisan_drink_image1'];
					    	$artisan_drink_image2 = @$artisan_drinks_content['crb_artisan_drink_image2'];
					    	$artisan_drink_image3 = @$artisan_drinks_content['crb_artisan_drink_image3'];

					    	$artisan_drinks_section_heading = @$artisan_drinks_content['crb_artisan_drinks_section_heading'];
					    	$artisan_drinks_section_link = @$artisan_drinks_content['crb_artisan_drinks_section_link'];
					    	$artisan_drinks_section_left_heading = @$artisan_drinks_content['crb_artisan_drinks_section_left_heading'];
					    	$artisan_drinks_section_right_heading = @$artisan_drinks_content['crb_artisan_drinks_section_right_heading'];
					    	$crb_artisan_drinks_section_description = @$artisan_drinks_content['crb_artisan_drinks_section_description'];
					    	$crb_artisan_drinks_section_left_description = @$artisan_drinks_content['crb_artisan_drinks_section_left_description'];
					    	$crb_artisan_drinks_section_right_description = @$artisan_drinks_content['crb_artisan_drinks_section_right_description'];

							$artisan_drink_image1 = wp_get_attachment_image_src( $artisan_drink_image1, '821x478' );
							$artisan_drink_image1 = $artisan_drink_image1[0];

							$artisan_drink_image2 = wp_get_attachment_image_src( $artisan_drink_image2, '411x258' );
							$artisan_drink_image2 = $artisan_drink_image2[0];

							$artisan_drink_image3 = wp_get_attachment_image_src( $artisan_drink_image3, '411x258' );
							$artisan_drink_image3 = $artisan_drink_image3[0];
			            	?>
			            	<div class="listing-row">
				            	<div class="no_slider rm_line_height">
				            		<?php
				            		if(!empty($artisan_drink_image1))
				            		{
					            		?>
										<div class="scroll-anim animate-custom" data-anim="fade-up">
											<img src="<?php echo $artisan_drink_image1; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?>>
											<?php
											if(!empty($artisan_drinks_section_link))
											{
												?>
												<a href="<?php echo $artisan_drinks_section_link; ?>" class="main-link" itemprop="url"></a>
												<?php
											}
											?>
										</div>
										<?php
									}
									if(!empty($artisan_drink_image2) || !empty($artisan_drink_image3) || !empty($artisan_drinks_section_left_heading) || !empty($artisan_drinks_section_right_heading) || !empty($crb_artisan_drinks_section_left_description) || !empty($crb_artisan_drinks_section_right_description))
									{
										?>
										<div class="row space-top half-layouts">
											<?php
											if(!empty($artisan_drink_image2))
											{
												?>
												<div class="col-6 rm-pad">
													<div class="scroll-anim animate-custom" data-anim="fade-up">
														<img src="<?php echo $artisan_drink_image2; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?>>
														<?php
														if(!empty($artisan_drinks_section_link))
														{
															?>
															<a href="<?php echo $artisan_drinks_section_link; ?>" class="main-link" itemprop="url"></a>
															<?php
														}
														?>
														<div class="left-content">
															<div class="desc-heading">
																<?php echo $artisan_drinks_section_left_heading; ?>
															</div>
															<div class="desc-content">
																<?php echo $crb_artisan_drinks_section_left_description; ?>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
											if(!empty($artisan_drink_image3))
											{
												?>
												<div class="col-6 rm-pad">
													<div class="scroll-anim animate-custom" data-anim="fade-up" data-anim-delay="100">
														<img src="<?php echo $artisan_drink_image3; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?>>
														<div class="right-content">
															<div class="desc-heading">
																<?php echo $artisan_drinks_section_right_heading; ?>
															</div>
															<div class="desc-content">
																<?php echo $crb_artisan_drinks_section_right_description; ?>
															</div>
														</div>
													</div>
												</div>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>
								</div>
								<div class="row detail-row">
									<div class="col-3">
										<div class="desc-heading"><?php echo $artisan_drinks_section_heading; ?></div>
									</div>
									<div class="col-9">
										<div class="desc-content">
											<?php echo $crb_artisan_drinks_section_description; ?>
										</div>
									</div>
								</div>
							</div>
			            	<?php
				        }

					    $artisan_drinks_contents2 = carbon_get_post_meta($post->ID, "crb_artisan_drinks_bottom_content", 'complex');
					    foreach ($artisan_drinks_contents2 as $adc_key => $artisan_drinks_content2)
					    {
					    	$artisan_drink_image1 = @$artisan_drinks_content2['crb_artisan_drink_image1'];

					    	$artisan_drinks_section_heading = @$artisan_drinks_content2['crb_artisan_drinks_section_heading'];
					    	$artisan_drinks_section_link = @$artisan_drinks_content2['crb_artisan_drinks_section_link'];
					    	$crb_artisan_drinks_section_description = @$artisan_drinks_content2['crb_artisan_drinks_section_description'];

							$artisan_drink_image1 = wp_get_attachment_image_src( $artisan_drink_image1, '821x478' );
			            	?>
			            	<div class="listing-row">
				            	<div class="no_slider rm_line_height">
					            	<div class="text-center scroll-anim animate-custom" data-anim="fade-up">
										<h2 class="ucase small_heading"><?php echo $artisan_drinks_section_heading; ?></h2>
									</div>
									<div class="wine-section-description col-12 col-centered" itemprop="description"><?php echo $crb_artisan_drinks_section_description; ?></div>
				            		<?php
				            		if(!empty($artisan_drink_image1))
				            		{
					            		?>
										<div class="scroll-anim animate-custom" data-anim="fade-up">
											<img src="<?php echo $artisan_drink_image1[0]; ?>" alt="" <?php if(!$propImage){ echo 'itemprop="image"'; $propImage = true; } ?>>
											<?php
											if(!empty($artisan_drinks_section_link))
											{
												?>
												<a href="<?php echo $artisan_drinks_section_link; ?>" class="main-link" itemprop="url"></a>
												<?php
											}
											?>
										</div>
										<?php
									}
									?>
								</div>
							</div>
			            	<?php
				        }
				        ?>
			        </div>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>