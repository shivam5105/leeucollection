<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Theme Option
Container::make('theme_options', 'Theme Options')
    ->add_fields(array(
        Field::make('text', 'crb_facebook_link'),
        Field::make('text', 'crb_instagram_link'),
        Field::make('text', 'crb_twitter_link'),
		/*Field::make('text', 'crb_pintrest_link'),
        Field::make('text', 'crb_tumblr_link'),*/
));
    
//Menu Settings
Container::make('nav_menu', 'Menu Settings')
    ->add_fields(array(
        Field::make('image', 'nav_menu_image', 'Menu Image')->help_text('(Image Dimensions (WxH): 190 x 120)'),
));

//Images Slider
Container::make('post_meta', 'Slider Images')
    ->show_on_post_type('hotel')
    ->show_on_template('template-roomdetails.php')
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', 'Slider Images')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Insert Image')->help_text('(Image Dimensions (WxH): 821 x 478)'),
    )),
    Field::make('text', 'crb_slider_bottom_heading' , 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).'),
    Field::make('textarea', 'crb_slider_bottom_description' , 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).'),
));
