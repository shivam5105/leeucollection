<?php
/**
 * Leeu Collection functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Leeu_Collection
 * @since Leeu Collection 1.0
 */

/**
 * Leeu Collection only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'leeucollection_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own leeucollection_setup() function to override in a child theme.
 *
 * @since Leeu Collection 1.0
 */
function leeucollection_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/leeucollection
	 * If you're building a theme based on Leeu Collection, use a find and replace
	 * to change 'leeucollection' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'leeucollection' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Leeu Collection 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      	=> 180,
		'width'       	=> 150,
		'flex-height' 	=> true,
		'flex-width' 	=> true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'header_menu_left' => __( 'Header Menu - Left', 'leeucollection' ),
		'header_menu_right' => __( 'Header Menu - Right', 'leeucollection' ),
		'footer_menu_left' => __( 'Footer Menu - Left', 'leeucollection' ),
		'footer_menu_right' => __( 'Footer Menu - Right', 'leeucollection' ),
		'slide_menu' => __( 'Slide Menu', 'leeucollection' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', leeucollection_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_image_size( '1240x600', 1240, 600, true );
	add_image_size( '925x600', 925, 600, true );
	add_image_size( '621x386', 621, 386, true );
	add_image_size( '821x478', 821, 478, true );
	add_image_size( '500x334', 500, 334, true );
	add_image_size( '411x258', 411, 258, true );
	add_image_size( '275x173', 275, 173, true );
	add_image_size( '190x120', 190, 120, true );
	add_image_size( '193x129', 193, 129, true );
}
endif; // leeucollection_setup
add_action( 'after_setup_theme', 'leeucollection_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Leeu Collection 1.0
 */
function leeucollection_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'leeucollection_content_width', 840 );
}
add_action( 'after_setup_theme', 'leeucollection_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Leeu Collection 1.0
 */
function leeucollection_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'leeucollection' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'leeucollection' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Request form', 'leeucollection' ),
		'id'            => 'request-form',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'leeucollection' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title hidden">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'leeucollection_widgets_init' );

if ( ! function_exists( 'leeucollection_fonts_url' ) ) :
/**
 * Register Google fonts for Leeu Collection.
 *
 * Create your own leeucollection_fonts_url() function to override in a child theme.
 *
 * @since Leeu Collection 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function leeucollection_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'leeucollection' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'leeucollection' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'leeucollection' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Leeu Collection 1.0
 */
function leeucollection_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'leeucollection_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Leeu Collection 1.0
 */
function leeucollection_scripts() {
	// Add custom fonts, used in the main stylesheet.
	//wp_enqueue_style( 'leeucollection-google-fonts', leeucollection_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'leeucollection-fonts', get_template_directory_uri() . '/fonts/stylesheet.css' );
	wp_enqueue_style( 'jquery-datepick-css', get_template_directory_uri() . '/css/jquery.datepick.css' );
	wp_enqueue_style( 'leeucollection-owl-css', get_template_directory_uri() . '/css/owl.carousel.min.css' );
	wp_enqueue_style( 'leeucollection-meanmenu-css', get_template_directory_uri() . '/css/meanmenu.min.css' );
	wp_enqueue_style( 'leeucollection-daterangepicker-css', get_template_directory_uri() . '/css/daterangepicker.css' );
	// Theme stylesheet.
	wp_enqueue_style( 'leeucollection-style', get_stylesheet_uri() );

	// Responsive stylesheet.
	wp_enqueue_style( 'leeucollection-responsive-css', get_template_directory_uri() . '/css/media.css' );

	// Load the html5 shiv.
	wp_enqueue_script( 'leeucollection-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'leeucollection-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'leeucollection-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '20160816', true );
	wp_enqueue_script( 'leeucollection-meanmenu-js', get_template_directory_uri() . '/js/jquery.meanmenu.min.js', array( 'jquery' ), '20160816', true );
	
	wp_enqueue_script( 'leeucollection-ajaxchimp', get_template_directory_uri() . '/js/jquery.ajaxchimp.min.js');
	wp_enqueue_script( 'jquery-datepick-plugin', get_template_directory_uri() . '/js/jquery.plugin.js');
	wp_enqueue_script( 'jquery-moment', get_template_directory_uri() . '/js/moment.js');
	wp_enqueue_script( 'jquery-daterangepicker', get_template_directory_uri() . '/js/daterangepicker.js');
	wp_enqueue_script( 'jquery-instafeed', get_template_directory_uri() . '/js/instafeed.min.js');
	wp_enqueue_script( 'bookatable-js', '//bda.bookatable.com/deploy/lbui.direct.js');
	//wp_enqueue_script( 'leeucollection-mobile-js', get_template_directory_uri() . '/js/jquery-mobile.js');
	wp_enqueue_script( 'leeucollection-custom', get_template_directory_uri() . '/js/custom.js');
}
add_action( 'wp_enqueue_scripts', 'leeucollection_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Leeu Collection 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function leeucollection_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'leeucollection_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Leeu Collection 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function leeucollection_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/yahoo-weather.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Leeu Collection 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function leeucollection_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'leeucollection_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Leeu Collection 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function leeucollection_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'leeucollection_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Leeu Collection 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function leeucollection_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'leeucollection_widget_tag_cloud_args' );

require get_template_directory() . '/inc/multi-level-custom-posts.php';
require(__DIR__ . '/library/carbon-fields/carbon-fields-plugin.php');
add_action('carbon_register_fields', 'crb_register_custom_fields');
function crb_register_custom_fields() {
    include_once(dirname(__FILE__) . '/inc/post-meta.php');
}

/***************/
add_action( 'admin_menu', 'remove_menu_pages' );

function remove_menu_pages() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('edit.php');
}
/**************/
add_action('admin_head', 'custom_css_for_admin_only');

function custom_css_for_admin_only()
{
	?>
	<style type="text/css">
		.level-1
		{
		    background: rgba(142, 169, 187, 0.26) !important;
		}
		.level-2
		{
		    background: rgba(132, 190, 48, 0.26) !important;
		}
		.level-3
		{
		    background: rgba(142, 142, 187, 0.26) !important;
		}
		.level-3
		{
		    background: rgba(175, 142, 187, 0.26) !important;
		}
		.level-4
		{
		    background: rgba(233, 255, 155, 0.37) !important;
		}
		.level-5
		{
		    background: rgba(106, 104, 111, 0.27) !important;
		}
		.level-6
		{
		    background: rgba(255, 217, 166, 0.27) !important;
		}
		.level-7
		{
		    background: rgba(91, 197, 217, 0.27) !important;
		}
		.level-8
		{
		    background: rgba(187, 157, 142, 0.26) !important;
		}
		.level-9
		{
		    background: rgba(187, 187, 142, 0.26) !important;
		}
		.level-10
		{
		    background: rgba(156, 187, 142, 0.26) !important;
		}
		.level-1 th,
		.level-1 td:nth-child(2)
		{
			padding-left: 25px !important;
		}
		.level-2 th,
		.level-2 td:nth-child(2)
		{
			padding-left: 50px !important;
		}
		.level-3 th,
		.level-3 td:nth-child(2)
		{
			padding-left: 75px !important;
		}
		.level-4 th,
		.level-4 td:nth-child(2)
		{
			padding-left: 100px !important;
		}
		.level-5 th,
		.level-5 td:nth-child(2)
		{
			padding-left: 125px !important;
		}
		.level-6 th,
		.level-6 td:nth-child(2)
		{
			padding-left: 150px !important;
		}
		.level-7 th,
		.level-7 td:nth-child(2)
		{
			padding-left: 175px !important;
		}
		.level-8 th,
		.level-8 td:nth-child(2)
		{
			padding-left: 200px !important;
		}
		.level-9 th,
		.level-9 td:nth-child(2)
		{
			padding-left: 225px !important;
		}
		.level-10 th,
		.level-10 td:nth-child(2)
		{
			padding-left: 250px !important;
		}
		.post-type-hotel .level-0 th,
		.post-type-hotel .level-0 td
		{
		    border-top: 10px solid #e1e1e1 !important;
		}
		.level-0:first-child th,
		.level-0:first-child td
		{
		    border-top: 0 !important;
		}
		.post-type-page [class*="level-"] th,
		.post-type-page [class*="level-"] td
		{
		    border-top: 0 !important;
		}
	</style>
	<?php
}

add_action('admin_head', 'custom_visibility_of_admin_fields');

function custom_visibility_of_admin_fields()
{
    ?>  
    <script type="text/javascript">
        var $ = jQuery.noConflict();
        var tv_hacks = {
        	remove_locations : function(){
                $("#hotel-locationsdiv").hide();
                $("#hotel-locationsdiv [type='checkbox']").removeAttr("checked").attr("checked", false);
        	},
        	remove_menu_types : function(){
                $("#menu-typesdiv").hide();
                $("#menu-typesdiv [type='checkbox']").removeAttr("checked").attr("checked", false);
        	},
        };
        $(document).ready(function(){
            var $select = $('select#page_template');

            $select.on('change', function(event) {
                var template = $(this).val();
                if(template == "template-hotel.php")
                {
                    $("#hotel-locationsdiv").show();
                    tv_hacks.remove_menu_types();
                    
                }
                else if(template == "template-menudetail.php")
                {
                    $("#menu-typesdiv").show();
                    tv_hacks.remove_locations();
                }
                else
                {
                    tv_hacks.remove_locations();
                    tv_hacks.remove_menu_types();
                }
            });
        });
    </script>
    <?php
}

/* Updated Duplicate function from wp-includes/category-template.php */
function tv_wp_list_categories($args = '')
{
	$defaults = array(
		'child_of' => 0,
		'current_category' => 0,
		'depth' => 0,
		'echo' => 1,
		'exclude' => '',
		'exclude_tree' => '',
		'feed' => '',
		'feed_image' => '',
		'feed_type' => '',
		'hide_empty' => 1,
		'hide_title_if_empty' => false,
		'hierarchical' => true,
		'order' => 'ASC',
		'orderby' => 'name',
		'separator' => '<br />',
		'show_count' => 0,
		'show_option_all' => '',
		'show_option_none' => __('No categories') ,
		'style' => 'list',
		'taxonomy' => 'category',
		'title_li' => __('Categories') ,
		'use_desc_for_title' => 1,
		'no_anchor' => false,
		'hide_last_separator' => false,
		'reverse_order' => false,
	);
	$r = wp_parse_args($args, $defaults);
	if (!isset($r['pad_counts']) && $r['show_count'] && $r['hierarchical']) $r['pad_counts'] = true;

	if (true == $r['hierarchical'])
	{
		$exclude_tree = array();
		if ($r['exclude_tree'])
		{
			$exclude_tree = array_merge($exclude_tree, wp_parse_id_list($r['exclude_tree']));
		}

		if ($r['exclude'])
		{
			$exclude_tree = array_merge($exclude_tree, wp_parse_id_list($r['exclude']));
		}

		$r['exclude_tree'] = $exclude_tree;
		$r['exclude'] = '';
	}

	if (!isset($r['class'])) $r['class'] = ('category' == $r['taxonomy']) ? 'categories' : $r['taxonomy'];
	if (!taxonomy_exists($r['taxonomy']))
	{
		return false;
	}

	$show_option_all = $r['show_option_all'];
	$show_option_none = $r['show_option_none'];
	$categories = get_categories($r);
	$output = '';
	if ($r['title_li'] && 'list' == $r['style'] && (!empty($categories) || !$r['hide_title_if_empty']))
	{
		$output = '<li class="' . esc_attr($r['class']) . '">' . $r['title_li'] . '<ul>';
	}

	if (empty($categories))
	{
		if (!empty($show_option_none))
		{
			if ('list' == $r['style'])
			{
				$output.= '<li class="cat-item-none">' . $show_option_none . '</li>';
			}
			else
			{
				$output.= $show_option_none;
			}
		}
	}
	else
	{
		if (!empty($show_option_all))
		{
			$posts_page = '';

			// For taxonomies that belong only to custom post types, point to a valid archive.

			$taxonomy_object = get_taxonomy($r['taxonomy']);
			if (!in_array('post', $taxonomy_object->object_type) && !in_array('page', $taxonomy_object->object_type))
			{
				foreach($taxonomy_object->object_type as $object_type)
				{
					$_object_type = get_post_type_object($object_type);

					// Grab the first one.

					if (!empty($_object_type->has_archive))
					{
						$posts_page = get_post_type_archive_link($object_type);
						break;
					}
				}
			}

			// Fallback for the 'All' link is the posts page.

			if (!$posts_page)
			{
				if ('page' == get_option('show_on_front') && get_option('page_for_posts'))
				{
					$posts_page = get_permalink(get_option('page_for_posts'));
				}
				else
				{
					$posts_page = home_url('/');
				}
			}

			$posts_page = esc_url($posts_page);
			if ('list' == $r['style'])
			{
				if ($r['no_anchor'] == true)
				{
					$output.= "<li class='cat-item-all'>$show_option_all</li>";
				}
				else
				{
					$output.= "<li class='cat-item-all'><a href='$posts_page'>$show_option_all</a></li>";
				}
			}
			else
			{
				if ($r['no_anchor'] == true)
				{
					if($r['reverse_order'] == true)
					{
						$output = $show_option_all.$output;
					}
					else
					{
						$output.= $show_option_all;
					}
				}
				else
				{
					if($r['reverse_order'] == true)
					{
						$output = "<a href='$posts_page'>$show_option_all</a>".$output;
					}
					else
					{
						$output.= "<a href='$posts_page'>$show_option_all</a>";
					}
				}
			}
		}

		if (empty($r['current_category']) && (is_category() || is_tax() || is_tag()))
		{
			$current_term_object = get_queried_object();
			if ($current_term_object && $r['taxonomy'] === $current_term_object->taxonomy)
			{
				$r['current_category'] = get_queried_object_id();
			}
		}

		if ($r['hierarchical'])
		{
			$depth = $r['depth'];
		}
		else
		{
			$depth = - 1; // Flat.
		}

		$output.= tv_walk_category_tree($categories, $depth, $r);
	}

	if ($r['title_li'] && 'list' == $r['style'] && (!empty($categories) || !$r['hide_title_if_empty']))
	{
		$output.= '</ul></li>';
	}

	/**
	 * Filters the HTML output of a taxonomy list.
	 *
	 * @since 2.1.0
	 *
	 * @param string $output HTML output.
	 * @param array  $args   An array of taxonomy-listing arguments.
	 */
	$html = apply_filters('wp_list_categories', $output, $args);
	if ($r['echo'])
	{
		echo $html;
	}
	else
	{
		return $html;
	}
}

function tv_walk_category_tree()
{
	$args = func_get_args();
	if (empty($args[2]['walker']) || !($args[2]['walker'] instanceof Walker))
	{
		$walker = new TV_Walker_Category;
	}
	else
	{
		$walker = $args[2]['walker'];
	}

	return call_user_func_array(array(
		$walker,
		'walk'
	) , $args);
}
class TV_Walker_Category extends Walker_Category
{
	public function start_el(&$output, $category, $depth = 0, $args = array() , $id = 0)
	{
		/** This filter is documented in wp-includes/category-template.php */
		$cat_name = apply_filters('list_cats', esc_attr($category->name) , $category);

		// Don't generate an element if the category name is empty.

		$link = "";
		if (!$cat_name)
		{
			return;
		}
		if ($args['no_anchor'] == true)
		{
			if($args['reverse_order'] == true)
			{
				$link = $cat_name.$link;
			}
			else
			{
				$link.= $cat_name;
			}
		}
		else
		{
			$link .= '<a href="' . esc_url(get_term_link($category)) . '" ';
			if ($args['use_desc_for_title'] && !empty($category->description))
			{
				/**
				 * Filters the category description for display.
				 *
				 * @since 1.2.0
				 *
				 * @param string $description Category description.
				 * @param object $category    Category object.
				 */
				$link.= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
			}

			$link.= '>';
			$link.= $cat_name;
			$link.= '</a>';
		}
		if (!empty($args['feed_image']) || !empty($args['feed']))
		{
			$link.= ' ';
			if (empty($args['feed_image']))
			{
				$link.= '(';
			}

			$link.= '<a href="' . esc_url(get_term_feed_link($category->term_id, $category->taxonomy, $args['feed_type'])) . '"';
			if (empty($args['feed']))
			{
				$alt = ' alt="' . sprintf(__('Feed for all posts filed under %s') , $cat_name) . '"';
			}
			else
			{
				$alt = ' alt="' . $args['feed'] . '"';
				$name = $args['feed'];
				$link.= empty($args['title']) ? '' : $args['title'];
			}

			$link.= '>';
			if (empty($args['feed_image']))
			{
				$link.= $name;
			}
			else
			{
				$link.= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
			}

			$link.= '</a>';
			if (empty($args['feed_image']))
			{
				$link.= ')';
			}
		}

		if (!empty($args['show_count']))
		{
			$link.= ' (' . number_format_i18n($category->count) . ')';
		}

		if ('list' == $args['style'])
		{
			$output.= "\t<li";
			$css_classes = array(
				'cat-item',
				'cat-item-' . $category->term_id,
			);
			if (!empty($args['current_category']))
			{

				// 'current_category' can be an array, so we use `get_terms()`.

				$_current_terms = get_terms($category->taxonomy, array(
					'include' => $args['current_category'],
					'hide_empty' => false,
				));
				foreach($_current_terms as $_current_term)
				{
					if ($category->term_id == $_current_term->term_id)
					{
						$css_classes[] = 'current-cat';
					}
					elseif ($category->term_id == $_current_term->parent)
					{
						$css_classes[] = 'current-cat-parent';
					}

					while ($_current_term->parent)
					{
						if ($category->term_id == $_current_term->parent)
						{
							$css_classes[] = 'current-cat-ancestor';
							break;
						}

						$_current_term = get_term($_current_term->parent, $category->taxonomy);
					}
				}
			}

			/**
			 * Filters the list of CSS classes to include with each category in the list.
			 *
			 * @since 4.2.0
			 *
			 * @see wp_list_categories()
			 *
			 * @param array  $css_classes An array of CSS classes to be applied to each list item.
			 * @param object $category    Category data object.
			 * @param int    $depth       Depth of page, used for padding.
			 * @param array  $args        An array of wp_list_categories() arguments.
			 */
			$css_classes = implode(' ', apply_filters('category_css_class', $css_classes, $category, $depth, $args));
			$output.= ' class="' . $css_classes . '"';
			$output.= ">$link\n";
		}
		elseif (isset($args['separator']))
		{
			if(empty($output) && $args['hide_last_separator'] == true)
			{
				$output = "\t$link" . "\n";
			}
			else if(!empty($output) && $args['hide_last_separator'] == true)
			{
				if($args['reverse_order'] == true)
				{
					$output = "\t$link".$args['separator'].$output;
				}
				else
				{
					$output.= $args['separator'] . "\t$link" . "\n";
				}
			}
			else
			{
				if($args['reverse_order'] == true)
				{
					$output = "\t$link" . $args['separator'] . "\n".$output;
				}
				else
				{
					$output.= "\t$link" . $args['separator'] . "\n";
				}
			}
		}
		else
		{
			if(empty($output) && $args['hide_last_separator'] == true)
			{
				$output = "\t$link" . "\n";
			}
			else if(!empty($output) && $args['hide_last_separator'] == true)
			{
				if($args['reverse_order'] == true)
				{
					$output = "<br />\t$link\n".$output;
				}
				else
				{
					$output.= "<br />\t$link\n";
				}
			}
			else
			{
				if($args['reverse_order'] == true)
				{
					$output = "\t$link<br />\n".$output;
				}
				else
				{
					$output.= "\t$link<br />\n";
				}
			}
		}
	}
}
function get_hotel_location_list($post_id, $args1 = null)
{
	//$args1 - used for future purpose

	$hotel_loc_taxonomy = "hotel-locations";
	$args = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'fields' => 'ids'
			);
	$terms = wp_get_post_terms( $post_id, $hotel_loc_taxonomy, $args );
	$hotel_location = "";
	if(!empty($terms))
	{
		$hotel_location = tv_wp_list_categories( array(
	        'taxonomy' 				=> $hotel_loc_taxonomy,
	        'hierarchical' 			=> true,
	        'style'    				=> 'none',
	        'separator' 			=> ', ',
	        'title_li' 				=> '',
	        'no_anchor'				=> true,
	        'hide_last_separator' 	=> true,
	        'reverse_order' 		=> true,
	        'include' 				=> $terms,
	        'echo'					=> 0
	    ) );
	}
    return $hotel_location;
}

