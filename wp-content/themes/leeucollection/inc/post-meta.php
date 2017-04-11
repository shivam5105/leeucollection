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
        Field::make('image', 'crb_left_nav_image', '')->help_text('(Image Dimensions (WxH): 150 x 113)'),
    ));

//Content Section Hotel Home Page
Container::make('post_meta', 'Content Section')
    ->show_on_post_type('hotel')
    ->show_on_level(1)
    ->add_fields(array(
        Field::make('complex', 'crb_content_section', '')->add_fields(array(
            Field::make('text', 'crb_section_heading' , 'Heading'),

            Field::make('radio', 'crb_section_layout', 'Section Layout')
                ->add_options(array(
                    '1' => '1 Column',
                    '2' => '2 Columns',
                ))->set_default_value('1'),

            Field::make('radio', 'crb_section_show_link', 'Show View All Link?')
                ->add_options(array(
                    'yes' => 'Yes',
                    'no' => 'No',
                ))->set_default_value('no')->set_width('20'),
            Field::make('text', 'crb_section_link_text' , 'View All Link Text')->set_width('40')->help_text('This will come on the right-top cornor of section.')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_section_show_link',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('text', 'crb_section_link' , 'View All Link')->set_width('40')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_section_show_link',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),

            Field::make('complex', 'crb_section_slider', 'Slider')->add_fields(array(
                Field::make('image', 'crb_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
                Field::make('text', 'crb_section_slide_title', 'Title')->set_width('25'),
                Field::make('textarea', 'crb_section_slide_desc', 'Small Description')->set_width('55'),
            )),
        )),
    ));
//Page Heading
Container::make('post_meta', 'Page Heading')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-roomlisting.php','template-room.php'))
    ->add_fields(array(
        Field::make('text', 'crb_page_heading' , ''),
    ));

//Page Heading
Container::make('post_meta', 'Short Description')
    ->show_on_post_type('hotel')
    ->add_fields(array(
        Field::make('textarea', 'crb_short_description' , ''),
    ));

//Images Slider
Container::make('post_meta', 'Slider Images')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-hotel.php','template-room.php','template-restaurant.php','template-facilities.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', '')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Slide Image')->help_text('(Image Dimensions (WxH): 1240 x 600)'),
        )),
    ));
    
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-room.php'))
    ->add_fields(array(
        Field::make('text', 'crb_slider_bottom_heading' , 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).')->set_width('30'),
        Field::make('textarea', 'crb_slider_bottom_description' , 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).')->set_width('70'),
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
        /*Field::make('complex', 'crb_rates', '')->add_fields(array(*/
             Field::make('text', 'crb_rate_amount' , 'Amount')->help_text('Example: R9000.00')->set_width(20),
             Field::make('text', 'crb_rate_for' , 'For')->set_default_value('per room/per night')->set_width(80)->help_text('Example: per room/per night'),
             Field::make('text', 'crb_booking_buton_text' , 'Booking Button Text')->set_default_value('Book')->set_width(20),
             Field::make('text', 'crb_booking_buton_link' , 'Booking Button Link')->set_width(80),
        /*)),*/
    ));

//Special Features
Container::make('post_meta', 'Special Features')
    ->show_on_post_type('hotel')
    ->show_on_template('template-room.php')
    ->add_fields(array(
        /*Field::make('complex', 'crb_special_features', '')->add_fields(array(*/
             Field::make('textarea', 'crb_special_feature' , ''),
        /*)),*/
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
        Field::make('textarea', 'crb_policy' , 'Policy'),
    ));


//Hours & Reservations
Container::make('post_meta', 'Facilities')
    ->show_on_post_type('hotel')
    ->show_on_template('template-facilities.php')
    ->add_fields(array(
        Field::make('complex', 'crb_facilities_section', '')->add_fields(array(
            Field::make('text', 'crb_facilities_heading' , 'Heading')->set_width('40'),
            Field::make('complex', 'crb_facilities', '')->add_fields(array(
                Field::make('text', 'crb_facility' , 'Facility'),
            ))->set_width('60'),
        )),
    ));


/*

//Slider Info


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
*/