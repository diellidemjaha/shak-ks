<?php
// functions.php

// Enqueue custom styles and Bootstrap 5
function enqueue_custom_styles() {
    wp_add_inline_script('jquery-compat', 'var $ = jQuery.noConflict();');
    wp_enqueue_script('jquery');
    // Enqueue Bootstrap 5 CSS
    wp_enqueue_style('shak-bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    
    // Enqueue custom styles
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/custom-style.css');
    
    // Enqueue Bootstrap 5 JS
    wp_enqueue_script('shak-bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '0.1', true);
    
    // Enqueue jQuery in compatibility mode
    wp_enqueue_script('jquery-compat', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Add theme support for navigation menus
function custom_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shak-ks'),
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

// Add theme support for post thumbnails
add_theme_support('post-thumbnails');
add_theme_support('comments');

// Register custom post type 'lajmet'
function register_lajmet_post_type() {
    register_post_type('lajmet', array(
        'labels' => array(
            'name' => __('Lajmet'),
            'singular_name' => __('Lajmi'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
    ));
}
add_action('init', 'register_lajmet_post_type');

// Register custom post type 'temat_e_diskutimit'
function register_temat_e_diskutimit_post_type() {
    register_post_type('temat_e_diskutimit', array(
        'labels' => array(
            'name' => __('Temat e Diskutimit'),
            'singular_name' => __('Tema'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
    ));
}
add_action('init', 'register_temat_e_diskutimit_post_type');

// Function to handle user registration
function register_user_on_post() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && isset($_POST['registration_form'])) {
        // Sanitize and validate form data
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        // Create a new user with a hashed password
        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            // Registration successful
            wp_redirect(home_url('/registration-successful/')); // Redirect to success page
            exit;
        } else {
            // Registration failed
            $error_message = $user_id->get_error_message();
            wp_redirect(home_url('/registration-form/?registration_error=' . urlencode($error_message)));
            exit;
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

// Allow only logged-in users to post comments
function restrict_comments_to_logged_in_users($open, $post_id) {
    // Check if the post type is 'lajmet' or 'temat_e_diskutimit'
    if (get_post_type($post_id) === 'lajmet' || get_post_type($post_id) === 'temat_e_diskutimit') {
        // Check if the user is not logged in
        if (!is_user_logged_in()) {
            return false; // Disable comments for non-logged-in users
        }
    }
    return $open; // Allow comments for other cases
}
add_filter('comments_open', 'restrict_comments_to_logged_in_users', 10, 2);

// Allow administrators to edit all comments
function allow_administrator_to_edit_all_comments($caps, $cap, $user_id, $args) {
    // Check if the user has the 'administrator' role
    $user = get_userdata($user_id);
    if ($user && in_array('administrator', $user->roles)) {
        $caps[$cap[0]] = true;
    }
    return $caps;
}
add_filter('user_has_cap', 'allow_administrator_to_edit_all_comments', 10, 4);

// Add support for comments to custom post type 'temat_e_diskutimit'
add_action('init', 'add_comments_support_to_temat_e_diskutimit');
function add_comments_support_to_temat_e_diskutimit() {
    add_post_type_support('temat_e_diskutimit', 'comments');
}

function custom_menu_item_classess($classes, $item, $args) {
    // Check if the current user is not logged in
    if (!is_user_logged_in()) {
        // Check if the menu item corresponds to "Link 10" or is a parent of "Link 10"
        if ($item->title === 'Translated link' || in_array('menu-item-has-children', $item->classes)) {
            // Add the "disabled" class
            $classes[] = 'disabled';
            // Add custom data attribute to store disabled status
            $item->url .= ' data-disabled="true"';
        }
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'custom_menu_item_classess', 10, 3);

// JavaScript function to prevent clicking on disabled links
function custom_disable_links_script() {
    ?>
    <style>
        .menu-item.disabled a {
            pointer-events: none;
            cursor: default;
        }
    </style>
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            var disabledLinks = document.querySelectorAll('.menu-item.disabled a');
            disabledLinks.forEach(function (link) {
                link.removeAttribute('title'); // Remove the title attribute to hide the tooltip
                link.addEventListener('click', function (event) {
                    if (link.getAttribute('data-disabled') === 'true') {
                        event.preventDefault();
                        alert('This link is disabled.');
                    }
                });
            });
        });
    </script>
    <?php
}

add_action('wp_footer', 'custom_disable_links_script');

function custom_logout_redirect() {
    wp_redirect(home_url()); // Redirect to home page
    exit();
}

add_action('wp_logout', 'custom_logout_redirect');

function disable_links_for_non_logged_in_users($content) {
    // Check if the user is not logged in
    if (!is_user_logged_in()) {
        // Disable pointer events for links
        $content = preg_replace('/<a(.*?)>/', '<a$1 style="pointer-events: none;">', $content);
    }

    return $content;
}

add_filter('the_content', 'disable_links_for_non_logged_in_users');

// Save custom fields during user registration and profile update
function save_custom_registration_fields($user_id) {
    if (isset($_POST['personal_id'])) {
        update_user_meta($user_id, 'personal_id', sanitize_text_field($_POST['personal_id']));
    }

    if (isset($_POST['address'])) {
        update_user_meta($user_id, 'address', sanitize_text_field($_POST['address']));
    }
}
add_action('user_register', 'save_custom_registration_fields');
add_action('profile_update', 'save_custom_registration_fields');

// Display custom fields in user profile
function show_custom_user_fields($user) {
    ?>
    <h3>Additional Information</h3>

    <table class="form-table">
        <tr>
            <th><label for="personal_id">Personal ID Number</label></th>
            <td>
                <?php echo esc_html(get_user_meta($user->ID, 'personal_id', true)); ?>
            </td>
        </tr>
        <tr>
            <th><label for="address">Address</label></th>
            <td>
                <?php echo esc_html(get_user_meta($user->ID, 'address', true)); ?>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'show_custom_user_fields');
add_action('edit_user_profile', 'show_custom_user_fields');


//TEST

// Function to add custom roles
// Function to add custom roles
function add_custom_roles() {
    // Check if 'role1' doesn't exist before adding it
    if (!get_role('role1')) {
        add_role('role1', 'Role 1', array(
            'read_link11' => true,
            'read'        => true,
        ));

        // Assign capabilities for 'role1' to access "Link 11"
        $role1 = get_role('role1');
        $role1->add_cap('read_link11');
    }

    // Check if 'role2' doesn't exist before adding it
    if (!get_role('role2')) {
        add_role('role2', 'Role 2', array(
            'read_linka' => true,
            'read'       => true,
        ));

        // Assign capabilities for 'role2' to access "Link a"
        $role2 = get_role('role2');
        $role2->add_cap('read_linka');
    }
}

// Hook the function to run when the theme is activated
add_action('after_switch_theme', 'add_custom_roles');

// Function to remove custom roles on theme deactivation
function remove_custom_roles_on_theme_deactivation() {
    remove_role('role1');
    remove_role('role2');
}

// Hook the function to run when the theme is deactivated
add_action('switch_theme', 'remove_custom_roles_on_theme_deactivation');

// Function to modify menu item classes and disable links for 'role1' and 'role2'
function custom_menu_item_classes($classes, $item, $args) {
    // Check if the user is logged in
    if (is_user_logged_in()) {
        // Get the current user's roles
        $user_roles = wp_get_current_user()->roles;

        // Check if the user has 'role1' and the menu item corresponds to "Link 11" or is a parent of "Link 11"
        if (in_array('role1', $user_roles) && ($item->title === 'Link 11' || in_array('menu-item-has-children', $item->classes))) {
            return $classes; // Link is enabled for 'role1'
        }

        // Check if the user has 'role2' and the menu item corresponds to "Link a" or is a parent of "Link a"
        if (in_array('role2', $user_roles) && ($item->title === 'Link a' || in_array('menu-item-has-children', $item->classes))) {
            return $classes; // Link is enabled for 'role2'
        }
    }

    // User is not logged in or doesn't have the required role, disable links
    $classes[] = 'disabled';
    $item->url .= ' data-disabled="true"';
    
    return $classes;
}

add_filter('nav_menu_css_class', 'custom_menu_item_classes', 10, 3);