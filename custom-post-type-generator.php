<?php
/**
 * Plugin Name: Custom Post Type Generator
 * Description: A plugin to generate custom post types easily.
 * Version: 1.0.0
 */

// Define constants
define( 'CPT_GENERATOR_VERSION', '1.0.0' );
define( 'CPT_GENERATOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Include plugin functions
require_once( CPT_GENERATOR_PLUGIN_DIR . 'includes/cpt-generator-functions.php' );

// Register Custom Post Types
function cpt_generator_register_custom_post_types() {
    // Check if the form has been submitted
    if ( isset( $_POST['cpt_name'] ) && isset( $_POST['cpt_slug'] ) ) {
        $post_type = sanitize_text_field( $_POST['cpt_name'] );
        $slug = sanitize_title( $_POST['cpt_slug'] );
        
        // Arguments for the custom post type
        $args = array(
            'labels' => array(
                'name' => $post_type,
                'singular_name' => $post_type,
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array( 'slug' => $slug ),
            'show_in_rest' => true,  // This enables Gutenberg support
        );

        // Register the custom post type
        register_post_type( $slug, $args );
    }
}
add_action( 'init', 'cpt_generator_register_custom_post_types' );

// Admin page for Custom Post Type Generator
function cpt_generator_admin_page() {
    ?>
    <div class="wrap">
        <h1>Custom Post Type Generator</h1>
        <form method="post" action="">
            <label for="cpt_name">Custom Post Type Name:</label>
            <input type="text" id="cpt_name" name="cpt_name" required>
            
            <label for="cpt_slug">Custom Post Type Slug:</label>
            <input type="text" id="cpt_slug" name="cpt_slug" required>
            
            <input type="submit" value="Generate Post Type" class="button-primary">
        </form>
    </div>
    <?php
}

function cpt_generator_menu() {
    add_menu_page( 'Custom Post Type Generator', 'CPT Generator', 'manage_options', 'cpt-generator', 'cpt_generator_admin_page', 'dashicons-edit', 20 );
}
add_action( 'admin_menu', 'cpt_generator_menu' );

