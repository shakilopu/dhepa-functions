<?php
global $dhepa;
$dhepa = get_option('dhepa');
$archive_g_ads = $dhepa['archive-sidebar-first-ads-html'];
$archive_link = $dhepa['archive-sidebar-first-image-ads-url'];
$archive_img_ads = $dhepa['archive-sidebar-first-image-ads']['url'];

class Dhepa_Archive_Sidebar_First_Ads extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_archive_sidebar_first_ads',
			'description' => 'This widget will show Archive Page Sidebar First Ads.',
		);
		parent::__construct( 'dhepa_archive_sidebar_first_ads', 'Dhepa  Archive Page Sidebar First Ads', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set ads from --> Theme Options >> Ads Settings >> Archive Page Ads >> Sidebar First Ads</p>";
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
		global $archive_g_ads;
    	global $archive_link;
    	global $archive_img_ads;
		?>
            <div id="single-sidebar-ads">
                <?php if (!empty($archive_img_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <a href="<?php echo $archive_link; ?>"><img src="<?php echo $archive_img_ads; ?>" alt="Sidebar First Ads" class="img-fluid img-responsive dhepaimg-res"> </a>
                    </div>
                <?php } elseif (!empty($archive_g_ads)) { ?>
                    <div class="text-center" style="padding:7px 0;background:#fafafa">
                        <?php echo $archive_g_ads; ?>
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
	register_widget( 'Dhepa_Archive_Sidebar_First_Ads' );
});