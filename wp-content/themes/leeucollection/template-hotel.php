<?php
/*
Template Name: Hotel
*/

get_header(); ?>
	<?php
	$post_id = $post->ID;
	$hotel_loc_taxonomy = "hotel-locations";
	$args = array(
			'orderby' => 'name',
			'order' => 'ASC',
			'fields' => 'ids'
			);
	$terms = wp_get_post_terms( $post_id, $hotel_loc_taxonomy, $args );

	$hotel_location = tv_wp_list_categories( array(
        'taxonomy' 				=> $hotel_loc_taxonomy,
        'hierarchical' 			=> true,
        'style'    				=> 'none',
        'separator' 			=> ', ',
        'title_li' 				=> '',
        'no_anchor'				=> true,
        'hide_last_separator' 	=> true,
        'include' 				=> $terms,
        'echo'					=> 0
    ) );

    $post_meta = ( $post ) ? get_post_meta( $post->ID ) : null;
    ?>
    <div style="margin:0 auto; text-align: center;">
    	<?php echo $hotel_location; ?>    	
		<div itemscope itemtype="http://schema.org/Organization">
			<h1 itemprop="legalName"><?php echo $post->post_title;?></h1>
		</div>
    	
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
		<table border='1' cellpadding="5" cellspacing="0" align="center" width="90%">
			<tr>
				<td width="25%" valign="top">
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
				</td>
				<td valign="top">
					<?php
					if(!empty($child_post_array) && count($child_post_array) > 0)
					{
						foreach($child_post_array as $child_key => $child_post)
						{
							$child_post_id = $child_post->ID;
							$child_post_meta = ( $child_post ) ? get_post_meta( $child_post_id ) : null;

							$child_post_title = $child_post->post_title;
							if(isset($child_post_meta['_crb_alternate_title']) && !empty($child_post_meta['_crb_alternate_title'][0]))
							{
								$child_post_title = $child_post_meta['_crb_alternate_title'][0];
							}
							?>
							<div>
								<h2><?php echo $child_post_title; ?></h2>
								<?php
								if(isset($child_post_meta['_crb_show_view_all_link'][0]) && $child_post_meta['_crb_show_view_all_link'][0] == 1)
								{
									?>
									<a href="<?php echo get_permalink($child_post_id); ?>">View All <?php echo $child_post->post_title; ?></a>
									<br>
									<?php
								}
								$args = array(
									'order'=> 'ASC',
									'post_parent' => $child_post_id,
									'post_type' => 'hotel'
									);

								$child_post_array2 = get_children($args);
								if(!empty($child_post_array2))
								{
									foreach ($child_post_array2 as $child_key2 => $child_post2)
									{
										$child_post2_id = $child_post2->ID;
										$child_post2_meta = ( $child_post2 ) ? get_post_meta( $child_post2_id ) : null;

										$child_post2_img_url = wp_get_attachment_image_src(get_post_thumbnail_id($child_post2_id),'821x478');
										$child_post2_img_url = $child_post2_img_url[0];
										if(empty($child_post2_img_url))
										{
									    	$slider_data = carbon_get_post_meta($child_post2_id, "crb_slider_images", 'complex');
											if(is_array($slider_data) && !empty($slider_data))
											{
												foreach ($slider_data as $slide_key => $slide_data)
												{
													$child_post2_img_url = wp_get_attachment_image_src( $slide_data['crb_slide_image'], '821x478' );
													$child_post2_img_url = $child_post2_img_url[0];

													break; /* Show One image of each post (room/restaurant etc) */
												}
											}
										}
										if(!empty($child_post2_img_url))
										{
											?>
											<img src="<?php echo $child_post2_img_url; ?>" alt="" />
											<?php
											$slider_title = ($child_post2_meta['_crb_slider_bottom_heading'][0]) ? $child_post2_meta['_crb_slider_bottom_heading'][0] : $child_post2->post_title;
											$slider_desc = ($child_post2_meta['_crb_slider_bottom_description'][0]) ? $child_post2_meta['_crb_slider_bottom_description'][0] : $child_post2->post_content;
											?>
											<table border="1" width="100%" cellpadding="5" cellspacing="0">
												<tr>
													<td width="35%"><?php echo $slider_title; ?></td>
													<td><?php echo $slider_desc; ?></td>
												</tr>
											</table>
											<?php
										}
									}
								}
								else
								{
									$child_post_img_url = wp_get_attachment_image_src(get_post_thumbnail_id($child_post_id),'821x478');
									$child_post_img_url = $child_post_img_url[0];
									?>
									<img src="<?php echo $child_post_img_url; ?>" alt="" />
									<?php
								}
								?>
							</div>
							<?php
						}
					}
					?>
				</td>
			</tr>
		</table>
    </div>

	<pre>
		<?php
		//print_r($post_meta);
		?>
	</pre>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
