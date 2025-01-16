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
require_once XOG_GAME_PATH . 'inc/settings-page.php';

// Include AJAX handler
require_once XOG_GAME_PATH . 'inc/ajax-handler.php';

// Initialize the plugin
function xog_init()
{
    // Actions and filters can be added here if needed
}
add_action('plugins_loaded', 'xog_init');

// Add shortcode for displaying the XO game
function xog_game_shortcode()
{
    ob_start();
    include XOG_GAME_PATH . 'inc/game-board.php';
    return ob_get_clean();
}
add_shortcode('xog_game', 'xog_game_shortcode');

// Create database table on plugin activation
function xog_create_results_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'xog_results';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        player_winner VARCHAR(5) NOT NULL,
        game_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'xog_create_results_table');
