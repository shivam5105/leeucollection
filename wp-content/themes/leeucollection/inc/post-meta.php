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
            Field::make('text', 'crb_section_heading', 'Heading'),

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
            Field::make('text', 'crb_section_link_text', 'View All Link Text')->set_width('40')->help_text('This will come on the right-top cornor of section.')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_section_show_link',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('text', 'crb_section_link', 'View All Link')->set_width('40')->set_conditional_logic(array(
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
        Field::make('text', 'crb_page_heading', ''),
    ));

//Page Heading
Container::make('post_meta', 'Short Description')
    ->show_on_post_type('hotel')
    ->add_fields(array(
        Field::make('textarea', 'crb_short_description', ''),
    ));

//Images Slider
Container::make('post_meta', 'Slider Images')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-hotel.php','template-room.php','template-restaurant.php','template-facilities.php','template-gym.php','template-spa-wellness.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', '')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Slide Image')->help_text('(Image Dimensions (WxH): 1240 x 600)'),
        )),
    ));
    
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-room.php','template-gym.php'))
    ->add_fields(array(
        Field::make('text', 'crb_slider_bottom_heading', 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).')->set_width('30'),
        Field::make('textarea', 'crb_slider_bottom_description', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).')->set_width('70'),
    ));

//Slider Info
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('textarea', 'crb_slider_bottom_description', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).'),
        Field::make('text', 'crb_booking_buton_text', 'Booking Button Text')->set_width(20)->set_default_value('Book'),
        Field::make('text', 'crb_booking_buton_link', "Book A Table - 'connectionid'")->set_width(80),
    ));

//Room Rates
Container::make('post_meta', 'Room Rates')
    ->show_on_post_type('hotel')
    ->show_on_template('template-room.php')
    ->add_fields(array(
        /*Field::make('complex', 'crb_rates', '')->add_fields(array(*/
             Field::make('text', 'crb_rate_amount', 'Amount')->help_text('Example: R9000.00')->set_width(20),
             Field::make('text', 'crb_rate_for', 'For')->set_default_value('per room/per night')->set_width(80)->help_text('Example: per room/per night'),
             Field::make('text', 'crb_booking_buton_text', 'Booking Button Text')->set_default_value('Book')->set_width(20),
             Field::make('text', 'crb_booking_buton_link', 'Booking Button Link')->set_width(80),
        /*)),*/
    ));

//Special Features
Container::make('post_meta', 'Special Features')
    ->show_on_post_type('hotel')
    ->show_on_template('template-room.php')
    ->add_fields(array(
        /*Field::make('complex', 'crb_special_features', '')->add_fields(array(*/
             Field::make('textarea', 'crb_special_feature', ''),
        /*)),*/
    ));

//Hours & Reservations
Container::make('post_meta', 'Hours & Reservations')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('complex', 'crb_hours_reservations', '')->add_fields(array(
             Field::make('text', 'crb_reservation_for', 'Reservation For')->set_width(30),
             Field::make('textarea', 'crb_reservation_time', 'Reservation Time')->set_width(70),
        )),
    ));

//Policy
Container::make('post_meta', 'Policy')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('textarea', 'crb_policy', 'Policy'),
    ));


//Hours & Reservations
Container::make('post_meta', 'Facilities')
    ->show_on_post_type('hotel')
    ->show_on_template('template-facilities.php')
    ->add_fields(array(
        Field::make('complex', 'crb_facilities_section', '')->add_fields(array(
            Field::make('text', 'crb_facilities_heading', 'Heading')->set_width('40'),
            Field::make('complex', 'crb_facilities', '')->add_fields(array(
                Field::make('text', 'crb_facility', 'Facility'),
            ))->set_width('60'),
        )),
    ));


//Rates
Container::make('post_meta', 'Rates')
    ->show_on_post_type('hotel')
    ->show_on_template('template-gym.php')
    ->add_fields(array(
        Field::make('complex', 'crb_rates_section', '')->add_fields(array(
            Field::make('text', 'crb_rate_amount', 'Amount')->help_text('Example: R900.00')->set_width(15),
            Field::make('text', 'crb_rate_for', 'For')->set_width(20)->help_text('Example: per hour/individual'),
            Field::make('rich_text', 'crb_rate_details', 'Details')->set_width(65),
        )),
    ));

//Book Button
Container::make('post_meta', 'Book Button')
    ->show_on_post_type('hotel')
    ->show_on_template('template-gym.php')
    ->add_fields(array(
        Field::make('text', 'crb_booking_buton_text', 'Booking Button Text')->set_width(20)->set_default_value('Reserve'),
        Field::make('text', 'crb_booking_buton_link', 'Booking Button Link')->set_width(80),
    ));

