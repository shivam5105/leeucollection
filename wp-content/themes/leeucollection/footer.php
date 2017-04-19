
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
			new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'de,en,nl,pt,sv', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
			/*new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en-us,en-gb,nl-nl,de-de,en-za,de,nl,pt-br,sv-se,de-ch', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');*/
		}
	</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
