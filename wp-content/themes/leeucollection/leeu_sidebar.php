<?php

$left_nav_logo = isset($post_meta['_crb_left_nav_image']) ? $post_meta['_crb_left_nav_image'] : null;

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
		<img src="<?php echo $left_nav_logo_url[0]; ?>">
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
	$post1 = get_post($post_id_for_nav);
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
		echo "<li class='menu-view-all-link'><a href='".$post1_link."'>View All ".$post1->post_title."</a></li>";
		echo "</ul>";
	}
}
$post_id_for_nav = ($top_most_parent_post == false) ? $post_id : $top_most_parent_post->ID;
left_sidebar_nav($post_id_for_nav,$post_id,$ancestors_ids);
?>