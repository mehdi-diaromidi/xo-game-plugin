<?php

// Render the settings page
function xog_render_settings_page()
{
    // Save settings if form is submitted
    if (isset($_POST['xog_save_settings'])) {
        check_admin_referer('xog_settings_nonce', 'xog_settings_nonce_field');

        update_option('xog_win_message', sanitize_text_field($_POST['xog_win_message']));
        update_option('xog_draw_message', sanitize_text_field($_POST['xog_draw_message']));

        echo '<div class="updated"><p>Settings saved successfully!</p></div>';
    }

    // Get current settings
    $win_message = get_option('xog_win_message', 'برنده شد!');
    $draw_message = get_option('xog_draw_message', 'بازی مساوی شد!');

    global $wpdb;
    $table_name = $wpdb->prefix . 'xog_results';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY game_date DESC LIMIT 10", ARRAY_A);

?>
    <div class="wrap">
        <h1>تنظیمات بازی دوز</h1>
        <form method="post" action="">
            <?php wp_nonce_field('xog_settings_nonce', 'xog_settings_nonce_field'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="xog_win_message">پیام برنده شدن:</label></th>
                    <td>
                        <input type="text" name="xog_win_message" id="xog_win_message" value="<?php echo esc_attr($win_message); ?>" class="regular-text">
                    </td>
                </tr>
                <tr>
                    <th><label for="xog_draw_message">پیام مساوی شدن:</label></th>
                    <td>
                        <input type="text" name="xog_draw_message" id="xog_draw_message" value="<?php echo esc_attr($draw_message); ?>" class="regular-text">
                    </td>
                </tr>
            </table>
            <p class="submit">
                <button type="submit" name="xog_save_settings" class="button button-primary">ذخیره تنظیمات</button>
            </p>
        </form>

        <h2>گزارش نتایج بازی</h2>
        <table class="widefat">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>برنده</th>
                    <th>تاریخ بازی</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)) : ?>
                    <?php foreach ($results as $result) : ?>
                        <tr>
                            <td><?php echo esc_html($result['id']); ?></td>
                            <td><?php echo esc_html($result['player_winner']); ?></td>
                            <td><?php echo esc_html($result['game_date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3">هیچ نتیجه‌ای ثبت نشده است.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php
}
