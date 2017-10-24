<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

$leeu_post_types = array('hotel', 'leeu-discover', 'leeu-restaurants', 'leeu-wine', 'page', 'leeu-artisan-drinks', 'leeu-press');

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
        Field::make('text', 'nav_menu_sub_heading', 'Menu Sub-Heading'),
        Field::make('image', 'nav_menu_image', 'Menu Image')->help_text('(Image Dimensions (WxH): 380 x 240)'),
    ));

//Left Nav Image
Container::make('post_meta', 'Left Menu Image')
    ->show_on_post_type($leeu_post_types)
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
                Field::make('text', 'crb_section_slide_link', 'Link'),
            )),
        )),
    ));
//Page Heading
Container::make('post_meta', 'Page Heading')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-roomlisting.php','template-room.php', 'template-explore.php'))
    ->add_fields(array(
        Field::make('text', 'crb_page_heading', ''),
    ));

//Page Heading
Container::make('post_meta', 'Short Description')
    ->show_on_post_type($leeu_post_types)
    ->add_fields(array(
        Field::make('textarea', 'crb_short_description', ''),
    ));

//Images Slider
Container::make('post_meta', 'Slider Images')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-hotel.php','template-room.php','template-restaurant.php','template-facilities.php','template-gym.php','template-spa-wellness.php','template-explore.php', 'template-founder-and-team.php', 'template-location.php', 'template-work.php', 'template-hotel-wine.php','template-section-slider-with-header-banner.php','template-contact.php', 'template-meetings-events.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', '')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Slide Image')->help_text('(Image Dimensions (WxH): 1240 x 600)'),
        )),
    ));
 
 // artist detail
 Container::make('post_meta', 'Slider')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-artists-details.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_slider_images', '')->add_fields(array(
            Field::make('image', 'crb_slide_image', 'Slide Image')->help_text('(Image Dimensions (WxH): 1240 x 600)'),
            Field::make('text', 'crb_slider_bottom_heading', 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).')->set_width('20'),
            Field::make('text', 'crb_slider_bottom_sub_heading', 'Slider Sub-Heading')->help_text('This will come under "Slider Heading".')->set_width('20'),
            Field::make('textarea', 'crb_slider_bottom_description', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).')->set_width('60'),
        )),
    ));   

Container::make('post_meta', 'Slider Info')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-room.php','template-gym.php', 'template-work.php', 'template-hotel-wine.php'))
    ->add_fields(array(
        Field::make('text', 'crb_slider_bottom_heading', 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).')->set_width('30'),
        Field::make('textarea', 'crb_slider_bottom_description', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).')->set_width('70'),
    ));

//Slider Info
Container::make('post_meta', 'Slider Info')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('textarea', 'crb_slider_bottom_description', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).'),
        Field::make('text', 'crb_booking_buton_text', 'Booking Button Text')->set_width(20)->set_default_value('Book'),
        Field::make('text', 'crb_booking_buton_link', "Book A Table - 'connectionid'")->set_width(80),
    ));

//Room Rates
Container::make('post_meta', 'Room Rates')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-room.php')
    ->add_fields(array(
        /*Field::make('complex', 'crb_rates', '')->add_fields(array(*/
            Field::make('text', 'crb_rate_amount', 'Amount')->help_text('Example: R9000.00')->set_width(20),
            Field::make('text', 'crb_rate_for', 'For')->set_default_value('per room/per night')->set_width(80)->help_text('Example: per room/per night'),
            /*Field::make('text', 'crb_booking_buton_text', 'Booking Button Text')->set_default_value('Book')->set_width(20),
            Field::make('text', 'crb_booking_buton_link', 'Booking Button Link')->set_width(80),*/
            Field::make('radio', 'crb_show_booking_button', 'Show Booking Button?')
                ->add_options(array(
                    'yes' => 'Yes',
                    'no' => 'No',
            ))->set_default_value('no'),
        /*)),*/
    ));

//Special Features
Container::make('post_meta', 'Special Features')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-room.php')
    ->add_fields(array(
        /*Field::make('complex', 'crb_special_features', '')->add_fields(array(*/
             Field::make('textarea', 'crb_special_feature', 'Left special features'),
             Field::make('textarea', 'crb_special_feature_second', 'Right special features'),
        /*)),*/
    ));

