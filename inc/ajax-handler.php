<?php
// Handle AJAX request to save game result
function xog_save_game_result()
{
    if (!isset($_POST['player_winner']) || !in_array($_POST['player_winner'], ['X', 'O', 'Draw'])) {
        wp_send_json_error(['message' => 'Invalid player winner']);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'xog_results';

    $result = $wpdb->insert(
        $table_name,
        [
            'player_winner' => sanitize_text_field($_POST['player_winner']),
        ],
        ['%s']
    );

    if ($result) {
        wp_send_json_success(['message' => 'Result saved successfully']);
    } else {
        wp_send_json_error(['message' => 'Failed to save result']);
    }
}
add_action('wp_ajax_xog_save_result', 'xog_save_game_result');
add_action('wp_ajax_nopriv_xog_save_result', 'xog_save_game_result');
