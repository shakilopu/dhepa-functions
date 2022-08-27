<?php
global $dhepa;
$dhepa = get_option('dhepa');
$popular_post = $dhepa['popular-post'];
class Dhepa_Popular_Post extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_popular_post',
			'description' => 'This widget will show Popular post from related category',
		);
		parent::__construct( 'dhepa_popular', 'Dhepa Popular Post', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>This widget will show popular post from same category</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $popular_post;
		echo $args['before_widget'];
		echo $args['before_title']; 
		//Title
		if($popular_post){
			echo esc_attr($popular_post);
		}else{
			echo "Popular Post";
		} 

		//Title
		echo $args['after_title'];
		$popular_q_args = array(

				'posts_per_page' => '1',
				'post_type' => 'post',
				'orderby'=> 'meta_value_num',
				'meta_key'=> 'post_views_count',
				'order' => 'DESC',
			); 
		?>
    <div class="details-thumb">
        <?php 
		$popular_query = new WP_Query( $popular_q_args );
		while ($popular_query->have_posts()) {
			$popular_query->the_post();  ?>
            <div class="thumb-first">
                <a href="<?php the_permalink() ?>">
                    <?php $url = get_the_post_thumbnail_url(get_the_ID(),'single-popular-image'); ?>
                   <?php if (!$url) { ?>
                    <img loading="lazy" width="100%"  src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                                                                        echo esc_attr($dhepa['defaults-post-image']['url']);
                                                                                                                    } else { ?>
                     <?php echo esc_url(get_template_directory_uri()); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res" />

                    <?php } else { ?>
                        <img loading="lazy" alt="<?php the_title(); ?>" width="100%"  src="<?php echo esc_attr($url); ?>" />

                    <?php } ?>
                </a>
                <h6>
                    <a href="<?php the_permalink() ?>" class="tab-news-title"><?php the_title(); ?></a>
                </h6>
            </div>
        <?php } ?>
        <?php wp_reset_query(); ?>
        <div class="sub-thumb">
            <div class="row FlexRow">
                <?php
				$popular_qq_args = array(

					'posts_per_page' => '4',
    				'post_type' => 'post',
    				'orderby'=> 'meta_value_num',
    				'meta_key'=> 'post_views_count',
    				'order' => 'DESC',
					'offset' => 1,
				); 
                $popular_query2 = new WP_Query( $popular_qq_args );
				while ($popular_query2->have_posts()) {
					$popular_query2->the_post();  ?>
                        <div class="col-sm-6 FlexRow">
                            <div class="small-thumb">
                                <a href="<?php the_permalink() ?>">
                                    <?php $url2 = get_the_post_thumbnail_url(get_the_ID(),'single-side-image'); ?>
                                    <?php if (!$url2) { ?>
                                    <img loading="lazy" width="100%"  src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                                                                                        echo esc_attr($dhepa['defaults-post-image']['url']);
                                                                                                                                    } else { ?>
                                     <?php echo esc_url(get_template_directory_uri()); ?>/images/dhepa-no-image.jpg <?php } ?>" alt="<?php the_title(); ?>" class="lazyload img-responsive dhepaimg-res" />
                
                                    <?php } else { ?>
                                        <img loading="lazy" alt="<?php the_title(); ?>" width="100%"  src="<?php echo esc_attr($url2); ?>" />
                
                                    <?php } ?>
                                </a>
                                <h6>
                                    <a href="<?php the_permalink() ?>" class="tab-news-title"><?php the_title(); ?></a>
                                </h6>
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
	register_widget( 'Dhepa_Popular_Post' );
});