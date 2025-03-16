<?php
// Ensure the file is accessed within WordPress
if (!defined('ABSPATH')) {
    exit;
}

// Register settings
function smart_image_optimizer_register_settings() {
    register_setting('smart_image_optimizer_settings', 'smart_image_optimizer_enabled');
    register_setting('smart_image_optimizer_settings', 'smart_image_optimizer_api_key');
}
add_action('admin_init', 'smart_image_optimizer_register_settings');

// Display the settings page
function smart_image_optimizer_settings_page() {
?>
    <div class="wrap">
        <h2>Smart Image Optimizer Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('smart_image_optimizer_settings'); ?>
            <?php do_settings_sections('smart_image_optimizer_settings'); ?>
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Image Optimization</th>
                    <td>
                        <input type="checkbox" name="smart_image_optimizer_enabled" value="1" <?php checked(1, get_option('smart_image_optimizer_enabled', 1)); ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">TinyPNG API Key</th>
                    <td>
                        <input type="text" name="smart_image_optimizer_api_key" value="<?php echo esc_attr(get_option('smart_image_optimizer_api_key', '')); ?>" size="100" />
                        <p><small>Get an API Key from <a href="https://tinypng.com/developers" target="_blank">TinyPNG</a></small></p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
<?php
}
?>
