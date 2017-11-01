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
	<div class="page-blocker">
		<div class="screen-center">
			<div class="logo-loader"><img src="<?php echo get_template_directory_uri(); ?>/images/ripple.gif" alt="Leeu Collection" border="0" /></div>
		</div>
	</div>
    <div class="cht-wthr">
      	<?php
		$hide_weather_on_templates_array = array('template-hotel-listing.php');
		if(!is_front_page() && !in_array($page_template_file, $hide_weather_on_templates_array))
		{
			$post_id 	= ($post) ? $post->ID : false;
			$hotel_id 	= get_hotel_id($post_id);
			if($hotel_id)
			{
				$top_most_parent_post = ($hotel_id == false) ? false : get_post($hotel_id);
				$hotel_location = "";
				if($top_most_parent_post)
				{
					$hotel_location = get_hotel_location_list($top_most_parent_post->ID);
				}
			}
			else
			{
				$hotel_location = get_hotel_location_list($post_id);
			}
			if(!empty($hotel_location))
			{
				$weather = new Display_Weather($hotel_location, "c");
				$weather->displayCurrentWeather();
			}
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
    <div class="contact-slide-form">
    		<a href="javascript:void(0);" class="close-contact">Close</a>
    		<h3 class="get-in-touch"> Get in touch </h3>
		 <?php echo do_shortcode('[contact-form-7 id="404" title="Contact Popup"]'); ?>
   	</div>
	<header id="site-header" class="pos-fix " >
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
				$logo_text_img_templates_array = array('template-hotel-listing.php','template-restaurantlisting.php');
				$has_logo_text_img = false;
				if(is_front_page() || in_array($page_template_file, $logo_text_img_templates_array))
				{
					//$has_logo_text_img = true;
				}
				?>
				<div class="logo-wrapper <?php if($has_logo_text_img){ /*echo "has_logo_text_img";*/ } ?>">
					<?php leeucollection_the_custom_logo(); ?>

					<a href="<?php echo home_url(); ?>" class="custom-logo-link2" rel="home" itemprop="url"><img src="<?php echo get_template_directory_uri(); ?>/images/LeeuLogo.svg" class="custom-logo2" alt="Leeu Collections" itemprop="logo"></a>

					<?php
					if($has_logo_text_img)
					{
						?>
						<a href="<?php echo home_url( '/' ); ?>" class="logo-text-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/Leeu-Collection-Text.svg" class="bottom-logo" alt="" /></a>
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
						    'walker' => new TV_Main_Menu_Walker()
						 ) );
					}
					?>
				</div>
			</div>
		</nav>
		<nav id="slide-menu">
			<div class="mobile-menu-wrapper">
				<?php
				if(has_nav_menu('slide_menu'))
				{
					/*wp_nav_menu( array(
						'theme_location' 	=> 'slide_menu',
						'mobile_menu'    	=> 'slide-menu-class',
					 ) );*/
					$menu_name 	= 'slide_menu';
					$locations 	= get_nav_menu_locations();
					$menu 		= wp_get_nav_menu_object( $locations[ $menu_name ] );
					$menuitems 	= wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
					$menus_arr 	= array();
					$all_menus_arr 	= array();

					foreach ( $menuitems as $item )
					{
						$menus_arr[$item->menu_item_parent][$item->ID] = $item;
						$all_menus_arr[$item->ID] = $item;
					}

					function get_menu_li($menu_id, $menu_arr)
					{
						$item = $menu_arr[$menu_id];
						if(!isset($menu_arr[$menu_id]))
						{
							return true;
						}
						$classes = empty( $item->classes ) ? array() : (array) $item->classes;
						$classes[] = 'menu-item-' . $item->ID.' menu-item menu-item-type-'.$item->type.' menu-item-object-'.$item->object." has-parent";

				        $prev_menu = "<span class='prev-menu'>Prev</span>";

						$args = (object)array(
									'before' => '',
									'after' => '',
									'link_before' => '',
									'link_after' => '',
								);
						$depth = 0;

						$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

						$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
						$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

						$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
						$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

						/** This filter is documented in wp-includes/post-template.php */
						$title = apply_filters( 'the_title', $item->title, $item->ID );

						$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

						$atts = array();
						$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
						$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
						$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
						$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
						$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

						$attributes = '';
						foreach ( $atts as $attr => $value )
						{
							if ( ! empty( $value ) )
							{
								$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
								$attributes .= ' ' . $attr . '="' . $value . '"';
							}
						}

				        $nav_menu_sub_heading = carbon_get_post_meta($item->ID, 'nav_menu_sub_heading');
				        $nav_menu_sub_heading_html = "";
				        if($nav_menu_sub_heading)
				        {
				        	$nav_menu_sub_heading_html = "<span class='parent-menu-sub-heading'>".$nav_menu_sub_heading."</span>";
				        }

						$item_output = $args->before;
						$item_output .= '<a'. $attributes .'>';
						$item_output .= $args->link_before.$nav_menu_sub_heading_html.$title.$args->link_after;
						$item_output .= '</a>';
						$item_output .= $args->after;
						?>
						<li prev-menu-id="<?php echo $menu_id; ?>" <?php echo $id . $class_names; ?>><?php echo $prev_menu.$item_output; ?></li>
						<?php
					}
					$prev_menu_item = false;
					foreach ($menus_arr as $menu_item_parent => $menu_arr)
					{
						?>
						<div class="tv-mobile-menu-wrapper menu-item-parent-<?php echo $menu_item_parent; ?>">
							<ul>
							<?php
							if($menu_item_parent > 0)
							{
								get_menu_li($menu_item_parent, $all_menus_arr);
							}
							$prev_menu_item = $menu_arr;
							foreach ($menu_arr as $key => $item)
							{
								$item = (object)$item;
								$classes = empty( $item->classes ) ? array() : (array) $item->classes;
								$classes[] = 'parent-menu-item-' . $item->ID.' parent-menu-item parent-menu-item-type-'.$item->type.' parent-menu-item-object-'.$item->object
								;

						        $next_menu = "";
						        if(isset($menus_arr[$item->ID]))
						        {
						        	$next_menu = "<span class='next-menu'>Next</span>";
						        }
						        if(!empty($next_menu))
						        {
						        	$classes[] = 'has-childern';
						        }

								$args = (object)array(
											'before' => '',
											'after' => '',
											'link_before' => '',
											'link_after' => '',
										);
								$depth = 0;

								$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

								$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
								$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

								$id = 'parent-menu-item-'. $item->ID;
								$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

								/** This filter is documented in wp-includes/post-template.php */
								$title = apply_filters( 'the_title', $item->title, $item->ID );

								$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

								$atts = array();
								$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
								$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
								$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
								$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
								$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

								$attributes = '';
								foreach ( $atts as $attr => $value )
								{
									if ( ! empty( $value ) )
									{
										$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
										$attributes .= ' ' . $attr . '="' . $value . '"';
									}
								}

						        $nav_menu_sub_heading = carbon_get_post_meta($item->ID, 'nav_menu_sub_heading');
						        $nav_menu_sub_heading_html = "";
						        if($nav_menu_sub_heading)
						        {
						        	$nav_menu_sub_heading_html = "<span class='menu-sub-heading'>".$nav_menu_sub_heading."</span>";
						        }

								$item_output = $args->before;
								$item_output .= '<a'. $attributes .'>';
								$item_output .= $args->link_before. $title.$nav_menu_sub_heading_html. $args->link_after;
								$item_output .= '</a>';
								$item_output .= $args->after;
								?>
								<li next-menu-id="<?php echo $item->ID; ?>" <?php echo $id . $class_names; ?>><?php echo $item_output.$next_menu; ?></li>
								<?php
							}
							?>
							</ul>
						</div>
						<?php
					}
				}
				?>
			</div>
			<div class="mobile-header-wrapper">
				<div class="tv-mean-container">
					<a href="javascript:void(0);" class="tv-meanmenu-reveal" style="left: 0px; right: auto; text-align: center; text-indent: 0px; font-size: 18px;"><span></span><span></span><span></span></a>
				</div>
				<div class="mobile-logo"> 
					<a href="<?php echo home_url(); ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/ipad-logo.svg" alt="">
					</a>
				</div>
				<a href="#" class="meanmenu-book pos-r popup-booking-button-anchor">BOOK</a>
			</div>
		</nav>
	</header>
	<?php
	$schema_itemtype = "http://schema.org/Organization";
	if(is_front_page())
	{
		$schema_itemtype = "http://schema.org/Organization";
	}
	else if(stripos($page_template_file, "restaurant") !== false)
	{
		$schema_itemtype = "http://schema.org/Restaurant";
	}
	else if(in_array($page_template_file, array("template-hotel.php")))
	{
		$schema_itemtype = "http://schema.org/Hotel";
	}
	
	if(in_array($page_template_file, array("template-hotel-restaurantlisting.php","template-spa-treatments.php")))
	{
		$schema_itemtype = "http://schema.org/Place";
	}
	if(in_array($page_template_file, array("template-hotel-wine.php")))
	{
		$schema_itemtype = "http://schema.org/Organization";
	}
	if(in_array($page_template_file, array("template-meetings-events.php")))
	{
		$schema_itemtype = "http://schema.org/MeetingRoom";
	}

	$schema_array = array();
	?>
	<div itemscope itemtype="<?php echo $schema_itemtype; ?>">
		<a href="<?php echo get_permalink($post->ID); ?>" style="display:none" itemprop="url"></a> <!-- used for schema only please do not remove it. -->
		