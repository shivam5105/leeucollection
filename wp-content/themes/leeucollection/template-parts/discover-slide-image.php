						
						<div class="col-9 <?php echo $image_space; ?>">
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
									$loop = 0;
									foreach ($slider_content['crb_section_detail'] as $slide_key => $slide)
									{
										$page_section_image = $slide['crb_page_image'];

										$active_slide = "";
										if($loop == 0)
										{
											$active_slide = "active-detail-slide";
										}
										$page_section_image_url = wp_get_attachment_image_src( $page_section_image, '925x600' );
										$page_section_image_url = $page_section_image_url[0];
										if(!empty($page_section_image_url))
										{
											?>
											<div class="slider-item" data-object="<?php echo $loop; ?>">
												<img src="<?php echo $page_section_image_url; ?>" alt="">
											</div>
											<?php
										}
										$loop++;

									}
									?>
								</div>
								<?php
								if($has_slider == true)
								{
									?>
									<div class="prev"></div>
									<?php
								}?>
							</div>
						</div>	