//Page Sub-Heading
Container::make('post_meta', 'Page Sub-Heading')
    ->show_on_post_type('hotel')
    ->show_on_template('template-spa-treatments.php')
    ->add_fields(array(
        Field::make('text', 'crb_page_sub_heading', ''),
    ));

//Services
Container::make('post_meta', 'Services')
    ->show_on_post_type('hotel')
    ->show_on_template('template-spa-treatments.php')
    ->add_fields(array(
        Field::make('complex', 'crb_services_sections', '')->add_fields(array(
            Field::make('text', 'crb_service_heading', 'Service Heading')->set_width(50),
            Field::make('text', 'crb_service_duration', 'Service Duration')->set_width(50),

            Field::make('complex', 'crb_services', '')->add_fields(array(
                Field::make('text', 'crb_service_price', 'Service Price')->set_width(30),
                Field::make('rich_text', 'crb_service_details', 'Details')->set_width(70),
            )),
        )),
    ));

//Content Section Spa & Wellness Page
Container::make('post_meta', 'Content Section')
    ->show_on_post_type('hotel')
    ->show_on_template('template-spa-wellness.php')
    ->add_fields(array(
        Field::make('complex', 'crb_spa_content_section', '')->add_fields(array(

            Field::make('text', 'crb_spa_section_slide_title', 'Title')->set_width('30'),
            Field::make('textarea', 'crb_spa_section_slide_desc', 'Small Description')->set_width('70'),

            Field::make('text', 'crb_spa_section_link_text', 'View All Link Text')->set_width('30'),
            Field::make('text', 'crb_spa_section_link', 'View All Link')->set_width('70'),

            Field::make('complex', 'crb_spa_section_slider', 'Slider')->add_fields(array(
                Field::make('image', 'crb_spa_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
            )),
        )),
    ));

//Home Page && Hotel Listing
Container::make('post_meta', 'Header Slider')
    ->show_on_post_type('page')
    ->show_on_template(array('front-page.php', 'template-hotel-listing.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_header_images', '')->add_fields(array(
            Field::make('image', 'crb_header_image', 'Header Image')->help_text('(Image Dimensions (WxH): 1240 x 600)'),
            Field::make('textarea', 'crb_header_heading', 'Heading')->set_width('50'),
            Field::make('textarea', 'crb_header_description', 'Description')->set_width('50'),
            Field::make('text', 'crb_header_button_text', 'Button Text')->set_width('50'),
            Field::make('text', 'crb_header_button_link', 'Button Link')->set_width('50'),
            Field::make('radio', 'crb_header_text_position', 'Header Text Position')
                ->add_options(array(
                    'top-position'      => 'Top Position',
                    'center-position'   => 'Center Position',
                    'bottom-position'   => 'Bottom Position',
               ))->set_default_value('top-position'),
        )),
    ));
    
//Home Page - Hotels
Container::make('post_meta', 'Hotels')
    ->show_on_post_type('page')
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make('text', 'crb_hotel_section_heading', 'Heading'),

        Field::make('complex', 'crb_home_hotels', '')->add_fields(array(
            Field::make('text', 'crb_hotel_locations', 'Hotel Location'),
            Field::make('complex', 'crb_home_hotels', '')->add_fields(array(
                Field::make('text', 'crb_hotel_name', 'Hotel Name'),
                Field::make('image', 'crb_hotel_logo', 'Hotel Logo Image')->set_width('50'),            
                Field::make('image', 'crb_hotel_image', 'Hotel Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
                Field::make('textarea', 'crb_hotel_description', 'Short Description'),
                Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
                Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
                Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
                Field::make('text', 'crb_booking_button_link', 'Booking Button Link')->set_width('50'),
            )),
        )),
    ));

//Home Page - Restaurants
Container::make('post_meta', 'Restaurants')
    ->show_on_post_type('page')
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make('text', 'crb_restaurant_section_heading', 'Heading'),

        Field::make('complex', 'crb_home_restaurants', '')->add_fields(array(
            Field::make('text', 'crb_restaurant_name', 'Restaurant Name'),
            Field::make('image', 'crb_restaurant_logo', 'Restaurant Logo Image')->set_width('50'),            
            Field::make('image', 'crb_restaurant_image', 'Restaurant Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
            Field::make('textarea', 'crb_restaurant_description', 'Short Description'),
            Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
            Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
            Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
            Field::make('text', 'crb_booking_button_link', "Book A Table - 'connectionid'")->set_width('50'),
        )),
    ));

