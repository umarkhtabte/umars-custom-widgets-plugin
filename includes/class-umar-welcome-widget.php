<?php

if (!defined('ABSPATH')) exit; // Prevent direct access

class Umar_Welcome_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'umar_welcome_widget',
            __('Umar Welcome Widget', 'text_domain'),
            array('description' => __('A widget to display a customizable welcome message.', 'text_domain'))
        );
    }

    // Display widget output on the front end
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        // Widget title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        // Welcome message
        $background_color = !empty($instance['background_color']) ? $instance['background_color'] : '#ffffff';
        echo '<div style="background-color:' . esc_attr($background_color) . ';">';
        echo '<p>' . (!empty($instance['message']) ? esc_html($instance['message']) : 'Welcome to our website!') . '</p>';
        echo '</div>';

        echo $args['after_widget'];
    }

    // Widget settings form in the admin dashboard
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Welcome!', 'text_domain');
        $message = !empty($instance['message']) ? $instance['message'] : __('Welcome to our website!', 'text_domain');
        $background_color = !empty($instance['background_color']) ? $instance['background_color'] : '#ffffff';

        // Title field
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- Message field -->
        <p>
            <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Message:'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo esc_textarea($message); ?></textarea>
        </p>

        <!-- Background Color field -->
        <p>
            <label for="<?php echo $this->get_field_id('background_color'); ?>"><?php _e('Background Color:'); ?></label>
            <input class="umar-color-field" id="<?php echo $this->get_field_id('background_color'); ?>" name="<?php echo $this->get_field_name('background_color'); ?>" type="text" value="<?php echo esc_attr($background_color); ?>">
        </p>
        <?php
    }

    // Save widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['message'] = (!empty($new_instance['message'])) ? sanitize_text_field($new_instance['message']) : '';
        $instance['background_color'] = (!empty($new_instance['background_color'])) ? sanitize_hex_color($new_instance['background_color']) : '#ffffff';

        return $instance;
    }
}
