<?php
/*
 * Fashion Blog functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fashion Blog
*/

// Loads parent theme stylesheet
// Do not delete this
function fashion_blog_scripts()
{
    wp_enqueue_style('galway-lite', get_template_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'fashion_blog_scripts', 20);

// Loads custom stylesheet and js for child. 
// This could override all stylesheets of parent theme and custom js functions
function fashion_blog_custom_scripts()
{
    wp_enqueue_style('fashion-blog', get_stylesheet_directory_uri() . '/custom.css');
}

add_action('wp_enqueue_scripts', 'fashion_blog_custom_scripts', 60);

require_once( get_stylesheet_directory(). '/inc/hooks/slider.php' );
