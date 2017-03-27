<?php
/*
Template Name: Room Details
*/

get_header(); ?>
	<?php

    $post_meta = ( $post ) ? get_post_meta( $post->ID ) : null;
	?>
	<pre>
		<?php
			print_r($post_meta);
			print_r($post);
		?>
	</pre>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
