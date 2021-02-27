<?php
add_action('wp_enqueue_scripts', 'twentysixteen_child_assets');
function twentysixteen_child_assets() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('twentysixteen_child', get_template_directory_uri() . '/script.js', array('jquery'), '1.0.0', true);
}