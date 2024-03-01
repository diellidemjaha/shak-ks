<?php
// functions.php

function enqueue_custom_styles() {
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/custom-style.css');
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