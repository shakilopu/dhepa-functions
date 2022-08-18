<?php
global $dhepa;
$dhepa = get_option('dhepa');
$third_g_ads = $dhepa['sidebar-third-ads-html'];
$third_link = $dhepa['sidebar-third-image-ads-url'];
$third_img_ads = $dhepa['sidebar-third-image-ads']['url'];
class Dhepa_Sidebar_Third_Ads extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_sidebar_third_ads',
			'description' => 'This widget will show Sidebar Third Ads.',
		);
		parent::__construct( 'dhepa_sidebar_third_ads', 'Dhepa Sidebar Third Ads', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set ads from --> Theme Options >> Ads Settings >> Single Page Ads >> Sidebar Third Ads</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $third_g_ads;
        global $third_link;
        global $third_img_ads;
		echo $args['before_widget'];
// 		echo $args['before_title']; 
// 		echo $args['after_title'];
		?>
            <div id="single-sidebar-ads">
                <?php if (!empty($third_img_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="<?php echo $third_link; ?>"><img src="<?php echo $third_img_ads; ?>" alt="Sidebar third Ads" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } elseif (!empty($third_g_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <?php echo $third_g_ads; ?>
                    </div>
                <?php } else { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/newspaper-300x150.jpg" alt=" News Ad" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } ?>
            </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Sidebar_Third_Ads' );
});