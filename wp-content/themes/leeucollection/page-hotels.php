<?php
get_header();
?>
	<?php
	$post_id = $post->ID;
    $post_meta = ( $post ) ? get_post_meta( $post->ID ) : null;
    ?>
    <div style="margin:0 auto; text-align: center;">
		<h1><?php echo $post->post_title;?></h1>
		<?php
    	$slider_data = carbon_get_post_meta($post->ID, "crb_slider_images", 'complex');
		if(is_array($slider_data) && !empty($slider_data))
		{
			foreach ($slider_data as $slide_key => $slide_data)
			{
				$banner_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '1240x600' );
				$banner_url = $banner_url[0];
				?>
				<img src="<?php echo $banner_url; ?>" alt="" />
				<?php
			}
		}
		else
		{
			/*$banner_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );*/
			$banner_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '1240x600' );
			$banner_url = $banner_url[0];
			?>
			<img src="<?php echo $banner_url; ?>" alt="" />
			<?php
		}?>
		<div>
			<?php echo $post->post_content; ?>
		</div>
		<div>
			<?php
			$args = array(
				'post_type' => 'hotel',
				'numberposts' => -1,
				'orderby' => 'order',
				'order' => 'ASC',
				'post_status' => 'publish',
				'post_parent' => 0,
			);

			$child_post_array = get_posts($args);
			if(!empty($child_post_array) && count($child_post_array) > 0)
			{
				foreach($child_post_array as $child_key => $child_post)
				{
					$child_post_id 		= $child_post->ID;
					$child_post_meta 	= ( $child_post ) ? get_post_meta( $child_post_id ) : null;
					$hotel_location 	= get_hotel_location_list($child_post_id);

					$child_post_link = get_permalink($child_post_id);
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $child_post_id ), '821x478' );
					?>
					<div style="float:left; width:48%; border:1px solid black; margin:10px;">
						<a href="<?php echo $child_post_link; ?>"><img src="<?php echo $image[0];?>" alt="<?php echo $child_post->post_title; ?>" style="width:100%;" /></a>
						<div>
							<h2 itemprop="legalName"><a href="<?php echo $child_post_link; ?>"><?php echo $child_post->post_title;?></a></h2>
							<div itemprop="address"><?php echo $hotel_location; ?></div>
						</div>
						<br />
						<a href="<?php echo $child_post_link; ?>">View Hotel</a>
					</div>
					<?php
				}
			}
			?>
		</div>
    </div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
