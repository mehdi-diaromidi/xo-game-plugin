<?php
// Add admin menu and page
function xog_admin_menu()
{
    add_menu_page(
        __('X-O Game', 'xog'),
        __('X-O Game', 'xog'),
        'manage_options',
        'xog-settings',
        'xog_admin_page_content',
        'dashicons-games',
        20
    );
}

function xog_admin_page_content()
{
    echo '<div class="wrap"><h1>' . __('X-O Game Settings', 'xog') . '</h1></div>';
}

add_action('admin_menu', 'xog_admin_menu');
