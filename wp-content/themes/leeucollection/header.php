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
<?php
$page_template_file = basename(get_page_template());
?>
<body <?php body_class(); ?>>
	<div itemscope itemtype="http://schema.org/Hotel">
	    <div class="cht-wthr">
	      	<?php
			$hide_weather_on_templates_array = array('template-hotel-listing.php');
			if(!is_front_page() && !in_array($page_template_file, $hide_weather_on_templates_array))
			{
				$post_id 	= $post->ID;
				$hotel_id 	= get_hotel_id($post_id);
				if($hotel_id)
				{
					$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);
					$hotel_location = get_hotel_location_list($top_most_parent_post->ID);
				}
				else
				{
					$hotel_location = get_hotel_location_list($post_id);
				}

				$weather = new Display_Weather($hotel_location, "c");
				$weather->displayCurrentWeather();
			}
	      	?>
			<div class="chat-wrapper"> 
				<a href="http://54.191.201.248/leeucollection/contact-us/"></a>
				<div id="wave" class="chat-icon-wrap">
				    <span class="dot"></span>
				    <span class="dot"></span>
				    <span class="dot"></span>
				</div>
				<span class="text-cht-wthr">chat</span>
			</div>
	    </div>

		<header id="site-header" class="pos-fix animate-fixed-header" >
			<nav id="main-navigation" class="clearfix">
				<div class="container pos-rel">
					<div class="pull-left menu-left-wrap">
						<?php
						if(has_nav_menu('header_menu_left'))
						{
							wp_nav_menu( array(
								'theme_location' => 'header_menu_left',
								'menu_class'     => 'menu-left list-inline',
							    'walker' => new TV_Main_Menu_Walker()
							) );
						}
						?>
					</div>
					<?php
					$logo_text_img_templates_array = array('template-hotel-listing.php');
					$has_logo_text_img = false;
					if(is_front_page() || in_array($page_template_file, $logo_text_img_templates_array))
					{
						$has_logo_text_img = true;
					}
					?>
					<div class="logo-wrapper <?php if($has_logo_text_img){ echo "has_logo_text_img"; } ?>">
						<?php leeucollection_the_custom_logo(); ?>
						<?php
						if($has_logo_text_img)
						{
							?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/home-leeu-collection-text.png" class="bottom-logo" alt="" />
							<?php
						}
						?>
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
			<nav id="slide-menu"> 
				<?php
				if(has_nav_menu('slide_menu'))
				{
					wp_nav_menu( array(
						'theme_location' => 'slide_menu',
						'mobile_menu'     => 'slide-menu-class',
					 ) );
				}
				?>	
				<div class="mobile-logo"> 
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/ipad-logo.svg" alt="">
					</a>
				</div>
				<a href="#" class="meanmenu-book pos-r">BOOK</a>			
			</nav>
		</header>
		