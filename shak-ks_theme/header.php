<!-- header.php -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light mt-0 custom-navbar">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/logo.png" alt="Logo" height="60" class="d-inline-block align-top m-2">
                <img src="<?php echo get_template_directory_uri(); ?>/infoPAGE.png" alt="text" height="60" class="d-inline-block align-top">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-links mt-5">
                    <ul class="navbar-nav">
                        <?php
                        // Display the custom menu
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id'        => 'primary-menu',
                            'container'      => false,
                            'menu_class'     => 'navbar-nav',
                        ));
                        ?>
                    </ul>
                </div>
            </div>
            <div class="d-flex gap-2 bg-dark text-white p-4 rounded-1"> <!-- Move this div to the right -->
            <div class="search-container">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label>
                        <span class="screen-reader-text"><?php _e('Search for:', 'shak-ks_theme'); ?></span>
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'shak-ks_theme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                </form>
            </div>
            <?php
                $albanian_link = do_shortcode('[glt language="Albanian" label="SQ" image="no" text="yes" image_size="24"]');
                $croatian_link = do_shortcode('[glt language="Croatian" label="SR" image="no" text="yes" image_size="24"]');
                $english_link = do_shortcode('[glt language="English" label="EN" image="no" text="yes" image_size="24"]');

                echo '<div class="btn btn-secondary">' . $english_link . '</div>';
                echo '<div class="btn btn-secondary">' . $albanian_link . '</div>';
                echo '<div class="btn btn-secondary">' . $croatian_link. '</div>';
                ?>


            <?php
            if (is_user_logged_in()) {
                echo '<a class="btn btn-outline-light rounded-5" href="' . wp_logout_url(home_url()) . '">Log out</a>';
            } else {
                echo '<a class="btn btn-outline-light rounded-5" href="' . get_stylesheet_directory_uri() . '/login-form/">Log in</a>';
            }
            ?>

            </div>
        </nav>
    </header>
    <button type="button" class="btn btn-secondary w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
 Website under construction
</button>
<script>
  jQuery(document).ready(function ($) {
    $('.line-notification').css('display', 'block');
});

</script>
    <main>
