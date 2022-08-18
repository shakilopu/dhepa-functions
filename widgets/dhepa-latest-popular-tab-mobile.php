<?php
global $dhepa;
$dhepa = get_option('dhepa');
$latest_post = $dhepa['latest-post'];
$popular_post = $dhepa['popular-post'];
$all_post = $dhepa['all-post'];

class Dhepa_Latest_Popular_Tab_Mobile extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'dhepa_latest_popular_tab_mobile',
            'description' => 'This widget will show Latest & Popular Post Tab For Mobile',
        );
        parent::__construct('dhepa_latest_popular_tab_mobile', 'Dhepa Latest & Popular Post Tab For Mobile', $widget_ops);
    }
    public function form($instance)
    {
        echo "<p>Don't Add This Anywhere</p>";
    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance)
    {
        global $latest_post;
        global $popular_post;
        global $all_post;
        echo $args['before_widget'];

?>

        <!-- Top rest lead news mobile end-->
        <div class="row row-cols-1 d-md-none d-lg-none d-xl-none">
            <div id="most-recent-news-tab" class="col bg-white mb-2 mb-sm-0 mb-md-0 mb-lg-0 mb-xl-0">
                <ul id="myTab" role="tablist" class="nav nav-tabs nav-pills text-center border-0">
                    <li class="nav-item flex-fill flex-sm-fill pr-2">
                        <a id="home-tab" data-toggle="tab" href="#recent-view1" role="tab" aria-controls="recent-view1" aria-selected="true" class=" nav-link border-0 text-uppercase font-weight-bold py-1 active "><?php if ($latest_post) {
                                                                                                                                                                                                                            echo $latest_post;
                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                            echo "Latest Post";
                                                                                                                                                                                                                        } ?></a>
                    </li>
                    <li class="nav-item flex-fill flex-sm-fill pl-2">
                        <a id="profile-tab" data-toggle="tab" href="#most-view1" role="tab" aria-controls="most-view1" aria-selected="false" class="
                        nav-link
                        border-0
                        text-uppercase
                        font-weight-bold
                        py-1
                      "><?php if ($popular_post) {
                            echo $popular_post;
                        } else {
                            echo "Popular Post";
                        } ?></a>
                    </li>
                </ul>

                <div id="news-list" class="tab-content">
                    <div id="recent-view1" role="tabpanel" aria-labelledby="home-tab" class="tab-pane fade px-0 my-2 show active">
                        <div class="slimScrollDiv" style="
                        position: relative;
                        overflow: hidden;
                        width: auto;
                        height: 410px;
                      ">
                            <div id="most-recent-news" style="overflow: scroll; width: auto; height: 410px">
                                <?php
                                $latest_pop_q_args = array(
                                    'posts_per_page' => '15',
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'paged' => get_query_var('paged'),
                                );

                                $sl = 1;
                                $latest_popular = new WP_Query($latest_pop_q_args);
                                while ($latest_popular->have_posts()) {
                                    $latest_popular->the_post();  ?>
                                    <div class="row row-cols-1 no-gutters mb-2">
                                        <div class="col-3">
                                            <?php $url = get_the_post_thumbnail_url(get_the_ID(), 'sidebar-bg-image'); ?>
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <?php if (!$url) { ?>
                                                    <img loading="lazy" src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                                    echo esc_attr($dhepa['defaults-post-image']['url']);
                                                                                } else { ?>
                                        <?php echo esc_url(get_template_directory_uri()); ?>/images/dhepa-no-image.jpg <?php } ?>" class="img-fluid" width="90" height="60" alt="<?php the_title(); ?>" />
                                                <?php } else { ?>
                                                    <img loading="lazy" src="<?php echo esc_attr($url); ?>" class="img-fluid" width="90" height="60" alt="<?php the_title(); ?>" />
                                                <?php } ?>

                                            </a>
                                        </div>
                                        <div class="col-9 align-self-center px-3">
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <h6 class="tab-news-title">
                                                    <?php the_title(); ?>
                                                </h6>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php wp_reset_query(); ?>
                            </div>
                            <div class="slimScrollBar" style="
                          background: rgb(0, 0, 0);
                          width: 7px;
                          position: absolute;
                          top: 0px;
                          opacity: 0.4;
                          display: block;
                          border-radius: 7px;
                          z-index: 99;
                          right: 1px;
                        "></div>
                            <div class="slimScrollRail" style="
                          width: 7px;
                          height: 100%;
                          position: absolute;
                          top: 0px;
                          display: none;
                          border-radius: 7px;
                          background: rgb(51, 51, 51);
                          opacity: 0.2;
                          z-index: 90;
                          right: 1px;
                        "></div>
                        </div>
                        <div class="nav nav-pills nav-fill mt-2">
                            <span class="nav-item"><a class="nav-link active py-1 font-weight-bold" href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php if ($all_post) {
                                                                                                                                                                            echo $all_post;
                                                                                                                                                                        } else {
                                                                                                                                                                            echo "All Post";
                                                                                                                                                                        } ?></a></span>
                        </div>
                    </div>
                    <div id="most-view1" role="tabpanel" aria-labelledby="profile-tab" class="tab-pane fade px-0 my-2">
                        <div class="slimScrollDiv" style="
                        position: relative;
                        overflow: hidden;
                        width: auto;
                        height: 410px;
                      ">
                            <div id="most-viewed-news" style="overflow: scroll; width: auto; height: 410px">
                                <?php
                                $latest_popular_q_args = array(
                                    'posts_per_page' => '15',
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'meta_key' => 'post_views_count',
                                    'orderby' => 'meta_value_num',
                                    'order' => 'DESC',
                                );

                                $sl = 1;
                                $latest_popular_pop = new WP_Query($latest_popular_q_args);
                                while ($latest_popular_pop->have_posts()) {
                                    $latest_popular_pop->the_post();  ?>
                                    <div class="row row-cols-1 no-gutters mb-2">
                                        <div class="col-3">
                                            <?php $url = get_the_post_thumbnail_url(get_the_ID(), 'sidebar-bg-image'); ?>
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <?php if (!$url) { ?>
                                                    <img loading="lazy" src="<?php if (!empty($dhepa['defaults-post-image']['url'])) {
                                                                                    echo esc_attr($dhepa['defaults-post-image']['url']);
                                                                                } else { ?>
                                        <?php echo esc_url(get_template_directory_uri()); ?>/images/dhepa-no-image.jpg <?php } ?>" class="img-fluid" width="90" height="60" alt="<?php the_title(); ?>" />
                                                <?php } else { ?>
                                                    <img loading="lazy" src="<?php echo esc_attr($url); ?>" class="img-fluid" width="90" height="60" alt="<?php the_title(); ?>" />
                                                <?php } ?>

                                            </a>
                                        </div>
                                        <div class="col-9 align-self-center px-3">
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <h6 class="tab-news-title">
                                                    <?php the_title(); ?>
                                                </h6>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php wp_reset_query(); ?>

                            </div>
                            <div class="slimScrollBar" style="
                          background: rgb(0, 0, 0);
                          width: 7px;
                          position: absolute;
                          top: 0px;
                          opacity: 0.4;
                          display: block;
                          border-radius: 7px;
                          z-index: 99;
                          right: 1px;
                        "></div>
                            <div class="slimScrollRail" style="
                          width: 7px;
                          height: 100%;
                          position: absolute;
                          top: 0px;
                          display: none;
                          border-radius: 7px;
                          background: rgb(51, 51, 51);
                          opacity: 0.2;
                          z-index: 90;
                          right: 1px;
                        "></div>
                        </div>
                        <div class="nav nav-pills nav-fill">
                            <span class="nav-item">
                                <a class="nav-link active py-1 font-weight-bold" href="<?php echo get_permalink(get_option('page_for_posts')); ?>">
                                    <?php if ($all_post) {
                                        echo $all_post;
                                    } else {
                                        echo "All Post";
                                    } ?></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        echo $args['after_widget'];
    }
}

add_action('widgets_init', function () {
    register_widget('Dhepa_Latest_Popular_Tab_Mobile');
});
