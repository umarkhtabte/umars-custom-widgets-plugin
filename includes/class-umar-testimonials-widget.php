<?php
class Umar_Testimonials_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'umar_testimonials_widget',
            __('Umar Testimonials Widget', 'text_domain'),
            array('description' => __('Displays user testimonials with author image', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Display the testimonial content
        echo '<blockquote>';
        if (!empty($instance['author_image'])) {
            echo '<img src="' . esc_url($instance['author_image']) . '" alt="' . esc_attr($instance['author_name']) . '" class="umar-author-image">';
        }
        echo '<p>' . esc_html($instance['testimonial_text']) . '</p>';
        echo '<footer>' . esc_html($instance['author_name']) . '</footer>';
        echo '</blockquote>';

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Testimonials', 'text_domain');
        $testimonial_text = !empty($instance['testimonial_text']) ? $instance['testimonial_text'] : __('This is a sample testimonial.', 'text_domain');
        $author_name = !empty($instance['author_name']) ? $instance['author_name'] : __('Author Name', 'text_domain');
        $author_image = !empty($instance['author_image']) ? $instance['author_image'] : '';

    ?>
        <!-- Title Field -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- Testimonial Text Field -->
        <p>
            <label for="<?php echo $this->get_field_id('testimonial_text'); ?>"><?php _e('Testimonial Text:'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('testimonial_text'); ?>" name="<?php echo $this->get_field_name('testimonial_text'); ?>"><?php echo esc_textarea($testimonial_text); ?></textarea>
        </p>

        <!-- Author Name Field -->
        <p>
            <label for="<?php echo $this->get_field_id('author_name'); ?>"><?php _e('Author Name:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('author_name'); ?>" name="<?php echo $this->get_field_name('author_name'); ?>" type="text" value="<?php echo esc_attr($author_name); ?>">
        </p>

        <!-- Author Image Field -->
        <p>
            <label for="<?php echo $this->get_field_id('author_image'); ?>"><?php _e('Author Image URL:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('author_image'); ?>" name="<?php echo $this->get_field_name('author_image'); ?>" type="text" value="<?php echo esc_url($author_image); ?>" placeholder="Enter image URL">
        </p>

    <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['testimonial_text'] = (!empty($new_instance['testimonial_text'])) ? strip_tags($new_instance['testimonial_text']) : '';
        $instance['author_name'] = (!empty($new_instance['author_name'])) ? strip_tags($new_instance['author_name']) : '';
        $instance['author_image'] = (!empty($new_instance['author_image'])) ? esc_url_raw($new_instance['author_image']) : '';

        return $instance;
    }
}
