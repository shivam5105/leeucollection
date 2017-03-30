		<br style="clear:both;">
		<footer>
			<div class="social-links">
				<?php
				$fb = carbon_get_theme_option("crb_facebook_link"); 
				$insta = carbon_get_theme_option("crb_instagram_link");
				$twt = carbon_get_theme_option("crb_twitter_link");
				?>
				<ul>
					<?php
					if($fb != "")
					{
						?>
						<li><a target="blank" href="<?php echo $fb; ?>">Facebook</a></li>
						<?php
					}
					if($twt != "")
					{
						?>
						<li><a target="blank" href="<?php echo $twt; ?>">Twitter</a></li>
						<?php
					}
					if($insta != "")
					{
						?>
						<li><a target="blank" href="<?php echo $insta; ?>">Instagram</a></li>
						<?php
					}?>
				</ul>
			</div>
			<div class="footer-menu-wrapper">
				<?php
				if(has_nav_menu('footer_menu_left'))
				{
					wp_nav_menu( array(
						'theme_location' => 'footer_menu_left',
						'menu_class'     => 'footer-menu-left',
					 ) );
				}
				if(has_nav_menu('footer_menu_right'))
				{
					wp_nav_menu( array(
						'theme_location' => 'footer_menu_right',
						'menu_class'     => 'footer-menu-right',
					 ) );
				}
				?>
			</div>
		</footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>
