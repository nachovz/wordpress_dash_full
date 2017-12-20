<?php
/**
     * DO NOT DELETE!!!
     * Autoload for PHP Composer and definition of the ABSPATH
     */
     
     //defining the absolute path for the wordpress instalation.
    if ( !defined('ABSPATH') ) define('ABSPATH', dirname(__FILE__) . '/');
    
    //including composer autoload
    require ABSPATH."vendor/autoload.php";

    /**
     * DO NOT DELETE!!!
     * Here we are importing the Styles of the parent theme and re-using them
     * for our own project, please don't edit this hook/function
     */

function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css');
    wp_enqueue_style( 'theme-styles', get_stylesheet_directory_uri().'/style.css');
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

// Register Custom Navigation Walker
require_once get_template_directory() . '/wp-bootstrap-navwalker.php';

// Add theme support for Featured Images
add_theme_support('post-thumbnails', array('post','page',) );

function regSidebar(){
    $args = array(
    	'name'          => 'Sidebar',
    	'id'            => "sidebar",
    	'description'   => '',
    	'class'         => '',
    	'before_title'  => '<h2 class="widgettitle">',
    	'after_title'   => "</h2>\n",
    );
    
    register_sidebar( $args );
}

add_action( 'init', 'regSidebar' );














//Post Types
add_action( 'init', 'create_post_type' );

//Custom Post Type
function create_post_type() {
  register_post_type( 'course',
    array(
      'labels' => array(
        'name' => __( 'Courses' ),
        'singular_name' => __( 'Course' )
      ),
      'public' => true,
      'has_archive' => true,
      'taxonomies' => array('category')
    )
  );
  
  register_post_type( 'assignment',
    array(
      'labels' => array(
        'name' => __( 'Assignments' ),
        'singular_name' => __( 'Assignment' )
      ),
      'public' => true,
      'has_archive' => true,
    )
  );
}


add_action( 'add_meta_boxes', 'addAssignmentParentMetabox' ); 

function addAssignmentParentMetabox() {
 
    add_meta_box( 'assignment_parent', 'Assignment Course', 'renderStaffParentMetabox' , 'assignment' );
    add_meta_box( 'project_parent', 'Project Course', 'renderStaffParentMetabox' , 'project' );
}

function renderStaffParentMetabox($post) {
    global $post;
    
    wp_nonce_field( 'stc_cpt', 'staff_parent_custom_box' );
   	
   	//Get the CPT
   	$args = array(
       'post_type' => 'course'
    );
    
    $pages = get_posts($args);
 
    echo 'Select the parent page';
    echo '<select name="staff_parent">';
    echo '<option value="">Choose a page...</option>';
    foreach( $pages as $page ){
        echo '<option value="'.$page->ID.'"';
        if ( $page->ID == $post->post_parent ) {
        	echo ' selected';
 
        // this condition is unnecessary but will allow you to default the 
        // metabox to a specific page so users do not need to manually enter it	
        }
        echo '>'.$page->post_title.'</option>';
    }
    echo '</select>';
}
 
add_action( 'wp_insert_post_data', 'saveStaffParent', '99', 2  ); 
/**
 * saveStaffParent
 *
 * @author  Joe Sexton <joe@webtipblog.com>
 * @param   array $data
 * @param   array $postarr
 * @return  array
 */
function saveStaffParent( $data, $postarr ) {
    global $post;
 
    if ( !wp_verify_nonce( $_POST['staff_parent_custom_box'], 'stc_cpt' ) )
        return $data;
 
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $data;
 
    if ( $post->post_type == "assignment" || $post->post_type == "project" ){
	    $data['post_parent'] = $_POST['staff_parent'];
	}
 
    return $data;
}

//CONTROLLERS

use \WPAS\Controller\WPASController;
$controller = new WPASController([
    'namespace' => 'php\\Controllers\\'
]);
$controller->route([ 'slug' => 'Single:course', 'controller' => 'Course' ]);

use \WPAS\Types\PostTypesManager;
$postTypeManager = new PostTypesManager([
    'namespace' => '\php\Types\\'
]);
//You can react a new custom post type and specify his class
$postTypeManager->newType(['type' => 'project', 'class' => 'ProjectPostType'])->register();

