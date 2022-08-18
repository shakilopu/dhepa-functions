<?php

global $dhepa;
$dhepa = get_option('dhepa');
$fb_id = $dhepa['facebook-page-id'];
class Dhepa_Sidebar_Facebook extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_sidebar_facebook',
			'description' => 'This widget will show Facebook Like Box.',
		);
		parent::__construct( 'dhepa_sidebar_facebook', 'Dhepa Sidebar Facebook Like Box', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>Set Like Box from --> Theme Options >> General Settings >> Facebook Like Box Settings</p>";
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
		global $fb_id;
		?>
		<div class="col py-2">
            <div class="facebook-responsive">
                <div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/<?php if(!empty($fb_id)){echo $fb_id;}?>" data-width="500px" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=679179046220911&amp;container_width=528&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2F<?php if(!empty($fb_id)){echo $fb_id;}?>&amp;locale=en_US&amp;sdk=joey&amp;show_facepile=true&amp;width=500px">
                    <span style="vertical-align: bottom; width: 500px; height: 130px;  ">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/<?php if(!empty($fb_id)){echo $fb_id;}?>/&tabs=timeline&width=500&height=130&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=false&appId=<?php if(!empty($dhepa['facebook-app-id'])){echo $dhepa['facebook-app-id'];}?>" width="500" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe></span>
                </div>
            </div>
        </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Sidebar_Facebook' );
});