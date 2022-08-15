<?php

// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', get_template_directory() . '/inc/acf/' );
define( 'MY_ACF_URL', get_template_directory_uri() . '/inc/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
function loop_acf_settings_url( $url ) {
  return MY_ACF_URL;
}
add_filter('acf/settings/url', 'loop_acf_settings_url');

// Hide the ACF admin menu item.
function loop_acf_settings_show_admin( $show_admin ) {
  return false;
}
//add_filter('acf/settings/show_admin', 'loop_acf_settings_show_admin');