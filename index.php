<?php
/*
Plugin Name: Sophia Twitter Auto Post
Description: Plugin to send new posts to twitter using the codebird twitter auth library
Version: 1.0.0
Author: Jordi Cuevas
Author URI: @jordicuevas 
Text Domain: jjav_sophia_post_to_twitter
Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include('admin/admin-init.php');

add_action('auto-draft_to_publish', 'jjav_sophia_twitter_auto_post', 10, 1);
add_action('draft_to_publish', 'jjav_sophia_twitter_auto_post', 10, 1);
add_action('future_to_publish', 'jjav_sophia_twitter_auto_post', 10, 1);
add_action('new_to_publish', 'jjav_sophia_twitter_auto_post', 10, 1);
add_action('pending_to_publish', 'jjav_sophia_twitter_auto_post', 10, 1);

function jjav_sophia_twitter_auto_post() {

    global $jjav_sophia_post_to_twitter;
    $post_id = get_the_ID();
    $posted = get_post_meta($post_id, 'social_twitter_posted', true);
    $enable = $jjav_sophia_post_to_twitter['active'];
    
     if ($posted != 'true' && $enable == 1) {
        require_once __DIR__ . '/codebird/src/codebird.php';
        $consumer_key        = $jjav_sophia_post_to_twitter['consumer-key'];
        $consumer_secret     = $jjav_sophia_post_to_twitter['consumer-secret'];
        $access_token        = $jjav_sophia_post_to_twitter['access-token'];
        $access_token_secret = $jjav_sophia_post_to_twitter['access-token-secret'];
        \Codebird\Codebird::setConsumerKey($consumer_key, $consumer_secret);
        $cb = \Codebird\Codebird::getInstance();
        $cb->setToken($access_token, $access_token_secret);
        $post_title = get_the_title($post_id);
        $post_image = get_the_post_thumbnail_url($post_id);
        $post_link = get_the_permalink($post_id);
        $status =  $post_title . ' - ' . $post_link;
        $media_files = array($post_image);
        $media_ids = array();
        foreach ($media_files as $file) {
            $reply = $cb->media_upload(array (
                'media' => $file
            ));
            $media_ids[] = $reply->media_id_string;
        }
        $media_ids = implode(',', $media_ids);
        $reply = $cb->statuses_update(array (
            'status'    => $status,
            'media_ids' => $media_ids
        ));
        if ($reply->httpstatus == 200) {
            add_post_meta($post_id, 'jjav_sophia_social_twitter_posted', 'true', true);
        } else {
            add_post_meta($post_id, 'jjav_sophia_social_twitter_posted', $reply->httpstatus, true);
        }
    } else {
        return;
    }
}