<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Leeu_Collection
 * @since Leeu Collection 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<!-- <header id="site-header" class="pos-fix header-load">
		<nav id="main-navigation" class="clearfix">
			<div class="container pos-rel">
				<div class="pull-left menu-left-wrap">
					<ul class="menu-left list-inline">
						<li><a href="#">hotels</a>
						<div class="sub-menu-wrapper">
							<ul class="sub-menu">
								<li><a href="#">FRANSCHHOEK, SOUTH AFRICA</a>
									<ul class="sub-menu">
										<li><a href="#"><img src="img/submenu.jpg" alt=""><span>LEEU ESTATES</span></a></li>
										<li><a href="#"><img src="img/submenu.jpg" alt=""><span>LE QUARTIER FRANCAIS</span></a></li>
										<li><a href="#"><img src="img/submenu.jpg" alt=""><span>LEEU HOUSE</span></a></li>
									</ul>
								</li>
							</ul>
							<ul class="sub-menu">
								<li><a href="#">LAKE WINDERMERE, UK</a>
									<ul class="sub-menu">
										<li><a href="#"><img src="img/submenu-uk.jpg" alt=""><span>LEEU ESTATES</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
						</li>
						<li><a href="#">restaurants &amp; bars</a></li>
						<li><a href="#">wine</a></li>
						<li><a href="#">location</a></li>
					</ul>
				</div>
				<div class="logo-wrapper" itemscope="" itemtype="http://schema.org/Hotel">
					<img itemprop="logo" src="img/logo.png" alt="hotel logo">
				</div>
			    <div class="pull-right menu-right-wrap">
				<ul class="menu-right list-inline">
					<li><a href="#">the leeu story</a></li>
					<li><a href="#">gift cards</a></li>
					<li><a href="#">books</a></li>
				</ul>
				</div>
			</div>
		</nav>
	</header> -->

	<div class="header-menu-logo-wrapper">
		<?php
		if(has_nav_menu('header_menu_left'))
		{
			wp_nav_menu( array(
				'theme_location' => 'header_menu_left',
				'menu_class'     => 'header-menu-left',
			    /*'walker' => new Crb_Main_Menu_Walker()*/
			 ) );
		}
		?>
		<div itemscope itemtype="http://schema.org/Organization">
			<?php leeucollection_the_custom_logo(); ?>
		</div>
		<?php
		if(has_nav_menu('header_menu_right'))
		{
			wp_nav_menu( array(
				'theme_location' => 'header_menu_right',
				'menu_class'     => 'header-menu-right',
			 ) );
		}
		?>
	</div>

