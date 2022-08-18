<?php
global $dhepa;
$dhepa = get_option('dhepa');
$recommended_post = $dhepa['recommended-for-you'];
class Dhepa_Recommended_Post extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_recommended_post',
			'description' => 'This widget will show recommended post',
		);
		parent::__construct( 'dhepa_recommended', 'Dhepa Recommended Post', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>This widget will show Recommended post</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $recommended_post;
		echo $args['before_widget'];
// 		echo $args['before_title']; 
// 		echo $args['after_title'];
		?>
        <div class="recommend-post">

            <h2><?php if($recommended_post){echo $recommended_post;}else{echo "Recommended For You";} ?></h2>

       
                
                    <div class="media-list">
                        <div class="row">
                        <?php 
							$dhepa_recommend_args = array(

								'posts_per_page' => '10',
								'meta_key' => 'post_views_count',
								'orderby' => 'meta_value_num',
								'order' => 'DESC',


							); 
							$dhepa_recommend_query = new WP_Query( $dhepa_recommend_args );
							while ($dhepa_recommend_query->have_posts()) {
								$dhepa_recommend_query->the_post(); ?>
                                <div class="col-6">
                                    <div class="media-left">
                                        <a href="<?php the_permalink() ?>">
                                           <?php $url = get_the_post_thumbnail_url(get_the_ID(), 'home-sm-two-post-image'); ?>
                                           
                                             <?php if (!$url) { ?>
                                                <img loading="lazy" alt="<?php the_title(); ?>" width="100%"  src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                                                                                                    echo esc_attr($dhepa['defaults-post-image']['url']);
                                                                                                                                                } else { ?>
                                                 <?php echo esc_url(get_template_directory_uri()); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res" />
                
                                                <?php } else { ?>
                                                    <img loading="lazy" alt="<?php the_title(); ?>" width="100%"  src="<?php echo esc_attr($url); ?>" />
                    
                                                <?php } ?>
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h6><a href="<?php the_permalink() ?>" class="tab-news-title"><?php the_title() ?></a></h6>
                                    </div>
                                </div>
						
                        <?php } wp_reset_query(); ?>
                        </div>
                    </div>

        </div>
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Recommended_Post' );
});