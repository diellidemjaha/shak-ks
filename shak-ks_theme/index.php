<?php get_header(); ?>
<div class="container m-5">

    <?php
    // Your existing loop for search results
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <article <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
            <?php
        endwhile;
        else :
            // Display a message when no search results are found
            echo '<p>' . esc_html__('No results found.', 'your-theme-text-domain') . '</p>';
        endif;
        ?>

</div>
<?php get_footer(); ?>