<?php

/*
Plugin Name: Default Comment Plugin
Description: Adds a default comment to every new post.
Version: 1.0
Author: ali zeinodin
*/

// Hook into the 'wp_insert_post' action to add a default comment
add_action('wp_insert_post', 'default_comment_on_post_publish', 10, 2);

function default_comment_on_post_publish($post_ID, $post) {
    // Check if the post is new (not an update)
    if ($post->post_status == 'publish' && $post->post_date_gmt == $post->post_modified_gmt) {
        // Set the default comment content
        $default_comment_content = "Thank you for reading this post!";

        // Set the default comment author
        $default_comment_author = "Default Commenter";

        // Set the default comment data
        $comment_data = array(
            'comment_post_ID' => $post_ID,
            'comment_content' => $default_comment_content,
            'comment_author' => $default_comment_author,
            'comment_approved' => 1, // 1 means the comment is approved, 0 means it is pending
        );

        // Insert the default comment
        wp_insert_comment($comment_data);
    }
}