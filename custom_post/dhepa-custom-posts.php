<?php 
// Create Video Post

add_action( 'init', 'create_video_post' );
function create_video_post() {
    register_post_type(
        'video',
        array(
            'labels' => array(
                'name' => __('Video', 'dhepa-functions'),
                'singular_name' => __('Video', 'dhepa-functions'),
                'add_new' => __('Add New Video', 'dhepa-functions'),
                'search_items' => 'Search Video',
                'add_new_item' => __('Add New Video item', 'dhepa-functions'),
                'edit_item' => __('Edit Video', 'dhepa-functions'),
                'new_item' => __('New Video', 'dhepa-functions'),
                'view_item' => __('View Video', 'dhepa-functions'),
                'parent' => 'Parent Video',
                'not_found' => __('Sorry, we couldn\'t find the Video you are looking for.', 'dhepa-functions')
            ),
            'public' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'publicly_queryable' => true, //you must enter true for single page
            'exclude_from_search' => false,
            'menu_position' => 14,
            'has_archive' => true,
            'hierarchical' => true,
            'rewrite' => array('slug' => 'video'),
            'supports' => array('title', 'thumbnail')
        )
    );
}
//for Video taxonomy

function video_taxonomy() {
    register_taxonomy(
        'video_cat',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
        'video',          //post type name
        array(
            'hierarchical'      => true,
            'has_archive'       => true,
            'label'             => 'Video Category',  //Display name
            'query_var'         => true,
            'rewrite'           => array(
                'slug'          => 'video_category', // This controls the base slug that will display before each term
                'with_front'    => false, // Don't display the category base before
                )
            )
    );
}
add_action( 'init', 'video_taxonomy');  


  // Add Meta Box
 
 //Register Meta box
add_action('add_meta_boxes',function (){
 
    add_meta_box('youtube-id','Youtube Video ID','dhepa_youtube_id','video');
});
//Meta callback function
function dhepa_youtube_id($post){
    $dhepa_meta_val=get_post_meta($post->ID);
    ?>
    <input type="text" name="youtube_id"
     value="<?php if( isset ( $dhepa_meta_val['youtube_id'])) echo esc_attr($dhepa_meta_val['youtube_id'][0]); ?>" >
    <?php
     
}
//save meta value with save post hook
add_action('save_post',function($post_id){
    $youtube_id = sanitize_text_field($_POST['youtube_id']);
    if(isset($youtube_id)){
         update_post_meta($post_id,'youtube_id', $youtube_id);
    }
 
});
 
// show meta value after post content
add_filter('the_excerpt',function($content){
    $meta_val=get_post_meta(get_the_ID(),'youtube_id',true);
    return $meta_val;
 
});