//Room Gallery
Container::make('post_meta', 'Gallery')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-room.php')
    ->add_fields(array(
        Field::make('image', 'crb_gallery_thumbnail', 'Gallery Thumbnail Image')->set_width(30),
        Field::make('text', 'crb_gallery_main_title', 'Main Title')->set_width(70),
        Field::make('complex', 'crb_room_gallery', '')->add_fields(array(
            Field::make('image', 'crb_gallery_image', 'Gallery Image')->set_width(30),
            //Field::make('text', 'crb_gallery_caption', 'Caption')->set_width(70),
        )),
    ));

//Room Video
Container::make('post_meta', 'Video')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-room.php')
    ->add_fields(array(
        Field::make('image', 'crb_video_thumbnail', 'Video Thumbnail Image')->set_width(30),
        Field::make('text', 'crb_video_main_title', 'Main Title')->set_width(70),
        Field::make('complex', 'crb_room_video', '')->add_fields(array(
            Field::make('text', 'crb_room_video', 'Youtube Video Link')->set_width(30),
            //Field::make('text', 'crb_room_caption', 'Caption')->set_width(70),
        )),
    ));

//Room Floor Layout
Container::make('post_meta', 'Floor Layout')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-room.php')
    ->add_fields(array(
        Field::make('image', 'crb_floor_thumbnail', 'Floor Thumbnail Image')->set_width(30),
        Field::make('text', 'crb_floor_main_title', 'Main Title')->set_width(70),
        Field::make('complex', 'crb_room_floor_layout', '')->add_fields(array(
            Field::make('image', 'crb_floor_image', 'Floor Layout Image')->set_width(30),
            //Field::make('text', 'crb_floor_caption', 'Caption')->set_width(70),
        )),
    ));

//Hours & Reservations
Container::make('post_meta', 'Hours & Reservations')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('complex', 'crb_hours_reservations', '')->add_fields(array(
             Field::make('text', 'crb_reservation_for', 'Reservation For')->set_width(30),
             Field::make('textarea', 'crb_reservation_time', 'Reservation Time')->set_width(70),
        )),
    ));

//Policy
Container::make('post_meta', 'Policy')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('textarea', 'crb_policy', 'Policy'),
    ));


//Hours & Reservations
Container::make('post_meta', 'Facilities')
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-gym.php')
    ->add_fields(array(
        Field::make('text', 'crb_booking_buton_text', 'Booking Button Text')->set_width(20)->set_default_value('Reserve'),
        Field::make('text', 'crb_booking_buton_link', 'Booking Button Link')->set_width(80),
    ));

//Services
Container::make('post_meta', 'Services')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-spa-treatments.php')
    ->add_fields(array(
        Field::make('complex', 'crb_services_sections_group', '')->add_fields(array(
            Field::make('text', 'crb_service_main_heading', 'Service Group Heading'),
            Field::make('complex', 'crb_services_sections', '')->add_fields(array(
                Field::make('radio', 'crb_remove_bottom_margin', 'Remove Bottom Margin?')
                    ->add_options(array(
                        'yes' => 'Yes',
                        'no' => 'No',
                   ))->set_default_value('no')->set_width(20),
                Field::make('text', 'crb_service_heading', 'Service Heading')->set_width(50),
                Field::make('text', 'crb_service_duration', 'Service Duration')->set_width(30),

                Field::make('complex', 'crb_services', '')->add_fields(array(
                    Field::make('text', 'crb_service_price', 'Service Price')->set_width(30),
                    Field::make('rich_text', 'crb_service_details', 'Details')->set_width(70),
                )),
            )),
        )),
    ));

//Contact Page
Container::make('post_meta', 'Contact')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-contact.php')
    ->add_fields(array(
        Field::make('complex', 'crb_contact_sections', '')->add_fields(array(
            Field::make('text', 'crb_contact_heading', 'Location'),
            Field::make('complex', 'crb_contact_detail', '')->add_fields(array(
                Field::make('textarea', 'crb_contact_address', 'Address')->set_width('30'),
                Field::make('text', 'crb_contact_phone', 'Phone')->set_width('20'),
                Field::make('text', 'crb_contact_fax', 'Fax')->set_width('20'),
                Field::make('text', 'crb_contact_email', 'Email')->set_width('30'),
            )),
        )),
    ));

//Content Section Spa & Wellness Page
Container::make('post_meta', 'Content Section')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-spa-wellness.php'))
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