//Home Page - Two Columns Section 1
Container::make('post_meta', 'Two Columns Section 1')
    ->show_on_post_type('page')
    ->show_on_template(array('front-page.php'))

    ->add_fields(array(
        Field::make("html", "crb_two_cols_section_1_info_text_left")->set_html('<h2>Left Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_1_heading_left', 'Heading'),
        Field::make('image', 'crb_two_cols_section_1_image_left', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_1_description_left', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_text_left', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_link_left', 'Detail Button Link')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_booking_button_text_left', 'Booking Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_booking_button_link_left', 'Booking Button Link')->set_width('50'),

        Field::make("html", "crb_two_cols_section_1_info_text_right")->set_html('<h2>Right Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_1_heading_right', 'Heading'),
        Field::make('image', 'crb_two_cols_section_1_image_right', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_1_description_right', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_text_right', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_link_right', 'Detail Button Link')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_booking_button_text_right', 'Booking Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_booking_button_link_right', 'Booking Button Link')->set_width('50'),
    ));

//Home Page - Wine
Container::make('post_meta', 'Wine')
    ->show_on_post_type('page')
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make('text', 'crb_wine_section_heading', 'Heading'),

        Field::make('complex', 'crb_home_wines', '')->add_fields(array(
            Field::make('text', 'crb_wine_name', 'Wine Name'),        
            Field::make('image', 'crb_wine_image', 'Wine Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
            Field::make('textarea', 'crb_wine_description', 'Short Description')->set_width('50'),
            Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
            Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
            Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
            Field::make('text', 'crb_booking_button_link', 'Booking Button Link')->set_width('50'),
        )),

        Field::make('complex', 'crb_wines_section_bottom_links', 'Bottom Links')->add_fields(array(
            Field::make('text', 'crb_button_text', 'Button Text')->set_width('50'),
            Field::make('text', 'crb_button_link', 'Button Link')->set_width('50'),
        )),
    ));

//Home Page - Two Columns Section 2
Container::make('post_meta', 'Two Columns Section 2')
    ->show_on_post_type('page')
    ->show_on_template(array('front-page.php'))

    ->add_fields(array(
        Field::make("html", "crb_two_cols_section_2_info_text_left")->set_html('<h2>Left Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_2_heading_left', 'Heading'),
        Field::make('image', 'crb_two_cols_section_2_image_left', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_2_description_left', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_text_left', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_link_left', 'Detail Button Link')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_booking_button_text_left', 'Booking Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_booking_button_link_left', 'Booking Button Link')->set_width('50'),

        Field::make("html", "crb_two_cols_section_2_info_text_right")->set_html('<h2>Right Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_2_heading_right', 'Heading'),
        Field::make('image', 'crb_two_cols_section_2_image_right', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_2_description_right', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_text_right', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_link_right', 'Detail Button Link')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_booking_button_text_right', 'Booking Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_booking_button_link_right', 'Booking Button Link')->set_width('50'),
    ));

//Home Page - Hotels
Container::make('post_meta', 'Hotels Details')
    ->show_on_post_type('page')
    ->show_on_template(array('template-hotel-listing.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_hotel_sections', '')->add_fields(array(
            Field::make('text', 'crb_hotel_name', 'Hotel Name'),

            Field::make('complex', 'crb_hotel_hotels', '')->add_fields(array(
                Field::make('text', 'crb_hotel_locations', 'Hotel Location'),
                Field::make('complex', 'crb_hotel_section_details', 'Section Details')->add_fields(array(
                    Field::make('text', 'crb_hotel_section_name', 'Section Name'),
                    Field::make('image', 'crb_hotel_section_logo', 'Hotel/Section Logo Image')->set_width('50'),            
                    Field::make('image', 'crb_hotel_section_image', 'Section Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
                    Field::make('textarea', 'crb_hotel_section_description', 'Short Description'),
                    Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
                    Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
                    Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
                    Field::make('text', 'crb_booking_button_link', "Book A Table - 'connectionid'")->set_width('50'),
                )),
            )),
        )),
    ));

//Menu
Container::make('post_meta', 'Menu')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-menudetail.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_menus', '')->add_fields(array(
            Field::make('text', 'crb_menu_heading', 'Menu Heading'),
            Field::make('complex', 'crb_menu_item_details', 'Menu Items')->add_fields(array(
                Field::make('text', 'crb_menu_item_name', 'Item Name')->set_width('50'),
                Field::make('text', 'crb_menu_item_price', 'Item Price')->set_width('50'),
            )),
        )),

    ));
/*

//Slider Info


//The Chef
Container::make('post_meta', 'The Chef Section')
    ->show_on_post_type('hotel')
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('text', 'crb_chef_section_heading', 'Section Heading'),
        Field::make('complex', 'crb_chef_section_info', '')->add_fields(array(
            Field::make('image', 'crb_chef_image', 'Chef Image')->set_width(20)->help_text('(Image Dimensions (WxH): w x h)'),
            Field::make('textarea', 'crb_chef_description', 'Chef Description')->set_width(80),
        )),
    ));
*/