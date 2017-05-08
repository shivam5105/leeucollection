						<div class="col-3 <?php echo $nav_space; ?>">
							<div class="sliding-detail-wrapper">
								<?php 
								$loop = 0;
								foreach($slider_content['crb_section_detail'] as $slide_key => $slide) 
								{
									//print_r($slide);
									$page_section_description = $slide['crb_page_description'];
									$page_section_logo 		= $slide['crb_page_logo'];
									$page_section_name 		= $slide['crb_page_name'];
									$more_button_link		= $slide['crb_more_button_link'];
									$more_button_text		= $slide['crb_more_button_text'];
									$booking_button_link 	= $slide['crb_booking_button_link'];
									$booking_button_text 	= $slide['crb_booking_button_text'];	
									$active_slide = "";
									if($loop == 0)
									{
										$active_slide = "active-detail-slide";
									}
									$page_section_logo_url = wp_get_attachment_image_src( $page_section_logo, 'original' );
									$page_section_logo_url = $page_section_logo_url[0];													
								?> 
								<div class="sliding-detail <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>">
									<div class="inner-detail-content">
										<?php
										if(!empty($page_section_logo_url))
										{
											?>
											<div class="detail-logo">
												<img src="<?php echo $page_section_logo_url; ?>" alt="">
											</div>
											<?php
										}?>
										<div class="content-part-heading"> 
											<?php echo $slide['crb_page_name']; ?>
										</div>
										<div class="content-part">
											<?php echo nl2br($page_section_description); ?>
										</div>
										<ul class="list-inline linking-wrap">
											<?php
											if(!empty($more_button_link) && !empty($more_button_text))
											{
												?>
												<li class="see-more-link"><a href="<?php echo $more_button_link; ?>"><?php echo $more_button_text; ?></a></li>
												<?php
											}
											if(!empty($booking_button_link) && !empty($booking_button_text))
											{
												?>
												<li class="book-link"><a href="<?php echo $booking_button_link; ?>"><?php echo $booking_button_text; ?></a></li>
												<?php
											}?>
										</ul>
									</div>
								</div>
								<?php 
								$loop++;
								} ?>
							</div>	
							<?php if($has_slider == true) { ?>
							<div class="main-nav-slider">
								<?php
								$loop = 0;
								foreach ($slider_content['crb_section_detail'] as $slide_key => $slide)
								{
									$hotel_name = $slide['crb_page_name'];	
									$active_slide = "";
									if($loop == 0)
									{
										$active_slide = "active-main-pagination";
									}
									?>
								<div class="gotoslide <?php echo $active_slide; ?>" data-object="<?php echo $loop; ?>"><?php echo $hotel_name; ?></div>	
								<?php																	
									$loop++;	
								}
								?>
							</div>
							<?php } ?>						
						</div>