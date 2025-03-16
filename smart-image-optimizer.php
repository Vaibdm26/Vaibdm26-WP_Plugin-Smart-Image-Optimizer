<?php
/*
Plugin Name: Smart Image Optimizer
Plugin URI: https://yourwebsite.com
Description: Optimizes and compresses images automatically upon upload.
Version: 1.0
Author: Vaibhav Muley
Author URI: https://yourwebsite.com
License: GPL2
*/

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Include image optimization functions
require_once plugin_dir_path(__FILE__) . 'includes\functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/settings.php';

// Add admin menu for settings page
function smart_image_optimizer_menu() {
    add_options_page(
        'Smart Image Optimizer Settings',
        'Smart Image Optimizer',
        'manage_options',
        'smart-image-optimizer',
        'smart_image_optimizer_settings_page'
    );
}
add_action('admin_menu', 'smart_image_optimizer_menu');