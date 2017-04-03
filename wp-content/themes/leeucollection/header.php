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
	<div itemscope itemtype="http://schema.org/Hotel">
		<header id="site-header" class="pos-fix animate-fixed-header" >
			<nav id="main-navigation" class="clearfix">
				<div class="container pos-rel">
					<div class="pull-left menu-left-wrap">
						<?php
						if(has_nav_menu('header_menu_left'))
						{
							/*wp_nav_menu( array(
								'theme_location' => 'header_menu_left',
								'menu_class'     => 'menu-left list-inline',
							    'walker' => new Crb_Main_Menu_Walker()
							 ) );*/
						}
						?>
					</div>
					<div class="logo-wrapper">
						<?php leeucollection_the_custom_logo(); ?>
					</div>
					<div class="pull-right menu-right-wrap">
						<?php
						if(has_nav_menu('header_menu_right'))
						{
							wp_nav_menu( array(
								'theme_location' => 'header_menu_right',
								'menu_class'     => 'menu-right list-inline',
							 ) );
						}
						?>
					</div>
				</div>
			</nav>
		</header>