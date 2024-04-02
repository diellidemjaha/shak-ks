<?php

// Enqueue custom styles and Bootstrap 5
function enqueue_custom_styles() {
    wp_add_inline_script('jquery-compat', 'var $ = jQuery.noConflict();');
    wp_enqueue_script('jquery');
    wp_enqueue_style('shak-bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    
    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/custom-style.css');
    
    wp_enqueue_script('shak-bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), '0.1', true);
    
    wp_enqueue_script('jquery-compat', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function custom_theme_setup() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'shak-ks'),
    ));
}
add_action('after_setup_theme', 'custom_theme_setup');

add_theme_support('post-thumbnails');
add_theme_support('comments');

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

function register_user_on_post() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) && isset($_POST['registration_form'])) {
        $username = sanitize_user($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $password = $_POST['password'];

        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            wp_redirect(home_url('/registration-successful/')); 
            exit;
        } else {
            $error_message = $user_id->get_error_message();
            wp_redirect(home_url('/registration-form/?registration_error=' . urlencode($error_message)));
            exit;
        }
    }
}
add_action('init', 'register_user_on_post');
function custom_login_redirect($redirect_to, $request, $user) {
    return home_url('/');
}
add_filter('login_redirect', 'custom_login_redirect', 10, 3);

function restrict_comments_to_logged_in_users($open, $post_id) {
    if (get_post_type($post_id) === 'lajmet' || get_post_type($post_id) === 'temat_e_diskutimit') {
        if (!is_user_logged_in()) {
            return false; 
        }
    }
    return $open; 
}
add_filter('comments_open', 'restrict_comments_to_logged_in_users', 10, 2);

function allow_administrator_to_edit_all_comments($caps, $cap, $user_id, $args) {
    $user = get_userdata($user_id);
    if ($user && in_array('administrator', $user->roles)) {
        $caps[$cap[0]] = true;
    }
    return $caps;
}
add_filter('user_has_cap', 'allow_administrator_to_edit_all_comments', 10, 4);

add_action('init', 'add_comments_support_to_temat_e_diskutimit');
function add_comments_support_to_temat_e_diskutimit() {
    add_post_type_support('temat_e_diskutimit', 'comments');
}

function custom_menu_item_classess($classes, $item, $args) {
    if (!is_user_logged_in()) {
        if ($item->title === 'Translated link' || in_array('menu-item-has-children', $item->classes)) {
            $classes[] = 'disabled';
            $item->url .= ' data-disabled="true"';
        }
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'custom_menu_item_classess', 10, 3);

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
                link.removeAttribute('title'); 
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
    wp_redirect(home_url()); 
    exit();
}

add_action('wp_logout', 'custom_logout_redirect');

function disable_links_for_non_logged_in_users($content) {
    if (!is_user_logged_in()) {
        $content = preg_replace('/<a(.*?)>/', '<a$1 style="pointer-events: none;">', $content);
    }

    return $content;
}

add_filter('the_content', 'disable_links_for_non_logged_in_users');

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

//Test of roles below

function add_custom_roles() {
    if (!get_role('role1')) {
        add_role('role1', 'Role 1', array(
            'read_link11' => true,
            'read'        => true,
        ));

        $role1 = get_role('role1');
        $role1->add_cap('read_link11');
    }

    if (!get_role('role2')) {
        add_role('role2', 'Role 2', array(
            'read_linka' => true,
            'read'       => true,
        ));

        $role2 = get_role('role2');
        $role2->add_cap('read_linka');
    }
}

add_action('after_switch_theme', 'add_custom_roles');

function remove_custom_roles_on_theme_deactivation() {
    remove_role('role1');
    remove_role('role2');
}

add_action('switch_theme', 'remove_custom_roles_on_theme_deactivation');

function custom_menu_item_classes($classes, $item, $args) {
    if (is_user_logged_in()) {
        $user_roles = wp_get_current_user()->roles;

        if (in_array('role1', $user_roles) && ($item->title === 'Link 11' || in_array('menu-item-has-children', $item->classes))) {
            return $classes; 
        }

        if (in_array('role2', $user_roles) && ($item->title === 'Link a' || in_array('menu-item-has-children', $item->classes))) {
            return $classes; 
        }
    }

    $classes[] = 'disabled';
    $item->url .= ' data-disabled="true"';
    
    return $classes;
}

add_filter('nav_menu_css_class', 'custom_menu_item_classes', 10, 3);
