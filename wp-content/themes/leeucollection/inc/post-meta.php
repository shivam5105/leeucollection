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
    ->show_on_template(array('template-roomlisting.php','template-room.php', 'template-explore.php'))
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
    ->show_on_post_type(array('hotel', 'leeu-discover','page'))
    ->show_on_template(array('template-hotel.php','template-room.php','template-restaurant.php','template-facilities.php','template-gym.php','template-spa-wellness.php','template-explore.php','template-artists-details.php', 'template-founder-and-team.php', 'template-location.php', 'template-work.php', 'template-hotel-wine.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', '')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Slide Image')->help_text('(Image Dimensions (WxH): 1240 x 600)'),
        )),
    ));
    
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type(array('hotel', 'leeu-discover', 'page'))
    ->show_on_template(array('template-room.php','template-gym.php', 'template-work.php', 'template-hotel-wine.php'))
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
    ->show_on_template(array('front-page.php', 'template-hotel-listing.php' , 'template-restaurantlisting.php','template-discover.php'))
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
                Field::make('image', 'crb_hotel_image', 'Hotel Image')->help_text('(Image Dimensions (WxH): 925 x 600)')->set_width('50'),
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
            Field::make('image', 'crb_restaurant_image', 'Restaurant Image')->help_text('(Image Dimensions (WxH): 925 x 600)')->set_width('50'),
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
/*
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
*/

//Home Page - Hotels
Container::make('post_meta', 'Hotels Details')
    ->show_on_post_type('page')
    ->show_on_template(array('template-hotel-listing.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_hotel_sections_new', '')->add_fields(array(
            Field::make('text', 'crb_hotel_name', 'Hotel Name'),
            Field::make('image', 'crb_hotel_section_logo', 'Hotel Logo Image')->set_width('50'),
            Field::make('textarea', 'crb_hotel_section_description', 'Short Description')->set_width('50'),
            Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
            Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
            Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
            Field::make('text', 'crb_booking_button_link', "Booking Button Link")->set_width('50'),

            Field::make('complex', 'crb_hotel_section_details', 'Section Links Details')->add_fields(array(
                Field::make('text', 'crb_hotel_locations', 'Hotel Location'),
                Field::make('complex', 'crb_hotel_section_link_details', 'Section Links')->add_fields(array(
                    Field::make('text', 'crb_hotel_section_name', 'Section Name')->set_width('50'),
                    Field::make('text', 'crb_hotel_section_link', 'Section Link')->set_width('50'),
                )),
            )),
            Field::make('complex', 'crb_hotel_section_slider', 'Slider Images')->add_fields(array(
                Field::make('image', 'crb_hotel_section_image', 'Section Image')->help_text('(Image Dimensions (WxH): 925 x 600)'),
            )),
        )),
    ));

