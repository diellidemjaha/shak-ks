<!-- header.php -->

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light mt-0">
            <a class="navbar-brand" href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/logo.png" alt="Logo" height="60" class="d-inline-block align-top">
                <span class="logo-text fs-1">infoPAGE</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-links">
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
            <div class="d-flex gap-2 bg-dark text-white p-4 mt-0"> <!-- Move this div to the right -->
                <div class="search-container">
                    <?php get_search_form(); ?>
                </div>
                <a class="nav-link" href="#">Favorites</a>
                <a class="btn btn-outline-light" href="#">Log in</a>
            </div>
        </nav>
    </header>

    <main>
