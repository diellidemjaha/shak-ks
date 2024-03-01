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

// Filter to modify the menu items
function custom_nav_menu_items($items, $menu, $args) {
    // Check if the 'theme_location' property exists in the $args array
    if (isset($args->theme_location) && $args->theme_location == 'primary') {
        // Check if the user is logged in
        if (is_user_logged_in()) {
            // Find the menu item with the title "Link 1"
            $link1_item = false;
            foreach ($items as $item) {
                if ($item->title == 'Link 1') {
                    $link1_item = $item;
                    break;
                }
            }

            // If "Link 1" is found, modify its sub-items
            if ($link1_item) {
                foreach ($link1_item->children as $child) {
                    // If the sub-item is "c" and the user is not an admin, remove it
                    if ($child->title == 'c' && !current_user_can('administrator')) {
                        unset($link1_item->children[$child->ID]);
                    }
                }
            }
        }
    }
    return $items;
}
add_filter('wp_get_nav_menu_items', 'custom_nav_menu_items', 10, 3);


