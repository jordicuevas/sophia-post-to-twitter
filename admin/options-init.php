<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "jjav_sophia_post_to_twitter";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'jjav_sophia_post_to_twitter',

        'use_cdn' => FALSE,
        'dev_mode' => FALSE,
        'display_name' => 'Sophia Post to Twitter',
        'display_version' => '1.0.0',
        'page_title' => 'Sophia Post to Twitter',
        'update_notice' => FALSE,
        'intro_text' => "here you can configure the options for Sophia's  Post to Twitter plugin",
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Sophia Post to Twitter',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'page_priority' => '5',
        'customizer' => TRUE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
                'style' => 'bootstrap',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => FALSE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/jordicuevas',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
     
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/jordicuevas',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.linkedin.com/in/jordi-cuevas-60a88823/',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );
 
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */
Redux::setSection( $opt_name, array(
        'title'  => __( 'Plugin Options', 'jjav_sophia_post_to_twitter' ),
        'id'     => 'jjav_sophia_post_to_twitter_plugin_options',
        'desc'   => __( 'Set plugins options.', 'jjav_sophia_post_to_twitter' ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
               'id'       => 'active',
               'type'     => 'select',
               'title'    => __('Plugin status', 'jjav_sophia_post_to_twitter'), 
               'desc'     => __('Enable or Disable post to twitter', 'jjav_sophia_post_to_twitter'),
                // Must provide key => value pairs for select options
               'options'  => array(
                       '1' => 'Enable',
                       '2' => 'Disable',
                    
           ),
                'default'  => '2'
         ) )
    ) );

    /*
     *
     * ---> START SECTIONS
     *
     */

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Twitter Options', 'jjav_sophia_post_to_twitter' ),
        'id'     => 'jjav_sophia_post_to_twitter_options',
        'desc'   => __( 'Twitter App keys.', 'jjav_sophia_post_to_twitter' ),
        'icon'   => 'el el-twitter',
        'fields' => array(
            array(
                'id'       => 'consumer-key',
                'type'     => 'text',
                'title'    => __( 'Consumer Key', 'jjav_sophia_post_to_twitter' ),
                'desc'     => __( 'Consumer key of your twitter app.', 'jjav_sophia_post_to_twitter' ),
             ),
            array(
                'id'       => 'consumer-secret',
                'type'     => 'text',
                'title'    => __( 'Consumer Secret', 'jjav_sophia_post_to_twitter' ),
                'desc'     => __( 'Consumer secret of your twitter app.', 'jjav_sophia_post_to_twitter' ),
             ),
             array(
                'id'       => 'access-token',
                'type'     => 'text',
                'title'    => __( 'Access Token', 'jjav_sophia_post_to_twitter' ),
                'desc'     => __( 'Access token of your twitter app.', 'jjav_sophia_post_to_twitter' ),
             ),
              array(
                'id'       => 'access-token-secret',
                'type'     => 'text',
                'title'    => __( 'Access Token Secret', 'jjav_sophia_post_to_twitter' ),
                'desc'     => __( 'Access token secret of your twitter app.', 'jjav_sophia_post_to_twitter' ),
             )
        )
    ) );

    /*
     * <--- END SECTIONS
     */
