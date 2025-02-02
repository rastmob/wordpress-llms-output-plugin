<?php
/*
Plugin Name: LLMs Training
Plugin URI: https://github.com/rastmob/wordpress-llms-output-plugin
Description: A WordPress plugin to export posts, pages, and custom post types as JSON for training Language Models (LLMs).
Version: 1.0
Author: Mehmet Alp
Author URI: https://www.rastmobile.com
License: GPLv2 or later
Text Domain: llms-training
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu
function llms_training_add_menu() {
    add_menu_page(
        'LLMs Training', // Page title
        'LLMs Training', // Menu title
        'manage_options', // Capability
        'llms-training', // Menu slug
        'llms_training_page', // Callback function
        'dashicons-database-export', // Icon
        6 // Position
    );
}
add_action('admin_menu', 'llms_training_add_menu');

// Admin page content
function llms_training_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_POST['llms_export'])) {
        llms_training_export_data();
    }

    ?>
    <div class="wrap">
        <h1>LLMs Training - Export Data</h1>
        <form method="post">
            <p>Click the button below to export your WordPress content as JSON.</p>
            <input type="submit" name="llms_export" class="button button-primary" value="Export Data">
        </form>
    </div>
    <?php
}

// Export data as JSON
function llms_training_export_data() {
    $args = array(
        'post_type' => array('post', 'page'), // Add custom post types if needed
        'posts_per_page' => -1, // Export all posts
        'post_status' => 'publish'
    );

    $posts = get_posts($args);
    $data = array();

    foreach ($posts as $post) {
        $post_data = array(
            'id' => $post->ID,
            'title' => $post->post_title,
            'content' => $post->post_content,
            'excerpt' => $post->post_excerpt,
            'slug' => $post->post_name,
            'date' => $post->post_date,
            'modified' => $post->post_modified,
            'author' => get_the_author_meta('display_name', $post->post_author),
            'categories' => wp_get_post_categories($post->ID, array('fields' => 'names')),
            'tags' => wp_get_post_tags($post->ID, array('fields' => 'names'))
        );
        array_push($data, $post_data);
    }

    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Save JSON to a file
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/llms-training-export.json';
    file_put_contents($file_path, $json);

    // Provide download link
    $file_url = $upload_dir['baseurl'] . '/llms-training-export.json';
    echo '<div class="updated"><p>Data exported successfully! <a href="' . $file_url . '" download>Download JSON File</a></p></div>';
}