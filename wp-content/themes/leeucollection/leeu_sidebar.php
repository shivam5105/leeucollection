<?php

$left_nav_logo = isset($post_meta['_crb_left_nav_image']) ? $post_meta['_crb_left_nav_image'] : null;
if($left_nav_logo != null)
{
	$left_nav_logo 		= $left_nav_logo[0];
	$left_nav_logo_url 	= wp_get_attachment_image_src($left_nav_logo);
	?>
	<img src="<?php echo $left_nav_logo_url[0]; ?>">
	<?php
}

$args = array(
	'order'=> 'ASC',
	'post_parent' => $post_id,
	'post_type' => 'hotel'
	);

$child_post_array = get_children($args);
if(!empty($child_post_array) && count($child_post_array) > 0)
{
	echo "<ul>";
	foreach($child_post_array as $child_key => $child_post)
	{
		$child_post_link = get_permalink($child_post->ID);
		echo "<li><a href='".$child_post_link."'>".$child_post->post_title."</a></li>";
	}
	echo "</ul>";
}
?>