<?php
/*
Plugin Name: wp-x-o-game
Plugin URI: http://wordpress.org/plugins/wp-x-o-game/
Description: ایجاد یک بازی ساده دوز در وبسایت
Author: M.Mehdi Diaromidi
Version: 1.0.0
License: GPLv2 or later
Author URI: http://mehdidiaromidi@gmail.com
*/

// Define plugin constants
define('XOG_GAME_URL', plugin_dir_url(__FILE__));
define('XOG_GAME_PATH', plugin_dir_path(__FILE__));

// Include necessary files
require_once XOG_GAME_PATH . 'inc/enqueue-scripts.php';
require_once XOG_GAME_PATH . 'inc/admin-dashboard.php';

// Initialize the plugin
function xog_init() {
    // Load text domain for translations
    load_plugin_textdomain('xog', false, dirname(plugin_basename(__FILE__)) . '/languages');

    // Actions and filters can be added here if needed
}
add_action('plugins_loaded', 'xog_init');

