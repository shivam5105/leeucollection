<?php
if (!class_exists('multiLevelCustomPosts'))
{
	class multiLevelCustomPosts
	{
		public $slug;
		public $parent_slug;
		public $post_hierarchy;
		public $box_title;
		public $box_context;
		public $box_priority;
		public $labels = array(
			"name" => "Custom Posts",
			"singular_name" => "Custom Post",
			"menu_name" => "Custom Posts",
			"name_admin_bar" => "Custom Posts",
			"all_items" => "All Custom Posts",
			"add_new" => "Add New",
			"add_new_item" => "Add New Custom Posts",
			"edit" => "Edit",
			"edit_item" => "Edit Custom Posts",
			"new_item" => "New Custom Posts",
			"view" => "View",
			"view_item" => "View Custom Posts",
			"search_items" => "Search Custom Posts",
			"not_found" => "No Custom Posts Found",
			"not_found_in_trash" => "No Custom Posts Found in Trash",
			"parent" => "Parent Custom Posts",
		);
		public $args = array(
			"label" => "Custom Post",
			"hierarchical" => true,
			"public" => true,
			"description" => "",
			"show_ui" => true,
			"has_archive" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"exclude_from_search" => false,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"can_export" => true,
			/*"rewrite" 				=> array( "slug" => "hotel", "with_front" => true ),*/
			"query_var" => true,
			"publicly_queryable" => true,
			"supports" => array(
				"title",
				"revisions",
				"thumbnail"
			)
		);
		function __construct($slug, $new_labels, $new_args)
		{
			$this->slug = $slug;
			$this->labels = array_merge($this->labels, $new_labels);
			$this->updateNotExistsKey($new_labels);
			$this->args = array_merge($this->args, $new_args);
			$this->args["labels"] = $this->labels;
			if (!array_key_exists("label", $new_args) && array_key_exists("name", $new_labels))
			{
				$this->args = $new_labels['name'];
			}
			register_post_type($this->slug, $this->args);
		}

		public function updateNotExistsKey($new_labels)
		{
			$name = isset($new_labels['name']) ? $new_labels['name'] : "";
			$singular_name = isset($new_labels['singular_name']) ? $new_labels['singular_name'] : "";
			foreach($this->labels as $key => $value)
			{
				if (!array_key_exists($key, $new_labels))
				{
					switch ($key)
					{
						/*case "name":
						$value = "Custom Posts";
						break;
						case "singular_name":
						$value = "Custom Post";
						break;*/
					case "menu_name":
						$value = $name;
						break;

					case "name_admin_bar":
						$value = $name;
						break;

					case "all_items":
						$value = "All " . $name;
						break;

					case "add_new":
						$value = "Add New";
						break;

					case "add_new_item":
						$value = "Add New " . $singular_name;
						break;

					case "edit":
						$value = "Edit";
						break;

					case "edit_item":
						$value = "Edit " . $singular_name;
						break;

					case "new_item":
						$value = "New " . $singular_name;
						break;

					case "view":
						$value = "View";
						break;

					case "view_item":
						$value = "View " . $name;
						break;

					case "search_items":
						$value = "Search " . $name;
						break;

					case "not_found":
						$value = "No " . $name . " Found";
						break;

					case "not_found_in_trash":
						$value = "No " . $name . " Found in Trash";
						break;

					case "parent":
						$value = "Parent " . $name;
						break;
					}

					$this->labels[$key] = $value;
				}
			}
		}

		public function myprint()
		{
			print_r($this->args);
		}

		public function addParentBox($parent_slug, $box_title, $box_context = 'side', $box_priority = 'default')
		{
			$this->parent_slug = $parent_slug;
			$this->box_title = $box_title;
			$this->box_context = $box_context;
			$this->box_priority = $box_priority;
			add_action('add_meta_boxes', array(
				$this,
				'addingCustomMetaBoxes'
			) , 10, 2);
		}

		public function addingCustomMetaBoxes()
		{
			add_meta_box($this->slug . "-parent", $this->box_title, array(
				$this,
				'renderCustomMetaBox'
			) , $this->slug, $this->box_context, $this->box_priority);
			$this->postCustomPermalinks();
		}

		public function renderCustomMetaBox($post, $box_details)
		{
			/*$post_type_object = get_post_type_object( $post->post_type );*/
			$pages = wp_dropdown_pages(array(
				"post_type" => $this->parent_slug,
				"selected" => $post->post_parent,
				"name" => "parent_id",
				"show_option_none" => __("(no parent)") ,
				"sort_column" => "menu_order, post_title",
				"echo" => 0
			));
			if (!empty($pages))
			{
				echo $pages;
			}
		}

		public function postCustomPermalinks()
		{
			add_filter("post_type_link", array(
				$this,
				"updatePostPermalinks"
			) , 10, 3);
		}

		public function updatePostPermalinks($permalink, $post, $leavename)
		{
			$post_id = $post->ID;
			if ($post->post_type != $this->slug || empty($permalink) || in_array($post->post_status, array(
				"draft",
				"pending",
				"auto-draft"
			)))
			{
				return $permalink;
			}

			$parent = $post->post_parent;
			$parent_post = get_post($parent);
			if ($post->post_parent)
			{
				$permalink = str_replace("%" . $this->parent_slug . "%", $parent_post->post_name, $permalink);
			}
			else
			{
				$permalink = str_replace("/%" . $this->parent_slug . "%", "", $permalink);
			}

			return $permalink;
		}

		public function showHierarchicalPosts($post_types)
		{
			$this->post_hierarchy = $post_types;
			add_action("pre_get_posts",
			function ($query)
			{
				if (is_admin())
				{
					$scr = get_current_screen();
					if ($scr->base === "edit" && $scr->post_type === $this->slug)
					{
						$query->set("post_type", $this->post_hierarchy);
						add_filter("edit_posts_per_page",
						function ($perpage)
						{
							global $post_type;
							if (is_array($post_type) && in_array($this->slug, $post_type))
							{
								$post_type = $this->slug;
							}

							return $perpage; // we don't want to affect $perpage value
						});
					}
				}

				return $query;
			});
		}

		public function addRewriteRules()
		{
			/*add_permastruct($this->slug, "/".$this->slug."/%hotel%/%".$this->slug."%", false);*/
			add_rewrite_tag("%" . $this->slug . "%", "([^/]+)", $this->slug . "=");
			add_rewrite_rule("^" . $this->slug . "/([^/]+)/([^/]+)/?", 'index.php?' . $this->slug . '=$matches[2]', "top");
			add_rewrite_rule("^" . $this->slug . "/([^/]+)/?", 'index.php?' . $this->slug . '=$matches[1]', "top");
		}
	}
}

