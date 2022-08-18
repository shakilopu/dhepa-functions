<?php
global $dhepa;
$dhepa = get_option('dhepa');
$video_second_g_ads = $dhepa['video-archive-sidebar-second-ads-html'];
$video_second_link = $dhepa['video-archive-sidebar-second-image-ads-url'];
$video_second_img_ads = $dhepa['video-archive-sidebar-second-image-ads']['url'];

class Dhepa_Video_Sidebar_Second_Ads extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_video_sidebar_second_ads',
			'description' => 'This widget will show Video Page Sidebar Second Ads.',
		);
		parent::__construct( 'dhepa_video_sidebar_second_ads', 'Dhepa  Video Page Sidebar Second Ads', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set ads from --> Theme Options >> Ads Settings >> Video Archive Page Ads >> Sidebar Second Ads</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		echo ($args['before_widget']);
		global $video_second_g_ads;
    	global $video_second_link;
    	global $video_second_img_ads;
		?>
            <div id="single-sidebar-ads">
                <?php if (!empty($video_second_img_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="<?php echo esc_html($video_second_link); ?>"><img src="<?php echo esc_html($video_second_img_ads); ?>" alt="Sidebar First Ads" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } elseif (!empty($video_second_g_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <?php echo esc_html($video_second_g_ads); ?>
                    </div>
                <?php } else { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/newspaper-300x250.jpg" alt=" News Ad" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } ?>
            </div>
		<?php
		echo ($args['after_widget']);
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Video_Sidebar_Second_Ads' );
});