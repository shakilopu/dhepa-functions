<?php
global $dhepa;
$dhepa = get_option('dhepa');
$video_latest_post = $dhepa['latest-video'];
$video_popular_post = $dhepa['popular-video'];
$video_all_post = $dhepa['all-post'];

class Dhepa_Latest_Popular_Video_Tab extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_latest_popular_video_tab',
			'description' => 'This widget will show Latest & Popular Video Tab',
		);
		parent::__construct( 'dhepa_latest_popular_video_tab', 'Dhepa Latest & Popular Video Tab', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>This widget will show Latest & Popular Video Tab</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $video_latest_post;
        global $video_popular_post;
        global $video_all_post;
		echo $args['before_widget'];
// 		echo $args['before_title']; 
// 		echo $args['after_title'];
		?>
    		<div class="box-white">
                <div class="jagoTab2 dhepatab-latest-popular">

                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li role="presentation" class="active"><a href="#tab21" aria-controls="tab21" role="tab" data-toggle="tab"><?php if($video_latest_post){echo $video_latest_post;}else{echo "Latest Video";} ?></a></li>
                        <li role="presentation"><a href="#tab22" aria-controls="tab22" role="tab" data-toggle="tab"><?php if($video_popular_post){echo $video_popular_post;}else{echo "Popular Video";} ?></a></li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab21">
                            <ul class="media-list" style="max-height:185px!important;">
                                <?php 
									$video_latest_pop_q_args = array(
											'posts_per_page' => '10',
											'post_type' => 'video',
											'post_status' => 'publish',
											'paged'=> get_query_var('paged'),
										); 

                                	$video_sl = 1;
                                	$video_latest_popular = new WP_Query( $video_latest_pop_q_args );
									while ($video_latest_popular->have_posts()) {
									$video_latest_popular->the_post();  ?>
                                        <li class="media">
                                            <div class="media-left">
                                                <span><?php echo $video_sl++; ?></span><a href="<?php the_permalink() ?>">
                                                    <?php $url =  get_the_post_thumbnail_url(get_the_ID(),'sidebar-post-image'); ?>

                                                    <?php
                                                    if (!$url) { ?>
                                                        <img src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                        echo $dhepa['defaults-post-image']['url'];
                                                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload media-object">
                                                    <?php } else { ?>
                                                        <img src="<?php if (!empty($dhepa['default-post-image']['url'])) {
                                                                        echo $dhepa['default-post-image']['url'];
                                                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-default.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload media-object" data-src="<?php echo $url; ?>">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                            </div>
                                        </li>
                                    <?php } ?>
        						<?php wp_reset_query(); ?>
                            </ul>
                            <div class="allnews"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php if($video_all_post){echo $video_all_post;}else{echo "All Post";} ?></a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab22">
                            <ul class="media-list" style="max-height:185px!important;">
                                <?php 
		                            $video_latest_popular_q_args = array(
											'posts_per_page' => '10',
											'post_type' => 'video',
											'post_status' => 'publish',
											'meta_key'=> 'post_views_count',
											'orderby' => 'meta_value_num',
											'order' => 'DESC',
										); 

                                	$video_sl = 1;
                                	$video_latest_popular_pop = new WP_Query( $video_latest_popular_q_args );
									while ($video_latest_popular_pop->have_posts()) {
									$video_latest_popular_pop->the_post();  ?>
                                        <li class="media">
                                            <div class="media-left">
                                                <span><?php echo $video_sl++; ?></span><a href="<?php the_permalink() ?>">
                                                    <?php $url = get_the_post_thumbnail_url(get_the_ID(),'sidebar-post-image'); ?>

                                                    <?php
                                                    if (!$url) { ?>
                                                        <img src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                        echo $dhepa['defaults-post-image']['url'];
                                                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload media-object">
                                                    <?php } else { ?>
                                                        <img src="<?php if (!empty($dhepa['default-post-image']['url'])) {
                                                                        echo $dhepa['default-post-image']['url'];
                                                                    } else { ?>
                                                           <?php echo get_template_directory_uri(); ?>/images/dhepa-default.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload media-object" data-src="<?php echo $url; ?>">
                                                    <?php } ?>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                                            </div>
                                        </li>
                                    <?php } ?>
        						<?php wp_reset_query(); ?>
                            </ul>
                            <div class="allnews"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>"><?php if($video_all_post){echo $video_all_post;}else{echo "All Post";} ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Latest_Popular_Video_Tab' );
});