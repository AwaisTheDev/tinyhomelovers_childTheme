<?php
/*
* Creating a function to create our CPT
*/
 
function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Projects', 'Post Type General Name', 'hello_elementor' ),
        'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'hello_elementor' ),
        'menu_name'           => __( 'Projects', 'hello_elementor' ),
        'parent_item_colon'   => __( 'Parent Project', 'hello_elementor' ),
        'all_items'           => __( 'All Projects', 'hello_elementor' ),
        'view_item'           => __( 'View Project', 'hello_elementor' ),
        'add_new_item'        => __( 'Add New Project', 'hello_elementor' ),
        'add_new'             => __( 'Add New', 'hello_elementor' ),
        'edit_item'           => __( 'Edit Project', 'hello_elementor' ),
        'update_item'         => __( 'Update Project', 'hello_elementor' ),
        'search_items'        => __( 'Search Project', 'hello_elementor' ),
        'not_found'           => __( 'Not Found', 'hello_elementor' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'hello_elementor' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'Projects', 'hello_elementor' ),
        'description'         => __( 'Project news and reviews', 'hello_elementor' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'revisions' ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'category' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */ 
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );
     
    // Registering your Custom Post Type
    register_post_type( 'projects', $args );
    

    //Custom tags for projects
    $label_tags = array(
      'name' => _x( 'Tags', 'taxonomy general name' ),
      'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Tags' ),
      'popular_items' => __( 'Popular Tags' ),
      'all_items' => __( 'All Tags' ),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __( 'Edit Tag' ), 
      'update_item' => __( 'Update Tag' ),
      'add_new_item' => __( 'Add New Tag' ),
      'new_item_name' => __( 'New Tag Name' ),
      'separate_items_with_commas' => __( 'Separate tags with commas' ),
      'add_or_remove_items' => __( 'Add or remove tags' ),
      'choose_from_most_used' => __( 'Choose from the most used tags' ),
      'menu_name' => __( 'Tags' ),
    ); 
    register_taxonomy('project_tag','projects',array(
      'hierarchical' => true,
      'labels' => $label_tags,
      'show_ui' => true,
      'has_archive', true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'project_tag' ),
      'show_in_rest' => true
    ));
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );


//adding meta-boxes

add_action( 'load-post.php', 'aa_projects_meta_setup' );
add_action( 'load-post-new.php', 'aa_projects_meta_setup' );



/* Meta box setup function. */
function aa_projects_meta_setup() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'aa_add_projects_meta_boxes' );
    add_action( 'save_post', 'aa_save_project_information_meta', 10, 2 );

  }

function aa_add_projects_meta_boxes(){
    add_meta_box( 'project_related_information','Related Information', 'aa_related_information_metabox', 'projects', 'side', "default");

}

function aa_related_information_metabox($post){ ?>
<?php wp_nonce_field( basename( __FILE__ ), 'aa_project_class_nonce' ); ?>

        <p>
            <label for="project-total-area"><?php _e( "Area", 'example' ); ?></label>
            <br />
            <input class="widefat" type="text" name="project-total-area" id="project-total-area" value="<?php echo esc_attr( get_post_meta( $post->ID, 'project-total-area', true ) ); ?>" size="30" />
        </p>
        <p>
            <label for="project-bedrooms"><?php _e( "Number of bedrooms", 'example' ); ?></label>
            <br />
            <input class="widefat" type="text" name="project-bedrooms" id="project-bedrooms" value="<?php echo esc_attr( get_post_meta( $post->ID, 'project-bedrooms', true ) ); ?>" size="30" />
        </p>
        <p>
            <label for="project-bathrooms"><?php _e( "Number of bathrooms", 'example' ); ?></label>
            <br />
            <input class="widefat" type="text" name="project-bathrooms" id="project-bathrooms" value="<?php echo esc_attr( get_post_meta( $post->ID, 'project-bathrooms', true ) ); ?>" size="30" />
        </p>

        <p>
            <label for="project-architects"><?php _e( "Architects", 'example' ); ?></label>
            <br />
            <input class="widefat" type="text" name="project-architects" id="project-architects" value="<?php echo esc_attr( get_post_meta( $post->ID, 'project-architects', true ) ); ?>" size="30" />
        </p>

        <p > <b>Elementor Shortcode For Sidebar</b> </p>
        <p>
            <label for="elementor_sidebar_shortcode"><?php _e( "Shortcode", 'example' ); ?></label>
            <br />
            <input class="widefat" type="text" name="elementor_sidebar_shortcode" id="elementor_sidebar_shortcode" value="<?php echo esc_attr( get_post_meta( $post->ID, 'elementor_sidebar_shortcode', true ) ); ?>" size="30" />
        </p>

        
<?php }




/* Save the meta box’s post metadata. */
function aa_save_project_information_meta( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['aa_project_class_nonce'] ) || !wp_verify_nonce( $_POST['aa_project_class_nonce'], basename( __FILE__ ) ) )
      return $post_id;
  
    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );
  
    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
      return $post_id;
  

    /* Get the meta key. */
    $area_meta_key = 'project-total-area'; 
    $bedroom_meta_key = 'project-bedrooms'; 
    $bathroom_meta_key = 'project-bathrooms'; 
    $architects_meta_key = 'project-architects'; 
    $elementor_sidebar_shortcode_meta_key = 'elementor_sidebar_shortcode'; 


    /* Get the posted data and sanitize it for use as an HTML class. */
    $area_meta_value = ( isset( $_POST[$area_meta_key] ) ?  $_POST[$area_meta_key]  : "" );
    $bedroom_meta_value = ( isset( $_POST[$bedroom_meta_key] ) ?  $_POST[$bedroom_meta_key]  : "" );
    $bathroom_meta_value = ( isset( $_POST[$bathroom_meta_key] ) ?  $_POST[$bathroom_meta_key]  : "" );
    $architects_meta_value = ( isset( $_POST[$architects_meta_key] ) ?  $_POST[$architects_meta_key]  : "" );
    $elementor_sidebar_shortcode_meta_value = ( isset( $_POST[$elementor_sidebar_shortcode_meta_key] ) ?  $_POST[$elementor_sidebar_shortcode_meta_key]  : "" );
  
       
    //updating values
    save_meta_value_function($area_meta_value ,$area_meta_key , $post_id );
    save_meta_value_function($bedroom_meta_value ,$bedroom_meta_key , $post_id );
    save_meta_value_function($bathroom_meta_value ,$bathroom_meta_key , $post_id );
    save_meta_value_function($architects_meta_value ,$architects_meta_key , $post_id );
    save_meta_value_function($elementor_sidebar_shortcode_meta_value ,$elementor_sidebar_shortcode_meta_key , $post_id );
   
}



function save_meta_value_function($new_meta_value ,$meta_key , $post_id ){

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );
  
    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && ’ == $meta_value )
      add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  
    /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
      update_post_meta( $post_id, $meta_key, $new_meta_value );
  
    /* If there is no new meta value but an old value exists, delete it. */
    elseif ( ’ == $new_meta_value && $meta_value )
      delete_post_meta( $post_id, $meta_key, $meta_value );

}
