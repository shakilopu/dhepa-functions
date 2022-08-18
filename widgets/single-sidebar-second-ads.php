<?php
global $dhepa;
$dhepa = get_option('dhepa');
$second_g_ads = $dhepa['sidebar-second-ads-html'];
$second_link = $dhepa['sidebar-second-image-ads-url'];
$second_img_ads = $dhepa['sidebar-second-image-ads']['url'];
class Dhepa_Sidebar_Second_Ads extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_sidebar_second_ads',
			'description' => 'This widget will show Sidebar Second Ads.',
		);
		parent::__construct( 'dhepa_sidebar_second_ads', 'Dhepa Sidebar Second Ads', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set ads from --> Theme Options >> Ads Settings >> Single Page Ads >> Sidebar Second Ads</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $second_g_ads;
        global $second_link;
        global $second_img_ads;
		echo $args['before_widget'];
// 		echo $args['before_title']; 
// 		echo $args['after_title'];
		?>
            <div id="single-sidebar-ads">
                <?php if (!empty($second_img_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="<?php echo $second_link; ?>"><img src="<?php echo $second_img_ads; ?>" alt="Sidebar Second Ads" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } elseif (!empty($second_g_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <?php echo $second_g_ads; ?>
                    </div>
                <?php } else { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                       <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/newspaper-300x250.jpg" alt=" News Ad" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } ?>
            </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Sidebar_Second_Ads' );
});