<!-- header.php -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light mt-0 custom-navbar">
            <a class="navbar-brand" href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/logo.png" alt="Logo" height="60" class="d-inline-block align-top m-2">
                <span class="logo-text fs-1"><b>info</b>PAGE</span>
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
            <div class="d-flex gap-2 bg-dark text-white p-4 mt-0 rounded-1"> <!-- Move this div to the right -->
            <div class="search-container">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label>
                        <span class="screen-reader-text"><?php _e('Search for:', 'shak-ks_theme'); ?></span>
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'shak-ks_theme'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    </label>
                </form>
            </div>
            <?php echo do_shortcode('[google-translator]'); ?>
                <!-- <a class="nav-link mt-2" href="#">Favorites</a> -->
                <a class="btn btn-outline-light rounded-5" href="<?php echo get_stylesheet_directory_uri(); ?>/login-form/">Log in</a>
            </div>
        </nav>
    </header>

    <main>
