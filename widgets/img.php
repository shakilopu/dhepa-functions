<?php
class about_me extends WP_Widget{

    public function __construct(){
        parent::__construct('about_me', 'About Me', array(
            'description' => 'This is all about me'
        ));
    }
    
    public function form($instance){
        $title = $instance['title'];
        $desc = $instance['desc'];
        $photo = $instance['photo'];
    ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>">Your Name: </label></p>
        <p>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title ?>">
        </p>
        <p><label for="<?php echo $this->get_field_id('desc'); ?>">Your Desc: </label></p>
        <p>
            <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo $desc ;?></textarea>
        </p>
        <p><label for="<?php echo $this->get_field_id('photo'); ?>">Photo </label></p>
        <p>
            <input class="widefat image1" type="text" name="<?php echo $this->get_field_name('photo'); ?>" id="<?php echo $this->get_field_id('photo'); ?>" value="<?php echo $photo ;?>">
        </p>
        <p>
            <button class="image_upload1 widefat">Select Image</button>
        </p>
    
    
    
    <?php
    }
    
    public function widget ($args, $instance){
        $title = $instance['title'];
        $desc = $instance['desc'];
        echo $args['before_widget'].$args['before_title'].$title.$args['after_title']."<div class=\"textwidget\">".$desc."</div>".$args['after_widget'];
    
    }
    } // class about_me extends WP_Widget END
    
    
    
    add_action('widgets_init', function(){
    register_widget('about_me');
    });
    
    
    
    
    /*
    photo upload option in widget
    */
    
    function photo_upload_option($hook) {
    
    if( $hook != 'widgets.php' ) 
        return;
    wp_enqueue_script( 'uploadphoto', get_template_directory_uri() . '/js/upload_image.js', array('jquery', 'media-upload', 'thickbox'), '1.0', 'true' );
    wp_enqueue_script( 'media-upload');
    wp_enqueue_script( 'thickbox');
    wp_enqueue_style ( 'thickbox');
    
    }
    add_action('admin_enqueue_scripts', 'photo_upload_option'); 
    ?>

    <script>
        jQuery(document).ready(function($){
$('button.image_upload1').click(function(){
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;

});

window.send_to_editor = function(){
    var imagelink = jQuery('img').attr('src');
    jQuery('.image1').val(imagelink);
    tb_remove();
}
        })
        </script>