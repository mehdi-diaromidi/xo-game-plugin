<?php
// Enqueue plugin scripts and styles
function xog_enqueue_scripts()
{
    // Enqueue styles
    wp_enqueue_style('xog-style', XOG_GAME_URL . 'assets/css/style.css', [], '1.0.0');
    wp_enqueue_style('sweetalert-style', 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css', [], '11.0.0');

    // Enqueue scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('xog-script', XOG_GAME_URL . 'assets/js/script.js', ['jquery'], '1.0.0', true);
    wp_enqueue_script('sweetalert-script', 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js', [], '11.0.0', true);

    // Localize script for AJAX
    wp_localize_script('xog-script', 'xog_data', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'win_message' => get_option('xog_win_message', 'برنده شد!'),
        'draw_message' => get_option('xog_draw_message', 'بازی مساوی شد!'),
    ]);
}
add_action('wp_enqueue_scripts', 'xog_enqueue_scripts');
