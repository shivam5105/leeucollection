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

//Left Nav Image
Container::make('post_meta', 'Left Menu Image')
    ->show_on_post_type('hotel')
    ->set_context('side')
    ->set_priority('low')
    ->add_fields(array(
        Field::make('image', 'crb_left_nav_image', '')->help_text('(Image Dimensions (WxH): w x h)'),
    ));

//Images Slider
Container::make('post_meta', 'Slider Images')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-hotel.php','template-room.php','template-restaurant.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', '')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Slide Image')->help_text('(Image Dimensions (WxH): 821 x 478)'),
        )),
    ));

//Slider Info
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type('hotel')
    ->show_on_template('template-room.php')
    ->add_fields(array(
        Field::make('text', 'crb_slider_bottom_heading' , 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).'),
        Field::make('textarea', 'crb_slider_bottom_description' , 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).'),
    ));

//Slider Info
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('textarea', 'crb_slider_bottom_description' , 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).'),
        Field::make('text', 'crb_booking_buton_text' , 'Booking Button Text')->set_width(20)->set_default_value('Book'),
        Field::make('text', 'crb_booking_buton_link' , 'Booking Button Link')->set_width(80),
    ));

//Room Rates
Container::make('post_meta', 'Room Rates')
    ->show_on_post_type('hotel')
    ->show_on_template('template-room.php')
    ->add_fields(array(
        Field::make('complex', 'crb_rates', '')->add_fields(array(
             Field::make('text', 'crb_rate_amount' , 'Amount')->help_text('Example: R9000.00')->set_width(20),
             Field::make('text', 'crb_rate_for' , 'For')->set_default_value('per room/per night')->set_width(80)->help_text('Example: per room/per night'),
             Field::make('text', 'crb_booking_buton_text' , 'Booking Button Text')->set_width(20)->set_default_value('Book'),
             Field::make('text', 'crb_booking_buton_link' , 'Booking Button Link')->set_width(80),
        )),
    ));

//Special Features
Container::make('post_meta', 'Special Features')
    ->show_on_post_type('hotel')
    ->show_on_template('template-room.php')
    ->add_fields(array(
        Field::make('complex', 'crb_special_features', '')->add_fields(array(
             Field::make('text', 'crb_feature' , 'Feature'),
        )),
    ));

//Hours & Reservations
Container::make('post_meta', 'Hours & Reservations')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('complex', 'crb_hours_reservations', '')->add_fields(array(
             Field::make('text', 'crb_reservation_for' , 'Reservation For')->set_width(30),
             Field::make('textarea', 'crb_reservation_time' , 'Reservation Time')->set_width(70),
        )),
    ));

//Policy
Container::make('post_meta', 'Policy')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('textarea', 'crb_policy' , 'Policy')->set_width(70),
    ));

//The Chef
Container::make('post_meta', 'The Chef Section')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('text', 'crb_chef_section_heading' , 'Section Heading'),
        Field::make('complex', 'crb_chef_section_info', '')->add_fields(array(
            Field::make('image', 'crb_chef_image', 'Chef Image')->set_width(20)->help_text('(Image Dimensions (WxH): w x h)'),
            Field::make('textarea', 'crb_chef_description', 'Chef Description')->set_width(80),
        )),
    ));
