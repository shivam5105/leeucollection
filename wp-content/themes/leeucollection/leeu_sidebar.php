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

$post_id_for_nav = ($top_most_parent_post == false) ? $post_id : $top_most_parent_post->ID;
left_sidebar_nav($post_id_for_nav,$post_id);
?>