
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
								<li><a target="blank" href="<?php echo $fb; ?>"><?php include('facebook-svg.php'); ?></a></li>
								<?php
							}
							if($twt != "")
							{
								?>
								<li><a target="blank" href="<?php echo $twt; ?>"><?php include('twitter-svg.php'); ?></a></li>
								<?php
							}
							if($insta != "")
							{
								?>
								<li><a target="blank" href="<?php echo $insta; ?>"><?php include('instagram-svg.php'); ?></a></li>
								<?php
							}?>
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
				      <div class="col-6">
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
				   </div>
				</div>
			</div>
		</footer>
	</div>
	<?php wp_footer(); ?>
	<!-- popup -->
	<div class="main_sec">
		<div class="rel_wrap">
			<div class="leeu_logo"> <img src="img/small-logo.png" alt="" /></div>
			<div class="close_popup extext">CLOSE</div>
		</div>
		<div class="popup_wrapper">
			<div class="event_disc">
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
							<div class="choose_hotel">
								<div class="at extext pdb-20">AT</div>
								<select class="lyon_font mgb-30">
									<option>Select a hotel</option>
									<option>hotel 1</option>
									<option>hotel 2</option>
									<option>hotel 3</option>
									<option>hotel 4</option>
									<option>hotel 5</option>
									<option>hotel 6</option>
								</select>
							</div>
							<div class="choose_date mgb-30">
								<div class="at extext pdb-20">ARRIVAL / DEPRATURE</div>
								<input class="rangePicker lyon_font" type="text">
							</div>
							<div class="room_guest">
								<div class="roomselect">
									<div class="extext pdb-20">ROOMS</div>
									<select class="lyon_font mgb-30">
										<option>1 room</option>
										<option>2 room</option>
										<option>3 room</option>
										<option>4 room</option>
										<option>5 room</option>
										<option>6 room</option>
										<option>7 room</option>
									</select>
								</div>
								<div class="roomselect mgl-18">
									<div class="extext pdb-20">GUESTS</div>
									<select class="lyon_font mgb-30">
										<option>2 guests</option>
										<option>3 guests</option>
										<option>4 guests</option>
										<option>5 guests</option>
										<option>6 guests</option>
										<option>7 guests</option>
										<option>8 guests</option>
									</select>
								</div>
							</div>
							<div class="verif_code">
								<div class="promo_grcode lyon_font">
									<div class="extext pdb-20">PROMO CODE</div>
									<input type="text" name="fname" placeholder="Enter code(optional)" class="lyon_font">
								</div>
								<div class="promo_grcode lyon_font mgl-18">
									<div class="extext pdb-20">GROUP CODE</div>
									<input type="text" name="fname" placeholder="Enter code(optional)" class="lyon_font">
								</div>
							</div>
							<div class="avaibility"> 
								<a href="#">CHECK AVAILABILITY</a>
							</div>
						</div>
					</div>
				</div>
				<!-- end book a room category -->	
				<!-- book a table category -->
				<div class="one" id="content2">
					<div class="pops_on">
						<div class="all_cat pd-l-r">
							<div class="booktable">
								<div class="rest_cat extext pdb-20"> SELECT THE RESTAURANT</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-1" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-1"> <span> </span> The Dining Room </label>
									<label for="radio-2-1"> <span> </span>	<span class="extext"> AT LEEU ESTATES </span> </label>	 					  
								</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-2" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-2"><span> </span> The conservatory </label>
									<label for="radio-2-2"> <span> </span>  <span class="extext"> AT LEEU HOUSE </span> </label>							  
								</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-3" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-3"> <span> </span> The Garden Room </label>
									<label for="radio-2-3"> <span> </span>  <span class="extext"> AT LEEU HOUSE </span> </label>							  
								</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-4" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-4"> <span> </span> The Bar </label>
									<label for="radio-2-4"> <span> </span>	<span class="extext"> AT LQF </span>		 </label>					  
								</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-5" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-5"> <span> </span>Marigold</label>
									<label for="radio-2-5"> <span> </span>	<span class="extext"> AUTHENTIC INDIAN </span>	</label>						  
								</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-6" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-6"> <span> </span> Tuk Tuk </label>
									<label for="radio-2-6"> <span> </span> <span class="extext"> MICROBREWERY  & TAQUERIA  </span>	 </label>	 					  
								</div>
								<div class="choose_rest lyon_font mgb-15"> 
									<input type="radio" id="radio-2-7" name="radio-2-set" class="regular-radio" />
									<label for="radio-2-7"> <span> </span>Linthwaite House Room</label>
								</div>
								<div class="book_table"> 
									<a href="#">BOOK A TABLE </a>
								</div>
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
								<select class="lyon_font mgb-30">
									<option>Select a hotel</option>
									<option>hotel 1</option>
									<option>hotel 2</option>
									<option>hotel 3</option>
									<option>hotel 4</option>
									<option>hotel 5</option>
									<option>hotel 6</option>
								</select>
							</div>
							<div class="choose_date mgb-30">
								<div class="at extext pdb-20">ARRIVAL / DEPRATURE</div>
								<input class="rangePicker lyon_font" type="text">
							</div>
							<div class="number_of_people mgb-30">
								<div class="at extext pdb-20">NUMBER OF PEOPLE</div>
								<input type="number" name="quantity" class="lyon_font" placeholder="1room">
							</div>
							<div class="info_msg">
								<div class="at extext pdb-20">MESSAGE</div>
								<textarea class="lyon_font" name="Text" value=""></textarea>
							</div>
							<div class="book_table"> 
								<a href="#">SEND MESSAGE </a>
							</div>
						</div>
					</div>
				</div>
				<!-- end event request category -->
			</div>
		</div>
	</div>
	<style type="text/css">
		#google_translate_element
		{
			margin-top: 30px;
		}
		.goog-te-gadget-simple
		{
    		background: #ebe7e2 !important;
		}
	</style>
	<script type="text/javascript">
		function googleTranslateElementInit()
		{
			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'de,af,en,nl,pt,sv', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
			/*new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en-us,en-gb,nl-nl,de-de,en-za,de,nl,pt-br,sv-se,de-ch', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');*/
		}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