function registerMyCustomPost()
{
	/********* Hotels Post Type ***********/
	$labels = array(
		"name" => "Hotels",
		"singular_name" => "Hotel",
	);
	$args = array(
		"label" => "Hotels",
		"labels" => $labels,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "hotel";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);
	
	/********* Hotels Post Type ***********/
	
	/********* Discover Post Type ***********/

	$labels = array(
		"name" => "Discover",
		"singular_name" => "Discover",
	);
	$args = array(
		"label" => "Discover",
		"labels" => $labels,
		'menu_position' => 6,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-discover";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);

	/********* Discover Post Type ***********/
	
	/********* Restaurants Post Type ***********/

	$labels = array(
		"name" => "Restaurants",
		"singular_name" => "Restaurant",
	);
	$args = array(
		"label" => "Restaurants",
		"labels" => $labels,
		'menu_position' => 7,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-restaurants";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);

	/********* Restaurants Post Type ***********/

	/********* Wine Post Type ***********/

	$labels = array(
		"name" => "Wine",
		"singular_name" => "Wine",
	);
	$args = array(
		"label" => "Wine",
		"labels" => $labels,
		'menu_position' => 8,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-wine";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);

	/********* Restaurants Post Type ***********/
	
	/********* Artisan Drinks Post Type ***********/

	$labels = array(
		"name" => "Artisan Drinks",
		"singular_name" => "Artisan Drink",
	);
	$args = array(
		"label" => "Artisan Drinks",
		"labels" => $labels,
		'menu_position' => 9,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-artisan-drinks";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);
	
	/********* Artisan Drinks Post Type ***********/

	/********* Careers Post Type ***********/

	$labels = array(
		"name" => "Careers",
		"singular_name" => "Career",
	);
	$args = array(
		"label" => "Careers",
		"labels" => $labels,
		'menu_position' => 10,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-careers";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);
	
	/********* Careers Post Type ***********/

	/********* Media & trades Post Type ***********/

	$labels = array(
		"name" => "Media & trades",
		"singular_name" => "Media & trade",
	);
	$args = array(
		"label" => "Media & trades",
		"labels" => $labels,
		'menu_position' => 11,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			"editor",
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-media-trades";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);
	
	/********* Media & trades Post Type ***********/

	/********* Press Post Type ***********/

	$labels = array(
		"name" => "Press",
		"singular_name" => "Press",
	);
	$args = array(
		"label" => "Press",
		"labels" => $labels,
		'menu_position' => 12,
		'show_in_admin_bar' => true,
		/*'taxonomies' 	=> array('category'),*/
		"supports" => array(
			"title",
			"revisions",
			"thumbnail",
			/*"editor",*/
			"page-attributes",
			"custom-fields" /*, "post-formats"*/
		)
	);
	$parentSlug = "leeu-press";
	$parent = new multiLevelCustomPosts($parentSlug, $labels, $args);
	
	/********* Press Post Type ***********/
}

add_action("init", "registerMyCustomPost");

function custom_taxonomy($data)
{
	register_taxonomy($data['slug'], $data['post-slug'], array(
		'hierarchical' => true,
		'label' => $data['name'],
		'query_var' => true,
		'rewrite' => array(
			'slug' => $data['slug'],
			'with_front' => false
		)
	));
}

function location_taxonomy()
{
	$data = array(
		'post-slug' => array('hotel','leeu-restaurants'),
		'name' => 'Locations',
		'singular_name' => 'Location',
		'slug' => 'hotel-locations',
		'textdomain' => 'leeucollection'
	);
	custom_taxonomy($data);
}

add_action('init', 'location_taxonomy');

function menu_type_taxonomy()
{
	$data = array(
		'post-slug' => array('hotel','leeu-restaurants'),
		'name' => 'Menu Types',
		'singular_name' => 'Menu Type',
		'slug' => 'menu-types',
		'textdomain' => 'leeucollection'
	);
	custom_taxonomy($data);
}

add_action('init', 'menu_type_taxonomy');

/** Custom Post Type Template Selector **/

function cpt_add_meta_boxes()
{
	$post_types = get_post_types();
	foreach($post_types as $ptype)
	{
		if ($ptype !== 'page')
		{
			add_meta_box('cpt-selector', 'Attributes', 'cpt_meta_box', $ptype, 'side', 'core');
		}
	}
}

add_action('add_meta_boxes', 'cpt_add_meta_boxes');

function cpt_remove_meta_boxes()
{
	$post_types = get_post_types();
	foreach($post_types as $ptype)
	{
		if ($ptype !== 'page')
		{
			remove_meta_box('pageparentdiv', $ptype, 'normal');
		}
	}
}

add_action('admin_menu', 'cpt_remove_meta_boxes');

function cpt_meta_box($post)
{
	$post_meta = get_post_meta($post->ID);
	$templates = wp_get_theme()->get_page_templates();
	$post_type_object = get_post_type_object($post->post_type);
	if ($post_type_object->hierarchical)
	{
		$dropdown_args = array(
			'post_type' => $post->post_type,
			'exclude_tree' => $post->ID,
			'selected' => $post->post_parent,
			'name' => 'parent_id',
			'show_option_none' => __('(no parent)') ,
			'sort_column' => 'menu_order, post_title',
			'echo' => 0,
		);
		$dropdown_args = apply_filters('page_attributes_dropdown_pages_args', $dropdown_args, $post);
		$pages = wp_dropdown_pages($dropdown_args);
		if ($pages)
		{
			echo "<p><strong>Parent</strong></p>";
			echo "<label class=\"screen-reader-text\" for=\"parent_id\">Parent</label>";
			echo $pages;
		}
	}

	// Template Selector

	echo "<p><strong>Template</strong></p>";
	echo "<select id=\"page_template\" name=\"_wp_page_template\"><option value=\"default\">Default Template</option>";
	foreach($templates as $template_filename => $template_name)
	{
		/*if ( $post->post_type == strstr( $template_filename, '-', true) ) {*/
		if (isset($post_meta['_wp_page_template'][0]) && ($post_meta['_wp_page_template'][0] == $template_filename))
		{
			echo "<option value=\"$template_filename\" selected=\"selected\">$template_name</option>";
		}
		else
		{
			echo "<option value=\"$template_filename\">$template_name</option>";
		}

		/*}*/
	}

	echo "</select>";

	// Page order

	echo "<p><strong>Order</strong></p>";
	echo "<p><label class=\"screen-reader-text\" for=\"menu_order\">Order</label><input name=\"menu_order\" type=\"text\" size=\"4\" id=\"menu_order\" value=\"" . esc_attr($post->menu_order) . "\" /></p>";
}

function save_cpt_template_meta_data($post_id)
{
	if (isset($_REQUEST['_wp_page_template']))
	{
		update_post_meta($post_id, '_wp_page_template', $_REQUEST['_wp_page_template']);
	}
}

add_action('save_post', 'save_cpt_template_meta_data');

function custom_single_template($template)
{
	global $post;
	$post_meta = ($post) ? get_post_meta($post->ID) : null;
	if (isset($post_meta['_wp_page_template'][0]) && ($post_meta['_wp_page_template'][0] != 'default'))
	{
		$template = get_template_directory() . '/' . $post_meta['_wp_page_template'][0];
	}

	return $template;
}

add_filter('single_template', 'custom_single_template');
/** END Custom Post Type Template Selector **/
?>