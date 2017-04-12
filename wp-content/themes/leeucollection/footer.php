
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
								<li><a target="blank" href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.svg" alt=""></a></li>
								<?php
							}
							if($twt != "")
							{
								?>
								<li><a target="blank" href="<?php echo $twt; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.svg" alt=""></a></li>
								<?php
							}
							if($insta != "")
							{
								?>
								<li><a target="blank" href="<?php echo $insta; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/instagram.svg" alt=""></a></li>
								<?php
							}?>
						</ul>
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
</body>
</html>
