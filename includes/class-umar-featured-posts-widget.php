<?php
class Umar_Featured_Posts_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'umar_featured_posts_widget',
            __('Umar Featured Posts Widget', 'text_domain'),
            array('description' => __('Displays a list of featured posts', 'text_domain'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Query to fetch recent posts
        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $instance['number'] ? $instance['number'] : 5
        );
        $posts = new WP_Query($query_args);

        if ($posts->have_posts()) {
            echo '<ul>';
            while ($posts->have_posts()) {
                $posts->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Featured Posts', 'text_domain');
        $number = !empty($instance['number']) ? $instance['number'] : 5;
?>

    <!-- Title Field -->
    <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>

    <!-- Number of Posts Field -->
    <p>
        <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to display:'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" value="<?php echo esc_attr($number); ?>">
    </p>

<?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number'] = (!empty($new_instance['number'])) ? intval($new_instance['number']) : 5;

        return $instance;
    }
}
