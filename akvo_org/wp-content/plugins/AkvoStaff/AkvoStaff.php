<?php
/*
Plugin Name: Akvo staff
Plugin URI: http://akvo.org
Description: Add new Akvo team member easily.
Version: 1.0
Author: Loic Sans
Author URI: http://loicsans.com/
*/


add_action( 'init', 'create_new_staff' );

function create_new_staff() {
    register_post_type( 'new_staffs',
        array(
            'labels' => array(
                'name' => 'Akvo Staff',
                'singular_name' => 'New Staff',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New New Staff',
                'edit' => 'Edit',
                'edit_item' => 'Edit New Staff',
                'new_item' => 'New New Staff',
                'view' => 'View',
                'view_item' => 'View New Staff',
                'search_items' => 'Search New Staffs',
                'not_found' => 'No New Staffs found',
                'not_found_in_trash' => 'No New Staffs found in Trash',
                'parent' => 'Parent New Staff'
            ),
 
            'public' => true,
            'menu_position' => 15,
            'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'taxonomies' => array( '' ),
            'menu_icon' => plugins_url( 'images/akvoStaff_icn.png', __FILE__ ),
            'has_archive' => true
        )
    );
}
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 240, 135, true );
add_action( 'admin_init', 'my_admin' );

function my_admin() {
    add_meta_box( 'new_staff_meta_box',
        'New Staff Details',
        'display_new_staff_meta_box',
        'new_staffs', 'normal', 'high'
    );
}

function display_new_staff_meta_box( $new_staff ) {
    // Retrieve current name of the staff and title based on staff ID
    $staff_name = esc_html( get_post_meta( $new_staff->ID, 'staff_name', true ) );
    $staff_title = esc_html( get_post_meta( $new_staff->ID, 'staff_title', true ) );
    $staff_descr = esc_html( get_post_meta( $new_staff->ID, 'staff_descr', true ) );
    ?>
    <table>
        <tr>
            <td style="width: 100%">New Staff Name</td>
            <td><input type="text" size="80" name="new_staff_name" value="<?php echo $staff_name; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">New Staff title</td>
            <td><input type="text" size="80" name="new_staff_title" value="<?php echo $staff_title; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100%">New Staff DEscription</td>
            <td><textarea type="text" size="80" name="new_staff_descr" value="<?php echo $staff_descr; ?>"></textarea></td>
        </tr>
    </table>
    <?php
}

add_action( 'save_post',
'add_new_staff_fields', 10, 2 );

function add_new_staff_fields( $new_staff_id, $new_staff ) {
    // Check post type for new Staffs
    if ( $new_staff->post_type == 'new_staffs' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['new_staff_name'] ) && $_POST['new_staff_name'] != '' ) {
            update_post_meta( $new_staff_id, 'staff_name', $_POST['new_staff_name'] );
        }
        if ( isset( $_POST['new_staff_title'] ) && $_POST['new_staff_title'] != '' ) {
            update_post_meta( $new_staff_id, 'staff_title', $_POST['new_staff_title'] );
        }
        if ( isset( $_POST['new_staff_descr'] ) && $_POST['new_staff_descr'] != '' ) {
            update_post_meta( $new_staff_id, 'staff_descr', $_POST['new_staff_descr'] );
        }
    }
}


add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function( $template_path ) {
    if ( get_post_type() == 'new_staffs' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-new_staffs.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path( __FILE__ ) . '/single-new_staffs.php';
            }
        }
		  elseif ( is_archive() ) {
            if ( $theme_file = locate_template( array ( 'archive-new_staffs.php' ) ) ) {
                $template_path = $theme_file;
            } else { $template_path = plugin_dir_path( __FILE__ ) . '/archive-new_staffs.php';
 
            }
    }
	}
    return $template_path;
}

//CREATE CUSTOM TAXONOMIES

add_action( 'init', 'create_my_taxonomies', 0 );

function create_my_taxonomies() {
    register_taxonomy(
        'new_staffs_team',
        'new_staffs',
        array(
            'labels' => array(
                'name' => 'Akvo staff team',
                'add_new_item' => 'Add New Akvo Team',
                'new_item_name' => "New Akvo Team"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
?>