//Restaurant listing
Container::make('post_meta', 'Restaurant Details')
    ->show_on_post_type('page')
    ->show_on_template(array('template-restaurantlisting.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_res_sections_new', '')->add_fields(array(
            Field::make('text', 'crb_res_name', 'Restaurant Name'),
            Field::make('image', 'crb_res_section_logo', 'Restaurant Logo Image')->set_width('50'),
            Field::make('textarea', 'crb_res_section_description', 'Short Description')->set_width('50'),
            Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
            Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
            Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
            Field::make('text', 'crb_booking_button_link', "Booking Button Link")->set_width('50'),

            Field::make('complex', 'crb_res_section_details', 'Section Links Details')->add_fields(array(
                Field::make('text', 'crb_res_locations', 'Restaurant Location'),
                Field::make('complex', 'crb_res_section_link_details', 'Section Links')->add_fields(array(
                    Field::make('text', 'crb_res_section_name', 'Section Name')->set_width('50'),
                    Field::make('text', 'crb_res_section_link', 'Section Link')->set_width('50'),
                )),
            )),
            Field::make('complex', 'crb_res_section_slider', 'Slider Images')->add_fields(array(
                Field::make('image', 'crb_res_section_image', 'Section Image')->help_text('(Image Dimensions (WxH): 925 x 600)'),
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
//Explore
Container::make('post_meta', 'Instagram Feed Details')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-explore.php'))
    ->add_fields(array(
        Field::make('text', 'crb_explore_instagram_heading', 'Heading'),
        Field::make('text', 'crb_explore_instagram_limit', 'Limit Feeds')->set_width('20'),
        Field::make('text', 'crb_explore_instagram_userid', 'Instagram User-ID')->set_width('30'),
        Field::make('text', 'crb_explore_instagram_access_token', 'Instagram Access Token')->set_width('50'),
    ));

Container::make('post_meta', 'Slider Bottom Info')
    ->show_on_post_type('leeu-discover')
    ->show_on_template(array('template-artists-details.php'))
    ->add_fields(array(
        Field::make('text', 'crb_slider_bottom_heading_1', 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).')->set_width('20'),
        Field::make('text', 'crb_slider_bottom_sub_heading_1', 'Slider Sub-Heading')->help_text('This will come under "Slider Heading".')->set_width('20'),
        Field::make('textarea', 'crb_slider_bottom_description_1', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).')->set_width('60'),
    ));

//Maps image & link
Container::make('post_meta', 'Small Map')
    ->show_on_post_type(array('leeu-discover', 'hotel', 'page'))
    ->show_on_template(array('template-artists-details.php', 'template-hotel-wine.php'))
    ->add_fields(array(
        Field::make('text', 'crb_small_map_heading', 'Map Heading')->set_width('30'),
        Field::make('text', 'crb_small_map_link', 'Map Link')->set_width('40'),
        Field::make('image', 'crb_small_map_image', 'Map Image')->help_text('(Image Dimensions (WxH): 193 x 129)')->set_width('30'),
    ));

Container::make('post_meta', 'Page Small Heading')
    ->show_on_post_type(array('leeu-discover','page'))
    ->show_on_template(array('template-founder-and-team.php', 'template-accolades.php'))
    ->add_fields(array(
        Field::make('text', 'crb_page_small_heading', 'Page Small Heading (Overwrite Default Heading)'),
    ));

//Founder & Team Page
Container::make('post_meta', 'Founder & Team')
    ->show_on_post_type('leeu-discover')
    ->show_on_template(array('template-founder-and-team.php'))
    ->add_fields(array(
        Field::make('text', 'crb_founder_name', 'Founder Name')->set_width('50'),
        Field::make('text', 'crb_text_under_founder_name', 'Text Under Founder Name')->set_width('50'),
        Field::make('textarea', 'crb_founder_description_left', 'Description (Left)')->set_width('50'),
        Field::make('textarea', 'crb_founder_description_right', 'Description (Right)')->set_width('50'),
        Field::make('text', 'crb_team_heading', 'Team Heading'),
        Field::make('complex', 'crb_team_details', 'Team Details')->add_fields(array(
            Field::make('text', 'crb_member_name', 'Team Member Name')->set_width('50'),
            Field::make('image', 'crb_member_image', 'Team Member Image')->help_text('(Image Dimensions (WxH): 411 x 258)')->set_width('50'),
        )),
    ));

//Location Detail Page
Container::make('post_meta', 'Location Page Content')
    ->show_on_post_type('leeu-discover')
    ->show_on_template(array('template-location.php'))
    ->add_fields(array(
        Field::make('text', 'crb_page_country', 'Country Name'),
        Field::make('complex', 'crb_location_sections', 'Content Sections')->add_fields(array(
            Field::make('text', 'crb_section_heading', 'Section Heading')->set_width('50'),
            Field::make('complex', 'crb_section_slider', 'Section Slider')->add_fields(array(
                Field::make('image', 'crb_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('50'),
            )),

            Field::make('radio', 'crb_section_show_links', 'Show Links?')
                ->add_options(array(
                    'yes' => 'Yes',
                    'no' => 'No',
                ))->set_default_value('no'),

            Field::make('text', 'crb_section_sub_heading', 'Slider Bottom Heading')->set_width('50')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_section_show_links',
                    'value' => 'no', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('textarea', 'crb_section_description', 'Slider Bottom Description')->set_width('50'),

            Field::make('complex', 'crb_section_links_details', 'Section Links Details')->add_fields(array(
                Field::make('text', 'crb_link_text', 'Link Text')->set_width('50'),
                Field::make('text', 'crb_link_url', 'Link Url')->set_width('50'),
            ))->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_section_show_links',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),

        )),
    ));

Container::make('post_meta', 'Accolades')
    ->show_on_post_type('page')
    ->show_on_template(array('template-accolades.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_accolades', 'Accolades')->add_fields(array(
            Field::make('complex', 'crb_accolade_images', 'Accolade Images')->add_fields(array(
                Field::make('image', 'crb_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)'),
            )),
            Field::make('text', 'crb_accolade_title', 'Accolade Title')->set_width('50'),
            Field::make('text', 'crb_accolade_link_text', 'Accolade Link Text')->set_width('20'),
            Field::make('text', 'crb_accolade_link', 'Accolade Link')->set_width('30'),
        )),
    ));

Container::make('post_meta', 'Slider')
    ->show_on_post_type('hotel')
    ->show_on_template(array('template-meetings-events.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_section_slider', 'Slider')->add_fields(array(
            Field::make('image', 'crb_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
            Field::make('textarea', 'crb_section_slide_title', 'Title')->set_width('25'),
            Field::make('textarea', 'crb_section_slide_desc', 'Small Description')->set_width('55'),
        )),
        Field::make('text', 'crb_form_heading', 'Form Heading'),
    ));

Container::make('post_meta', 'Restaurant Details')
    ->show_on_post_type('leeu-restaurants')
    ->add_fields(array(
        Field::make('text', 'crb_restaurant_location_popup', 'Location (for Popup)')->help_text('(This will come next to restaurant name in booking popup)'),
        Field::make('text', 'crb_booking_buton_link', "Book A Table - 'connectionid'"),
    ));

//Discover Page - Content Section
Container::make('post_meta', 'Content Section')
    ->show_on_post_type('page')
    ->show_on_template(array('template-discover.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_page_content_section', '')->add_fields(array(
            Field::make('text', 'crb_page_section_heading', 'Heading'),
            Field::make('complex', 'crb_section_detail', '')->add_fields(array(
                Field::make('text', 'crb_page_name', 'Section Name'),
                Field::make('image', 'crb_page_logo', 'Section Logo Image')->set_width('50'),            
                Field::make('image', 'crb_page_image', 'Section Image')->help_text('(Image Dimensions (WxH): 925 x 600)')->set_width('50'),
                Field::make('textarea', 'crb_page_description', 'Short Description'),
                Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
                Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
                Field::make('text', 'crb_booking_button_text', 'Booking Button Text')->set_width('50'),
                Field::make('text', 'crb_booking_button_link', "Book A Table - 'connectionid'")->set_width('50'),
            )),
        )),
    ));

/* The Works page */
Container::make('post_meta', 'Artists')
    ->show_on_post_type(array('leeu-discover'))
    ->show_on_template(array('template-work.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_artists_details', '')->add_fields(array(
            Field::make('image', 'crb_artist_image', 'Team Member Image')->help_text('(Image Dimensions (WxH): 411 x 258)')->set_width('25'),
            Field::make('text', 'crb_artist_name', 'Artist Name')->set_width('25'),
            Field::make('date', 'crb_artist_date', 'Date')->set_width('25'),
            Field::make('text', 'crb_artist_location', 'Location')->set_width('25'),
        )),
    ));


//Content Section Wine
Container::make('post_meta', 'Content Section')
    ->show_on_post_type(array('hotel', 'page'))
    ->show_on_template('template-hotel-wine.php')
    ->add_fields(array(
        Field::make('complex', 'crb_content_section1', '')->add_fields(array(
            Field::make('text', 'crb_section_heading', 'Heading'),

            Field::make('complex', 'crb_section_slider', 'Slider')->add_fields(array(
                Field::make('text', 'crb_section_slide_title', 'Title')->set_width('30'),
                Field::make('textarea', 'crb_section_slide_desc', 'Small Description')->set_width('70'),

                Field::make('text', 'crb_section_link_text', 'View All Link Text')->set_width('30'),
                Field::make('text', 'crb_section_link', 'View All Link')->set_width('70'),
                Field::make('image', 'crb_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
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