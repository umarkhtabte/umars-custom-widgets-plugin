<?php
/*
Plugin Name: Umar's Custom Widgets Plugin
Description: A plugin that adds custom widgets with advanced options by Umar.
Version: 1.0
Author: Umar Khtab
*/

// Prevent direct access
if (!defined('ABSPATH')) exit;

// Include widget files
require_once plugin_dir_path(__FILE__) . 'includes/class-umar-welcome-widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-umar-advanced-widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-umar-styled-widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-umar-featured-posts-widget.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-umar-testimonials-widget.php';

// Enqueue assets
function umars_custom_widgets_enqueue_assets($hook) {
    if ($hook != 'widgets.php') {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('umar-widget-script', plugin_dir_url(__FILE__) . 'assets/js/widget-script.js', array('jquery', 'wp-color-picker'), false, true);
    wp_enqueue_style('umar-widget-styles', plugin_dir_url(__FILE__) . 'assets/css/widget-styles.css');
}
add_action('admin_enqueue_scripts', 'umars_custom_widgets_enqueue_assets');

// Register widgets
function umars_custom_widgets_register_widgets() {
    register_widget('Umar_Welcome_Widget');
    register_widget('Umar_Featured_Posts_Widget');
    register_widget('Umar_Testimonials_Widget');
    // register_widget('Umar_Advanced_Widget');
    // register_widget('Umar_Styled_Widget');
}
add_action('widgets_init', 'umars_custom_widgets_register_widgets');
