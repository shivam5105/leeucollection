<?php
/*
Template Name: Room
*/

get_header(); ?>
	<?php
echo "<h1>".$post->post_title."</h1>";
    //$post_meta = ( $post ) ? get_post_meta( $post->ID ) : null;
	?>
	<!-- <pre>
		<?php
			/*print_r($post_meta);
			print_r($post);*/
		?>
	</pre> -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