class TV_Main_Menu_Walker extends Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        $nav_menu_sub_heading = carbon_get_post_meta($item->ID, 'nav_menu_sub_heading');
        $nav_menu_sub_heading_html = "";
        if($nav_menu_sub_heading)
        {
        	$nav_menu_sub_heading_html = "<span class='menu-sub-heading'>".$nav_menu_sub_heading."</span>";
        }
        $nav_menu_image = carbon_get_post_meta($item->ID, 'nav_menu_image');
        $nav_image = "";
        $nav_image_span = "";
        if($nav_menu_image)
        {
        	$nav_image_url 	= wp_get_attachment_image_src( $nav_menu_image, '190x120' );
			$nav_image_url 	= $nav_image_url[0];
			$has_sub_heading = "";
			if($nav_menu_sub_heading)
			{
				$has_sub_heading = "has-sub-heading";
			}

			$nav_image 		= "<img src='".$nav_image_url."' border='0'><span class='".$has_sub_heading."'>";
			$nav_image_span = "</span>";
        }
        
		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before .$nav_image. $title.$nav_image_span.$nav_menu_sub_heading_html. $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if($depth == 0)
        {
        	$output .= "\n$indent<div class='sub-menu-wrapper'><ul class='sub-menu'>\n";
        }
        else
        {
        	$output .= "\n$indent<ul class='sub-menu'>\n";        	
        }
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if($depth == 0)
        {
        	$output .= "$indent</ul></div>\n";
        }
        else
        {
        	$output .= "$indent</ul>\n";
        }
    }
}
function get_hotel_id($post_id)
{
	$ancestors_ids = get_post_ancestors($post_id);
	if(is_array($ancestors_ids) && count($ancestors_ids) > 0)
	{
		return $ancestors_ids[(count($ancestors_ids) - 1)];
	}
	else
	{
		return false;
	}
}
function left_sidebar_nav($post_id, $curr_post_id, $exclude_posts = array(), $depth = 0, $ul_class = "side-nav", $post_count = false)
{
	$args = array(
		'post_type' => 'hotel',
		'numberposts' => -1,
		'orderby' => 'order',
		'order' => 'ASC',
		'post_status' => 'publish',
		'post_parent' => $post_id,
		
	);
	$post1 = get_post($post_id);
	if(!empty($post1))
	{
		$args['post_type'] = $post1->post_type;
	}
	if($exclude_posts != null && !empty($exclude_posts))
	{
		$args['exclude'] = $exclude_posts;
	}
	$child_post_array = get_posts($args);

	if($post_count)
	{
		return count($child_post_array);
	}

	if(!empty($child_post_array) && count($child_post_array) > 0)
	{
		echo "<ul class='".$ul_class." child-".$depth."'>";
		$depth++;
		foreach($child_post_array as $child_key => $child_post)
		{
			$post_id = $child_post->ID;
			if($child_post->post_parent == 0)
			{
				$depth = 0;
			}
			$child_post_link = get_permalink($post_id);
			$li_class = ($curr_post_id == $post_id) ? "current" : "";

			$total_child_posts = left_sidebar_nav($post_id, $curr_post_id, $exclude_posts, $depth, "side-sub-menu", true);
			$has_childern = "";
			if($total_child_posts > 0)
			{
				$has_childern = "menu-item-has-children";
			}
			else
			{
				$has_childern = "menu-item-has-no-children";
			}
			?>
			<li class="side-nav-li <?php echo $li_class." ".$has_childern; ?>">
				<a href="<?php echo $child_post_link; ?>" class="<?php echo $has_childern; ?>"><?php echo $child_post->post_title; ?></a>
				<?php
				left_sidebar_nav($post_id, $curr_post_id, $exclude_posts, $depth, "side-sub-menu");
				?>
			</li>
			<?php
		}
		echo "</ul>";
	}
}
function tv_redirect_to_detail()
{
	/* Redirecting to detail page if listing page has only 1 item/record. */
    global $post;
    if(!empty($post) && $post->post_type == 'hotel')
    {
		$args = array(
			'post_type' => 'hotel',
			'numberposts' => 2,
			'orderby' => 'order',
			'order' => 'ASC',
			'post_status' => 'publish',
			'post_parent' => $post->ID,
		);

		$child_post_array = get_posts($args);
		if(count($child_post_array) == 1)
		{
			foreach ($child_post_array as $key => $child_post)
			{
				wp_redirect( get_permalink($child_post->ID) );
			}
		}
    } 
}
add_action('template_redirect', 'tv_redirect_to_detail');

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg_thumb_display() {
  echo '<style type="text/css">
    td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
      width: 100% !important; 
      height: auto !important; 
    }
   </style>
  ';
}
add_action('admin_head', 'fix_svg_thumb_display');
function left_sidebar_nav_not_hotel($exclude_posts, $post_type, $post_id = 0, $depth = 0, $ul_class = "side-nav", $post_count = false)
{
	$args = array(
		'post_type' => $post_type,
		'numberposts' => -1,
		'orderby' => 'order',
		'order' => 'ASC',
		'post_status' => 'publish',
		'post_parent' => $post_id,
		'exclude' => $exclude_posts,
	);

	$child_post_array = get_posts($args);
	
	if($post_count)
	{
		return count($child_post_array);
	}

	if(!empty($child_post_array) && count($child_post_array) > 0)
	{
		echo "<ul class='".$ul_class." child-".$depth."'>";
		$depth++;
		foreach($child_post_array as $child_key => $child_post)
		{
			$post_id = $child_post->ID;
			if($child_post->post_parent == 0)
			{
				$depth = 0;
			}
			$child_post_link = get_permalink($post_id);

			$total_child_posts = left_sidebar_nav_not_hotel($exclude_posts, $post_type, $post_id, $depth, "side-sub-menu", true);
			$has_childern = "";
			if($total_child_posts > 0)
			{
				$has_childern = "menu-item-has-children";
			}
			else
			{
				$has_childern = "menu-item-has-no-children";
			}
			?>
			<li class="side-nav-li <?php echo $has_childern; ?>">
				<a href="<?php echo $child_post_link." ".$has_childern; ?>"><?php echo $child_post->post_title; ?></a>
				<?php
				left_sidebar_nav_not_hotel($exclude_posts, $post_type, $post_id, $depth, "side-sub-menu");
				?>
			</li>
			<?php
		}
		echo "</ul>";
	}
}
function my_wpcf7_dropdown_form($html)
{
	$text = 'Select an option';
	$html = str_replace('---', $text, $html);
	return $html;
}
add_filter('wpcf7_form_elements', 'my_wpcf7_dropdown_form');