//Content Section Spa & Wellness Page
Container::make('post_meta', 'Content Section')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-guest-area.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_guest_content_section', '')->add_fields(array(

            Field::make('complex', 'crb_guest_section_slider', 'Slider')->add_fields(array(
              Field::make('image', 'crb_guest_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
            )),
            Field::make('text', 'crb_guest_section_slide_title', 'Title')->set_width('30'),
            Field::make('textarea', 'crb_guest_section_slide_desc', 'Small Description')->set_width('70'),
            
        )),
    ));

//Home Page && Hotel Listing
Container::make('post_meta', 'Header Slider')
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
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
            )),
        )),
    ));   

//Home Page - Page About
Container::make('post_meta', 'Page About')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make('textarea', 'crb_page_about', 'Page About'),
    ));

//Home Page - Restaurants
Container::make('post_meta', 'Restaurants')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make('text', 'crb_restaurant_section_heading', 'Heading'),
        Field::make('complex', 'crb_home_restaurants', '')->add_fields(array(
          Field::make('text', 'crb_restaurant_locations', 'Restaurant Location'),
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
       )),
    ));

//Home Page - Two Columns Section 1
Container::make('post_meta', 'Two Columns Section 1')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make("html", "crb_two_cols_section_1_info_text_left")->set_html('<h2>Left Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_1_heading_left', 'Heading'),
        Field::make('image', 'crb_two_cols_section_1_image_left', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_1_description_left', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_text_left', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_link_left', 'Detail Button Link')->set_width('50'),

        Field::make("html", "crb_two_cols_section_1_info_text_right")->set_html('<h2>Right Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_1_heading_right', 'Heading'),
        Field::make('image', 'crb_two_cols_section_1_image_right', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_1_description_right', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_text_right', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_1_more_button_link_right', 'Detail Button Link')->set_width('50'),
    ));

