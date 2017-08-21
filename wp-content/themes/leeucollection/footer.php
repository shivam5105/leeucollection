		<?php
			//date_default_timezone_set("Africa/Franschhoek");
			//echo "The time in " . date_default_timezone_get() . " is " . date("H:i:s");

			?>
		<div class="clearfix"></div>
		<footer id="footer" class="scroll-anim" data-anim="fade">
			<div class="container">
				<div class="row mail-social-box">
				   <div class="col-6">
						<div class="footer-head"> 
						 CONNECT WITH US
						</div>
						<ul class="list-inline social-links">
							<?php
							$fb = carbon_get_theme_option("crb_facebook_link"); 
							$insta = carbon_get_theme_option("crb_instagram_link");
							$twt = carbon_get_theme_option("crb_twitter_link");

							if($fb != "")
							{
								?>
								<li class="facebook-icon"><a target="blank" href="<?php echo $fb; ?>"><?php include('facebook-svg.php'); ?></a></li>
								<?php
							}
							if($twt != "")
							{
								?>
								<li class="twitter-icon"><a target="blank" href="<?php echo $twt; ?>"><?php include('twitter-svg.php'); ?></a></li>
								<?php
							}
							if($insta != "")
							{
								?>
								<li class="instagram-icon"><a target="blank" href="<?php echo $insta; ?>"><?php include('instagram-svg.php'); ?></a></li>
								<?php
							}?>
							<?php
							if(!empty($post))
							{
								$trip_advisor = carbon_get_post_meta($post->ID, "crb_trip_advisor_code");
								if(!empty($trip_advisor))
								{
									?>
									<li class="trip-advisor-logo-wrapper">
										<?php echo $trip_advisor; ?>
									</li>
									<?php
								}
							}
							?>
						</ul>
						<div id="google_translate_element"></div>
					</div>
				   <div class="col-6">
				      <div class="footer-head">SIGN UP TO LEARN ABOUT SPECIAL EVENTS AND OFFERS</div>
				      <div class="newsleter-form">
				         <div class="form-inline">
				            <form id="mc-form">
				               <div class="form-group form-input-wrap"> 
				                  <input id="mc-email" type="email" name="email" placeholder="Enter your email here" required="required">
				               </div>
				               <div class="form-group">
				                  <button type="submit" class="submit-btn ucase">sign up</button>
				               </div>
				               <label for="mc-email"></label>
				            </form>
				         </div>
				      </div>
				   </div>
				</div>
				<div class="row footer-menu-row ">
				   <div class="row">
				   	  <div class="col-6 pull-right">
						<?php
						if(has_nav_menu('footer_menu_right'))
						{
							wp_nav_menu( array(
								'theme_location' => 'footer_menu_right',
								'menu_class'     => 'list-inline pull-right',
							 ) );
						}
						?>
				      </div>
				      <div class="col-6">
						<?php
						if(has_nav_menu('footer_menu_left'))
						{
							wp_nav_menu( array(
								'theme_location' => 'footer_menu_left',
								'menu_class'     => 'list-inline',
							 ) );
						}
						?>
				      </div>
				   </div>
				</div>
			</div>
		</footer>
	</div> <!-- schema.org/Hotel div closed -->
	<?php wp_footer(); ?>
	<!-- popup -->
	<div class="main_sec">
		<div class="rel_wrap">
			<div class="leeu_logo"><?php leeucollection_the_custom_logo(); ?></div>
			<div class="close_popup extext">CLOSE</div>
		</div>
		<div class="popup_wrapper">
			<div class="event_disc">
				<div class="mobile-only current-tab-name">BOOK A ROOM</div>
				<div class="hotel_dtls extext">
					<ul>
						<li data-rel="content1" class="add_hover special">BOOK A ROOM</li>
						<li data-rel="content2">BOOK A TABLE</li>
						<li data-rel="content3">EVENT REQUEST</li>
					</ul>
				</div>
			</div>
			<div class="content-container">
				<!-- book a room category -->	
				<div class="one" id="content1" style="display:block;">
					<div class="pops_on">
						<div class="all_cat pd-l-r">
							<form action="https://gc.synxis.com/rez.aspx" method="get" id="book_room_form_popup">
								<input type="hidden" name="locale" value="en-GB" />
								<!-- <input type="hidden" name="start" value="searchres" /> --> <!-- Options: availresults, searchres -->
								<input type="hidden" name="arrive" value="<?php echo date('d/m/Y', time()); ?>" />
								<input type="hidden" name="nights" value="1" />
								<input type="hidden" name="Chain" value="" />
								<div class="choose_hotel">
									<div class="at extext pdb-20">AT</div>
									<select class="lyon_font mgb-30" name="Hotel">
										<option value="">Select a hotel</option>
										<?php
										$args = array(
											'posts_per_page' => '-1',
											'orderby' => 'menu_order',
											'order' => 'ASC',
											'post_type' => 'hotel',
											'post_parent' => '0',
										);

										$hotel_post_array = get_posts($args);
										if(!empty($hotel_post_array))
										{
											foreach ($hotel_post_array as $key => $hotel_post)
											{
												$hotel_name 	= $hotel_post->post_title;
												$crb_hotel_id 	= carbon_get_post_meta($hotel_post->ID, "crb_hotel_id");
												$crb_chain_id 	= carbon_get_post_meta($hotel_post->ID, "crb_chain_id");
												
												if(!empty($crb_hotel_id))
												{
													?>
													<option value="<?php echo $crb_hotel_id; ?>" data-chain-id="<?php echo $crb_chain_id; ?>"><?php echo $hotel_name; ?></option>
													<?php
												}
											}
										}
										?>
									</select>
								</div>
								<div class="choose_date mgb-30">
									<div class="at extext pdb-20">ARRIVAL / DEPARTURE</div>
									<input class="rangePicker lyon_font" type="text">
								</div>
								<div class="room_guest">
									<div class="roomselect">
										<div class="extext pdb-20">ROOMS</div>
										<select class="lyon_font mgb-30" name="rooms">
											<?php
											for ($i = 1; $i <= 20; $i++)
											{
												?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?> room<?php if($i > 1){ echo "s"; } ?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="roomselect mgl-18">
										<div class="extext pdb-20">GUESTS</div>
										<select class="lyon_font mgb-30" name="adult">
											<?php
											for ($i = 1; $i <= 20; $i++)
											{
												?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?> guest<?php if($i > 1){ echo "s"; } ?></option>
												<?php
											}
											?>
										</select>
									</div>
								</div>
								<div class="verif_code">
									<div class="promo_grcode lyon_font">
										<div class="extext pdb-20">PROMO CODE</div>
										<input type="text" name="Promo" placeholder="Enter code(optional)" class="lyon_font">
									</div>
									<div class="promo_grcode lyon_font mgl-18">
										<div class="extext pdb-20">GROUP CODE</div>
										<input type="text" name="Group" placeholder="Enter code(optional)" class="lyon_font">
									</div>
								</div>
								<div class="avaibility">
									<div class="form-item rm-pad text-center rm-mar-left">
										<button type="submit" class="submit-btn ucase width-200 white-color">CHECK AVAILABILITY</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- end book a room category -->	
				<!-- book a table category -->
				<div class="one" id="content2">
					<div class="pops_on">
						<div class="all_cat pd-l-r">
							<div class="booktable">
								<div class="rest_cat extext pdb-20">SELECT THE RESTAURANT</div>
								<?php
								$args = array(
									'posts_per_page' => '-1',
									'orderby' => 'menu_order',
									'order' => 'ASC',
									'post_type' => 'leeu-restaurants',
									'post_parent' => '50',
								);
								$the_query = new WP_Query( $args );
								$loop = 0;
								if($the_query->have_posts())
								{
									while($the_query->have_posts())
									{
										$loop++;
										$the_query->the_post();
										$hotel_name = get_the_title();
										$restaurant_location_popup = carbon_get_post_meta($post->ID, "crb_restaurant_location_popup");
										$booking_buton_link = carbon_get_post_meta($post->ID, "crb_booking_buton_link");
										$checked = "";
										if($loop == 1)
										{
											$checked = "checked='checked'";
										}
										if(!empty($booking_buton_link))
										{
											?>
											<div class="choose_rest lyon_font mgb-15"> 
												<input type="radio" id="radio-res-<?php echo $loop; ?>" data-button-wrapper-id="book_table_button_<?php echo $loop; ?>" name="radio-res" class="regular-radio popup-book-table-radio" <?php echo $checked; ?> />
												<label for="radio-res-<?php echo $loop; ?>"><span></span><?php echo $hotel_name; ?></label>
												<label for="radio-res-<?php echo $loop; ?>"><span></span><span class="extext"><?php echo $restaurant_location_popup; ?></span></label>
											</div>
											<?php
										}
									}
								}
								$loop = 0;
								if($the_query->have_posts())
								{
									while($the_query->have_posts())
									{
										$loop++;
										$the_query->the_post();
										$hotel_name = get_the_title();
										$booking_buton_link = carbon_get_post_meta($post->ID, "crb_booking_buton_link");
										$hide = "style='display: none;'";
										if($loop == 1)
										{
											$hide = "";
										}
										if(!empty($booking_buton_link))
										{
											?>
											<div class="book_table book_table_button_wrapper" id="book_table_button_<?php echo $loop; ?>" <?php echo $hide; ?>>
												<a href="#" id="booktable-popup-<?php echo $loop; ?>" class="booktable" data-connection-id="<?php echo $booking_buton_link; ?>">BOOK A TABLE </a>
											</div>
											<?php
										}
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<!-- end book a table category -->
				<!-- event request category -->
				<div class="one" id="content3">
					<div class="pops_on">
						<div class="all_cat pd-l-r">
							<div class="choose_hotel">
								<div class="at extext pdb-20">AT</div>
								<select class="lyon_font mgb-30" name="request-event-hotel-dd" id="request-event-hotel-dd">
									<option>Select a hotel</option>
									<?php
									if(!empty($hotel_post_array))
									{
										foreach ($hotel_post_array as $key => $hotel_post)
										{
											$hotel_name 	= $hotel_post->post_title;
											?>
											<option value="<?php echo $hotel_name; ?>"><?php echo $hotel_name; ?></option>
											<?php
										}
									}
									?>
								</select>
							</div>
							<?php echo do_shortcode('[contact-form-7 id="406" title="Event Request"]'); ?>
						</div>
					</div>
				</div>
				<!-- end event request category -->
			</div>
		</div>
	</div>
	<script type="text/javascript" data-no-instant>
		function googleTranslateElementInit()
		{
			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'de,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
			
			/*new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'de,af,en,nl,pt,sv', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');*/

			/*new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en-us,en-gb,nl-nl,de-de,en-za,de,nl,pt-br,sv-se,de-ch', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');*/
		}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>