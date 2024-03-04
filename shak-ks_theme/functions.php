<?php
// functions.php

// Enqueue custom styles
// Enqueue custom styles and Bootstrap 5
function enqueue_custom_styles() {

    wp_register_style('shak-bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_register_script('shak-bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '0.1', true );
 // Enqueue Bootstrap 5 CSS
 wp_enqueue_style('shak-bootstrap-style');

 // Enqueue custom styles
 wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/custom-style.css');

 // Enqueue Bootstrap 5 JS
 wp_enqueue_script('shak-bootstrap-script');
    // Enqueue jQuery in compatibility mode
    wp_enqueue_script('jquery-compat', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true);
    wp_add_inline_script('jquery-compat', 'var $ = jQuery.noConflict();');

}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Add theme support for navigation menus
function custom_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shak-ks'),
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');


function register_user_on_post() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
        // Sanitize and validate form data
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        // Create a new user with hashed password
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            // Registration successful
            wp_redirect(home_url('/registration-successful/')); // Redirect to success page
            exit;
        } else {
            // Registration failed
            $error_message = $user_id->get_error_message();
            echo "Registration failed: $error_message";
        }
    }
}
add_action('init', 'register_user_on_post');

// Customize login redirection
function custom_login_redirect($redirect_to, $request, $user) {
    // Redirect all users to the home page
    return home_url('/');
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);