//Home Page - Wine
Container::make('post_meta', 'Wine')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('front-page.php'))
    ->add_fields(array(
        Field::make('text', 'crb_wine_section_heading', 'Heading'),

        Field::make('complex', 'crb_home_wines', '')->add_fields(array(
            Field::make('text', 'crb_wine_name', 'Wine Name'),        
            Field::make('image', 'crb_wine_image', 'Wine Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
            Field::make('textarea', 'crb_wine_description', 'Short Description')->set_width('50'),
            Field::make('text', 'crb_more_button_text', 'Detail Button Text')->set_width('50'),
            Field::make('text', 'crb_more_button_link', 'Detail Button Link')->set_width('50'),
        )),

        Field::make('complex', 'crb_wines_section_bottom_links', 'Bottom Links')->add_fields(array(
            Field::make('text', 'crb_button_text', 'Button Text')->set_width('50'),
            Field::make('text', 'crb_button_link', 'Button Link')->set_width('50'),
        )),
    ));

//Home Page - Two Columns Section 2
Container::make('post_meta', 'Two Columns Section 2')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('front-page.php'))

    ->add_fields(array(
        Field::make("html", "crb_two_cols_section_2_info_text_left")->set_html('<h2>Left Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_2_heading_left', 'Heading'),
        Field::make('image', 'crb_two_cols_section_2_image_left', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_2_description_left', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_text_left', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_link_left', 'Detail Button Link')->set_width('50'),

        Field::make("html", "crb_two_cols_section_2_info_text_right")->set_html('<h2>Right Side Content</h2>'),

        Field::make('text', 'crb_two_cols_section_2_heading_right', 'Heading'),
        Field::make('image', 'crb_two_cols_section_2_image_right', 'Image')->help_text('(Image Dimensions (WxH): 1240 x 600)')->set_width('50'),
        Field::make('textarea', 'crb_two_cols_section_2_description_right', 'Short Description')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_text_right', 'Detail Button Text')->set_width('50'),
        Field::make('text', 'crb_two_cols_section_2_more_button_link_right', 'Detail Button Link')->set_width('50'),
    ));

//Home Page - Hotels
/*
Container::make('post_meta', 'Hotels Details')
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-restaurantlisting.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_res_sections_new', '')->add_fields(array(
            Field::make('text', 'crb_res_name', 'Restaurant Name'),
            Field::make('image', 'crb_res_section_logo', 'Restaurant Logo Image')->set_width('50'),
            Field::make('text', 'crb_res_sub_heading', 'Restaurant sub heading')->set_width('50'),
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
            ))      ,
            Field::make('complex', 'crb_res_section_slider', 'Slider Images')->add_fields(array(
                Field::make('image', 'crb_res_section_image', 'Section Image')->help_text('(Image Dimensions (WxH): 925 x 600)'),
            )),
        )),
    ));

//Restaurant artisan details
Container::make('post_meta', 'Half layout')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-hotel-listing.php' , 'template-restaurantlisting.php', 'template-facilities.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_half_layout', '')->add_fields(array(
            Field::make('text', 'crb_half_layout_main_title', 'Title'),

            Field::make('image', 'crb_half_layout_first_image', 'First image')->help_text('(Image Dimensions (WxH): 620 x 385)')->set_width('30'),
            Field::make('textarea', 'crb_half_layout_first_heading', 'Heading')->set_width('30'),
            Field::make('text', 'crb_half_layout_first_link', 'Link')->set_width('30'),

            Field::make('image', 'crb_half_layout_second_image', 'Image')->help_text('(Image Dimensions (WxH): 620 x 385)')->set_width('30'),
            Field::make('textarea', 'crb_half_layout_second_heading', 'Heading')->set_width('30'),
            Field::make('text', 'crb_half_layout_second_link', 'Link')->set_width('30'),
        )),
    ));

//Menu
Container::make('post_meta', 'Menu')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-menudetail.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_menus', '')->add_fields(array(
            Field::make('text', 'crb_menu_heading', 'Menu Heading'),
            Field::make('complex', 'crb_menu_item_details', 'Menu Items')->add_fields(array(
                Field::make('text', 'crb_menu_item_name', 'Item Name')->set_width('50'),
                Field::make('textarea', 'crb_menu_item_details', 'Item details')->set_width('50'),
                Field::make('text', 'crb_menu_item_price', 'Item Price')->set_width('50'),
            )),
        )),

    ));
//Explore
Container::make('post_meta', 'Instagram Feed Details')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-explore.php'))
    ->add_fields(array(
        Field::make('text', 'crb_explore_instagram_heading', 'Heading'),
        Field::make('text', 'crb_explore_instagram_limit', 'Limit Feeds')->set_width('10'),
        Field::make('text', 'crb_explore_instagram_userid', 'Instagram User-ID')->set_width('20'),
        Field::make('text', 'crb_explore_instagram_access_token', 'Instagram Access Token')->set_width('50'),
        Field::make('text', 'crb_explore_instagram_hash_tag', 'Hash Tag')->set_width('20')->help_text("Use only 1 Hash Tag (without # sign)."),
    ));

/*
Container::make('post_meta', 'Slider Bottom Info')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-artists-details.php'))
    ->add_fields(array(
        Field::make('text', 'crb_slider_bottom_heading_1', 'Slider Heading')->help_text('This will come after slider (on bottom-left of slider).')->set_width('20'),
        Field::make('text', 'crb_slider_bottom_sub_heading_1', 'Slider Sub-Heading')->help_text('This will come under "Slider Heading".')->set_width('20'),
        Field::make('textarea', 'crb_slider_bottom_description_1', 'Slider Description')->help_text('This will come after slider (on bottom-right of slider).')->set_width('60'),
    ));
*/
//Maps image & link
Container::make('post_meta', 'Small Map')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-artists-details.php', 'template-hotel-wine.php','template-location.php'))
    ->add_fields(array(
        Field::make('text', 'crb_small_map_heading', 'Map Heading')->set_width('50'),
        Field::make('image', 'crb_small_map_image', 'Map Image')->help_text('(Image Dimensions (WxH): 193 x 129)')->set_width('50'),

        Field::make('radio', 'crb_small_map_link_type', 'Read Locations From "CSV" File?')
                ->add_options(array(
                    'csv' => 'Yes',
                    'link' => 'No',
                ))->set_default_value('csv')->set_width('50')->help_text("'<b style=\"color:red\">google_map_data.csv</b>' file should be saved in current theme folder.<br />Fields should be in following order: <b style=\"color:red\">Title, Content, Lat, Long, Icon</b><br />Marker icons should be saved in <b style=\"color:red\">current theme >> 'images' >> 'google-map-icons'</b>"),

        Field::make('text', 'crb_small_map_link', 'Map Link')->set_width('50')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_small_map_link_type',
                    'value' => 'link', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
    ));

Container::make('post_meta', 'Page Small Heading')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-founder-and-team.php', 'template-news.php','template-artisan-drinks.php'))
    ->add_fields(array(
        Field::make('text', 'crb_page_small_heading', 'Page Small Heading (Overwrite Default Heading)'),
    ));

//Founder & Team Page
Container::make('post_meta', 'Founder & Team')
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
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

Container::make('post_meta', 'News')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-news.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_accolades', 'News')->add_fields(array(
            Field::make('complex', 'crb_accolade_images', 'News Images')->add_fields(array(
                Field::make('image', 'crb_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)'),
            )),
            Field::make('text', 'crb_accolade_title', 'News Title')->set_width('50'),
            Field::make('text', 'crb_accolade_link_text', 'News Link Text')->set_width('20'),
            Field::make('text', 'crb_accolade_link', 'News Link')->set_width('30'),
        )),
    ));

