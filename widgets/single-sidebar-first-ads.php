<?php
global $dhepa;
$dhepa = get_option('dhepa');
$first_g_ads = $dhepa['sidebar-first-ads-html'];
$first_link = $dhepa['sidebar-first-image-ads-url'];
$first_img_ads = $dhepa['sidebar-first-image-ads']['url'];

class Dhepa_Sidebar_First_Ads extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_sidebar_first_ads',
			'description' => 'This widget will show Sidebar First Ads.',
		);
		parent::__construct( 'dhepa_sidebar_first_ads', 'Dhepa Sidebar First Ads', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set ads from --> Theme Options >> Ads Settings >> Single Page Ads >> Sidebar First Ads</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];
// 		echo $args['before_title']; 
// 		echo $args['after_title'];
		global $first_g_ads;
    	global $first_link;
    	global $first_img_ads;
		?>
            <div id="singlepage-ads">
                <?php if (!empty($first_img_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="<?php echo $first_link; ?>"><img src="<?php echo $first_img_ads; ?>" alt="Sidebar First Ads" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } elseif (!empty($first_g_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <?php echo $first_g_ads; ?>
                    </div>
                <?php } else { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/newspaper-300x250.jpg" alt=" News Ad" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } ?>
            </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Sidebar_First_Ads' );
});