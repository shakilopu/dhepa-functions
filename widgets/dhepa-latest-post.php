<?php
global $dhepa;
$dhepa = get_option('dhepa');
$latest_in = $dhepa['latest-in'];
class Dhepa_Related_Latest extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'dhepa_related_latest',
			'description' => 'This widget will show latest post from related category',
		);
		parent::__construct( 'dhepa_related', 'Dhepa Related Post', $widget_ops );
	}
	public function form( $instance ) {
		echo "<p>This widget will show related post from same category</p>";
	}
	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        global $latest_in;
		echo $args['before_widget'];
		echo $args['before_title']; 
		//Title
		if($latest_in){
			echo $latest_in .' - ';
		}else{
			echo "Latest In - ";
		} 

		$get_cat = get_the_category(); 
		foreach ($get_cat as $key => $value) {
			if ($key == 0) {
				echo $value->name;
			}
		}
		//Title
		echo $args['after_title'];
			$q_args = array(

				'posts_per_page' => '5',
				'category__in' => $value->cat_ID,


			); 
		?>
		<div class="single-block">
			<div class="details with-icon">
				<?php
				$query = new WP_Query( $q_args );
				while ($query->have_posts()) {
					$query->the_post();
				?>
				<div class="media">
					<div class="media-body">
						<h4 class="media-heading">
							<a href="<?php the_permalink(); ?>">
								<i class="fa fa-angle-double-right"></i> <?php the_title(); ?>
							</a>
						</h4>
					</div>
				</div>
				<?php 
				}
				wp_reset_postdata(); ?>
			</div>
		</div> 
		<?php
		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Dhepa_Related_Latest' );
});