Container::make('post_meta', 'Slider')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-meetings-events.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_section_slider', 'Slider Section')->add_fields(array(
            Field::make('text', 'crb_section_slider_heading', 'Section Heading'),
            Field::make('complex', 'crb_slider', 'Slider')->add_fields(array(
                Field::make('image', 'crb_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
                Field::make('textarea', 'crb_section_slide_title', 'Title')->set_width('25'),
                Field::make('textarea', 'crb_section_slide_desc', 'Small Description')->set_width('55'),
            )),
        )),
    ));

Container::make('post_meta', 'Bottom Slider (2 Columns)')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-meetings-events.php'))
    ->add_fields(array(        
        Field::make('complex', 'crb_2_col_content_section', '')->add_fields(array(
            Field::make('text', 'crb_section_heading', 'Heading'),

            Field::make('complex', 'crb_section_slider', 'Slider')->add_fields(array(
                Field::make('image', 'crb_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
                Field::make('text', 'crb_section_slide_title', 'Title')->set_width('30'),
                Field::make('text', 'crb_section_slide_link', 'Link')->set_width('50'),
            )),
        )),
    ));

Container::make('post_meta', 'Short Code')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-meetings-events.php'))
    ->add_fields(array(
        Field::make('text', 'crb_form_heading', 'Short Code Heading')->set_width(50),
        Field::make('text', 'crb_short_code', 'Short Code')->set_width(50),
    ));

Container::make('post_meta', 'Restaurant Details')
    ->show_on_post_type('leeu-restaurants')
    ->add_fields(array(
        Field::make('text', 'crb_restaurant_location_popup', 'Location (for Popup)')->help_text('(This will come next to restaurant name in booking popup)'),
        Field::make('text', 'crb_booking_buton_link', "Book A Table - 'connectionid'"),
    )); 

//Discover Page - Content Section
Container::make('post_meta', 'Content Section')
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
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
    ->show_on_post_type($leeu_post_types)
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

// Artisan page
Container::make('post_meta', 'Artisan Drinks Content Section')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-artisan-drinks.php')
    ->add_fields(array(
        Field::make('complex', 'crb_artisan_drinks_content', '')->add_fields(array(
            Field::make('image', 'crb_artisan_drink_image1', 'Full Image')->help_text('(Image Dimensions (WxH): 821 x 478)'),
            Field::make('text', 'crb_artisan_drinks_section_heading', 'Heading')->set_width(50),
            Field::make('text', 'crb_artisan_drinks_section_link', 'Link')->set_width(50),
            Field::make('textarea', 'crb_artisan_drinks_section_description', 'Content'),
            Field::make('image', 'crb_artisan_drink_image2', 'Half Left Image')->help_text('(Image Dimensions (WxH): 411 x 258)')->set_width('50'),
            Field::make('text', 'crb_artisan_drinks_section_left_heading', 'Half left heading'),
            Field::make('textarea', 'crb_artisan_drinks_section_left_description', 'Half left content'),
            Field::make('image', 'crb_artisan_drink_image3', 'Half Right Image')->help_text('(Image Dimensions (WxH): 411 x 258)')->set_width('50'),
            Field::make('text', 'crb_artisan_drinks_section_right_heading', 'Half right heading'),
            Field::make('textarea', 'crb_artisan_drinks_section_right_description', 'Half right content'),
        )),
    ));

Container::make('post_meta', 'Artisan Drinks Bottom Content Section (Header & Description with Top-Center)')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-artisan-drinks.php')
    ->add_fields(array(
        Field::make('complex', 'crb_artisan_drinks_bottom_content', '')->add_fields(array(
            Field::make('text', 'crb_artisan_drinks_section_heading', 'Heading')->set_width(50),
            Field::make('textarea', 'crb_artisan_drinks_section_description', 'Content')->set_width(50),
            Field::make('image', 'crb_artisan_drink_image1', 'Full Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width(50),
            Field::make('text', 'crb_artisan_drinks_section_link', 'Link')->set_width(50),
        )),
    ));

// Wine page
Container::make('post_meta', 'The Wines')
    ->show_on_post_type("leeu-wine")
    ->show_on_template('template-hotel-wine.php')
    ->add_fields(array(
        Field::make('text', 'crb_wine_section_heading', 'Wines Slider Heading'),
        Field::make('textarea', 'crb_wine_section_description', 'Wines Slider Description'),

        Field::make('complex', 'crb_wine_slider_details', '')->add_fields(array(
            Field::make('image', 'crb_wine_image', 'Image')->help_text('(Image Dimensions (WxH): 411 x 258)')->set_width('25'),
            Field::make('text', 'crb_wine_name', 'Name')->set_width('30'),
            Field::make('text', 'crb_wine_type', 'Type')->set_width('20'),
            Field::make('date', 'crb_wine_date', 'Date')->set_width('25'),
        )),
    )); 

//Content Section Hotel Home Page
Container::make('post_meta', 'Content Section')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-section-slider-with-header-banner.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_template_content_section', '')->add_fields(array(
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

//Page - bottom links
Container::make('post_meta', 'Bottom Links')
    ->show_on_post_type("page")
    ->add_fields(array(
        Field::make('text', 'crb_bottom_link_heading_left', 'Link Heading (Left)')->set_width('40'),
        Field::make('text', 'crb_bottom_link_button_text_left', 'Button Text (Left)')->set_width('20'),
        Field::make('text', 'crb_bottom_link_button_link_left', 'Button Link (Left)')->set_width('40'),

        Field::make('text', 'crb_bottom_link_heading_right', 'Link Heading (Right)')->set_width('40'),
        Field::make('text', 'crb_bottom_link_button_text_right', 'Button Text (Right)')->set_width('20'),
        Field::make('text', 'crb_bottom_link_button_link_right', 'Button Link (Right)')->set_width('40'),
    ));

$args = array(
    'post_type' => 'hotel',
    'posts_per_page' => -1,
    'orderby' =>'menu_order',
    'order' => 'ASC',
    'post_parent' => 0
    );
$loop = new WP_Query( $args );
$hotels_list = array();
while ( $loop->have_posts() ) {
    $loop->the_post();
    $ID         = $loop->post->ID;

    $hotels_list[$ID] = $loop->post->post_title;
}
wp_reset_postdata();

$hotels_list_fields[] = Field::make('select', 'crb_career_hotel', 'Select Hotel')->add_options($hotels_list);
$hotels_list_fields[] = Field::make('text', 'crb_career_form_shortcode', 'Career Form Shortcode');
$hotels_list_fields[] = Field::make('textarea', 'crb_career_position', 'Position');

Container::make('post_meta', 'Career Info')
    ->show_on_post_type("leeu-careers")
    ->add_fields($hotels_list_fields);


//  Media & trades
Container::make('post_meta', 'Media Info')
    ->show_on_post_type("leeu-media-trades")
    ->add_fields(array(
        Field::make('text', 'crb_media_hotel', 'Hotel name'),
        Field::make('text', 'crb_room_name', 'Room name'),
        Field::make('image', 'crb_first_dpi', '72 DPI @ 1200 px')->set_value_type( 'url' ),
        Field::make('image', 'crb_second_dpi', '300 DPI')->set_value_type( 'url' )
        ));

/*  
//Slider Info
//The Chef
Container::make('post_meta', 'The Chef Section')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template('template-restaurant.php')
    ->add_fields(array(
        Field::make('text', 'crb_chef_section_heading', 'Section Heading'),
        Field::make('complex', 'crb_chef_section_info', '')->add_fields(array(
            Field::make('image', 'crb_chef_image', 'Chef Image')->set_width(20)->help_text('(Image Dimensions (WxH): w x h)'),
            Field::make('textarea', 'crb_chef_description', 'Chef Description')->set_width(80),
        )),
    ));
*/


//Trip Advisor
Container::make('post_meta', 'Trip Advisor Code')
    ->show_on_post_type($leeu_post_types)
    ->add_fields(array(
        Field::make('textarea', 'crb_trip_advisor_code', ''),
    ));

//Navarino Service Hotel ID
Container::make('post_meta', 'Hotel ID & Chain ID - Navarino Service')
    ->show_on_post_type('hotel')
    ->show_on_level(1)
    ->add_fields(array(
        Field::make('text', 'crb_hotel_id', 'Hotel ID - Navarino Service')->set_width(50),
        Field::make('text', 'crb_chain_id', 'Chain ID - Navarino Service')->set_width(50),
    ));

//Hotel Closed Section - Hotel Individual Landing Page
Container::make('post_meta', 'Hotel Closed?')
    ->show_on_post_type('hotel')
    ->show_on_level(1)
    ->add_fields(array(
            Field::make('radio', 'crb_hotel_closed', 'Hotel Closed?')
                ->add_options(array(
                    'yes' => 'Yes',
                    'no' => 'No',
                ))->set_default_value('no')->set_width('15'),

            Field::make('textarea', 'crb_hotel_closed_reason', 'Hotel Closed Reason')->set_width('50')->help_text('This will come on the top of header banner.')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_hotel_closed',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('text', 'crb_hotel_closed_button_text', 'Hotel Closed Button Text')->set_width('50')->help_text('This will come under "Hotel Closed Reason".')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_hotel_closed',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('text', 'crb_hotel_closed_button_link', 'Hotel Closed Button Link')->set_width('50')->help_text('This will come under "Hotel Closed Reason".')->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_hotel_closed',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('text', 'crb_form_heading', 'Short Code Heading')->set_width(50)->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_hotel_closed',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
            Field::make('text', 'crb_short_code', 'Short Code')->set_width(50)->set_conditional_logic(array(
                'relation' => 'AND', // Optional, defaults to "AND"
                array(
                    'field' => 'crb_hotel_closed',
                    'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                    'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                )
            )),
        ));

//Show/Hide Left Sidebar
Container::make('post_meta', 'Show left sidebar?')
    ->show_on_post_type($leeu_post_types)
    ->set_context('side')
    ->set_priority('low')
    ->add_fields(array(
        Field::make('radio', 'crb_left_sidebar_visibility', '')
                ->add_options(array(
                    'show' => 'Show',
                    'hide' => 'Hide',
                ))->set_default_value('show')
    ));

// Press page
Container::make('post_meta', 'Press Content')
    ->show_on_post_type('leeu-press')
    ->add_fields(array(
        /*Field::make('image', 'crb_press_thumb_image', 'Thumb Image'),*/
        Field::make('date', 'crb_press_release_date', 'Release Date')->set_width('30'),
        Field::make('text', 'crb_press_detail_link', 'Link')->set_width('70'),
        Field::make('complex', 'crb_press_slider', 'Slider')->add_fields(array(
          Field::make('image', 'crb_press_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
        )),
    ));

//Sub Heading
Container::make('post_meta', 'Sub Heading')
    ->show_on_post_type('hotel')
    ->show_on_level(1)
    ->add_fields(array(
        Field::make('textarea', 'crb_sub_heading', '')->help_text("This will come under large header."),
    ));

//Spa & Wellness Leeu House Page
Container::make('post_meta', 'Content Section')
    ->show_on_post_type($leeu_post_types)
    ->show_on_template(array('template-spa-wellness-leeu-house.php'))
    ->add_fields(array(
        Field::make('complex', 'crb_spa_content_section2', '')->add_fields(array(

            Field::make('complex', 'crb_spa_section_slider', 'Slider')->add_fields(array(
              Field::make('image', 'crb_spa_section_slide_image', 'Image')->help_text('(Image Dimensions (WxH): 821 x 478)')->set_width('20'),
            )),
            Field::make('textarea', 'crb_spa_section_slide_desc', 'Small Description')->set_width('50'),
            Field::make('text', 'crb_spa_section_slide_link_text', 'Link Text')->set_width('20'),
            Field::make('text', 'crb_spa_section_slide_link_url', 'Link')->set_width('30'),
            
        )),
    ));