<?php
global $dhepa;
$dhepa = get_option('dhepa');
$most_popular_video = $dhepa['most-popular-video'];
class Dhepa_Popular_Video extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_popular_video',
			'description' => 'This widget will show Popular Videos',
		);
		parent::__construct( 'dhepa_popular_video', 'Dhepa Popular Video', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>This widget will show popular video</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $most_popular_video;
		echo $args['before_widget'];
		echo $args['before_title']; 
		//Title
		if($most_popular_video){
			echo $most_popular_video;
		}else{
			echo "Most Popular Video";
		} 

		//Title
		echo $args['after_title'];
		$video_q_args = array(

				'posts_per_page' => '1',
				'post_type' => 'video',
				'orderby'=> 'meta_value_num',
				'meta_key'=> 'post_views_count',
				'order' => 'DESC',
			); 
		?>
    <div class="details-thumb">
        <?php 
		$video_query = new WP_Query( $video_q_args );
		while ($video_query->have_posts()) {
			$video_query->the_post();  ?>
            <div class="thumb-first">
                <a href="<?php the_permalink() ?>">
                    <?php $url = get_the_post_thumbnail_url(get_the_ID(),'single-popular-image'); ?>
                    <?php
                    if (!$url) { ?>
                        <img src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                        echo $dhepa['defaults-post-image']['url'];
                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res">
                    <?php } else { ?>
                        <img src="<?php if (!empty($dhepa['default-post-image']['url'])) {
                                        echo $dhepa['default-post-image']['url'];
                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-default.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res" data-src="<?php echo $url; ?>">
                    <?php } ?>
                </a>
                <h4>
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </h4>
            </div>
        <?php } ?>
        <?php wp_reset_query(); ?>
        <div class="sub-thumb">
            <div class="row FlexRow">
                <?php
				$video_qq_args = array(

					'posts_per_page' => '4',
					'post_type' => 'video',
    				'orderby'=> 'meta_value_num',
    				'meta_key'=> 'post_views_count',
    				'order' => 'DESC',
					'offset' => 1,
				); 
                $video_query2 = new WP_Query( $video_qq_args );
				while ($video_query2->have_posts()) {
					$video_query2->the_post();  ?>
                        <div class="col-sm-6 FlexRow">
                            <div class="small-thumb">
                                <a href="<?php the_permalink() ?>">
                                    <?php $url = get_the_post_thumbnail_url(get_the_ID(),'single-side-image'); ?>
                                    <?php
                                    if (!$url) { ?>
                                        <img src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                        echo $dhepa['defaults-post-image']['url'];
                                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res">
                                    <?php } else { ?>
                                        <img src="<?php if (!empty($dhepa['default-post-image']['url'])) {
                                                        echo $dhepa['default-post-image']['url'];
                                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-default.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res" data-src="<?php echo $url; ?>">
                                    <?php } ?>
                                </a>
                                <h4>
                                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                        </div>
                    <?php }  ?>
					<?php wp_reset_query(); ?>
            </div>
        </div>
    </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Popular_Video' );
});