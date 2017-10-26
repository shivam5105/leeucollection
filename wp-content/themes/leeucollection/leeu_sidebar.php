<?php
$left_nav_logo = isset($post_meta['_crb_left_nav_image']) ? $post_meta['_crb_left_nav_image'] : null;
$left_sidebar_visibility = isset($post_meta['_crb_left_sidebar_visibility']) ? $post_meta['_crb_left_sidebar_visibility'][0] : "show";

if($left_sidebar_visibility == 'hide')
{
	return true;
}
if(empty($left_nav_logo) || $left_nav_logo == null || (is_array($left_nav_logo) && empty($left_nav_logo[0])))
{
	$top_most_parent_post_meta = ( $top_most_parent_post ) ? get_post_meta( $top_most_parent_post->ID ) : null;
	$left_nav_logo 	= isset($top_most_parent_post_meta['_crb_left_nav_image']) ? $top_most_parent_post_meta['_crb_left_nav_image'] : null;
}

if($left_nav_logo != null)
{
	$left_nav_logo 		= $left_nav_logo[0];
	$left_nav_logo_url 	= wp_get_attachment_image_src($left_nav_logo);
	?>
	<div class="side-log-wrap">
		<img src="<?php echo $left_nav_logo_url[0]; ?>" itemprop="logo">
	</div>
	<?php
}
$ancestors_ids = array();
if(!empty($post) && $post->post_parent > 0)
{
	$ancestors_ids 		= get_post_ancestors($post_id);
	$total_ancestors 	= count($ancestors_ids);
	if($total_ancestors > 1)
	{
		$post_id_for_nav = $ancestors_ids[$total_ancestors - 2];
	}
	else
	{
		$post_id_for_nav = $post->ID;
		$ancestors_ids[] = $post_id_for_nav;
	}
	$ancestors_ids = array(); /* Remove this line to move current nav on the top. */
	/*$post1 = get_post($post_id_for_nav); //Uncomment this line to move current nav on the top.
	if(!empty($post1))
	{
		$depth = 0;
		$post1_link = get_permalink($post1->ID);
		$li_class = ($post_id_for_nav == $post_id) ? "current" : "";
		echo "<ul class='side-nav child-".$depth."'><li class='side-nav-li ".$li_class."'>";
		$depth++;
		echo "<a href='".$post1_link."'>".$post1->post_title."</a>";
		left_sidebar_nav($post_id_for_nav,$post_id,array(),$depth,"side-sub-menu");
		echo "</li>";
		*/
		/*echo "<li class='menu-view-all-link'><a href='".$post1_link."'>View All ".$post1->post_title."</a></li>";*/
		/*echo "</ul>";
	}*/
}
$post_id_for_nav = ($top_most_parent_post == false) ? $post_id : $top_most_parent_post->ID;
left_sidebar_nav($post_id_for_nav,$post_id,$ancestors_ids);

if($post->post_type != 'hotel' && $post->post_type != 'page')
{
	left_sidebar_nav_not_hotel($post_id_for_nav, $post->post_type);
}
else if($post->post_type == 'page')
{
	if(has_nav_menu('footer_menu_left') || has_nav_menu('footer_menu_right'))
	{
		$depth 			= 0;
		$menuLocations 	= get_nav_menu_locations();

		echo "<ul class='side-nav child-".$depth."'>";

		if(has_nav_menu('footer_menu_right'))
		{
			$menu_id_right 		= $menuLocations['footer_menu_right'];
			$menu_array_right 	= wp_get_nav_menu_items($menu_id_right);

			/*$current_page_menu = wp_get_nav_menu_items($menu_id_right,array(
				'posts_per_page' => -1,
				'meta_key' => '_menu_item_object_id',
				'meta_value' => $post_id_for_nav
			));*/
		}
		if(has_nav_menu('footer_menu_left'))
		{
			$menu_id_left 		= $menuLocations['footer_menu_left'];
			$menu_array_left	= wp_get_nav_menu_items($menu_id_left);
			
			/*if(empty($current_page_menu))
			{
				$current_page_menu = wp_get_nav_menu_items($menu_id_left,array(
					'posts_per_page' => -1,
					'meta_key' => '_menu_item_object_id',
					'meta_value' => $post_id_for_nav
				));
			}*/
		}
		/*foreach ($current_page_menu as $nav_item)
		{
			$li_class = ($post_id_for_nav == $nav_item->object_id) ? "current" : "";
			if(!in_array("no-link", $nav_item->classes))
			{
				$li_menu_class = @implode(" ", $nav_item->classes);

				echo "<li class='side-nav-li menu-item-has-no-children ".$li_class."'>";
				echo "<a href='".$nav_item->url."'>".$nav_item->title."</a>";
				echo "</li>";
			}
		}*/
		if(has_nav_menu('footer_menu_right'))
		{
			foreach ( $menu_array_right as $nav_item )
			{
				if(!in_array("no-link", $nav_item->classes) && !in_array("hide-from-sidebar", $nav_item->classes))/* && $post_id_for_nav != $nav_item->object_id)*/
				{
					$li_class = ($post_id_for_nav == $nav_item->object_id) ? "current" : "";
					$li_menu_class = @implode(" ", $nav_item->classes);

					echo "<li class='side-nav-li menu-item-has-no-children ".$li_class."'>";
					echo "<a href='".$nav_item->url."'>".$nav_item->title."</a>";
					echo "</li>";
				}
			}
		}
		if(has_nav_menu('footer_menu_left'))
		{
			foreach ( $menu_array_left as $nav_item )
			{
				if(!in_array("no-link", $nav_item->classes) && !in_array("hide-from-sidebar", $nav_item->classes))/* && $post_id_for_nav != $nav_item->object_id)*/
				{
					$li_class = ($post_id_for_nav == $nav_item->object_id) ? "current" : "";
					$li_menu_class = @implode(" ", $nav_item->classes);

					echo "<li class='side-nav-li menu-item-has-no-children ".$li_class."'>";
					echo "<a href='".$nav_item->url."'>".$nav_item->title."</a>";
					echo "</li>";
				}
			}
		}
		echo "</ul>";
	}
}
?>