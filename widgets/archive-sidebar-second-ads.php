<?php
global $dhepa;
$dhepa = get_option('dhepa');
$archive_second_g_ads = $dhepa['archive-sidebar-second-ads-html'];
$archive_second_link = $dhepa['archive-sidebar-second-image-ads-url'];
$archive_second_img_ads = $dhepa['archive-sidebar-second-image-ads']['url'];

class Dhepa_Archive_Sidebar_Second_Ads extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_archive_sidebar_second_ads',
			'description' => 'This widget will show Archive Page Sidebar Second Ads.',
		);
		parent::__construct( 'dhepa_archive_sidebar_second_ads', 'Dhepa  Archive Page Sidebar Second Ads', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set ads from --> Theme Options >> Ads Settings >> Archive Page Ads >> Sidebar Second Ads</p>";
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
		global $archive_second_g_ads;
    	global $archive_second_link;
    	global $archive_second_img_ads;
		?>
            <div id="single-sidebar-ads">
                <?php if (!empty($archive_second_img_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="<?php echo $archive_second_link; ?>"><img src="<?php echo $archive_second_img_ads; ?>" alt="Sidebar second Ads" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } elseif (!empty($archive_second_g_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <?php echo $archive_second_g_ads; ?>
                    </div>
                <?php } else { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/newspaper-300x600.jpg" alt=" News Ad" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } ?>
            </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Archive_Sidebar_Second_Ads' );
});