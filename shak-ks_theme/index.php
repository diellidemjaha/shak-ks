

<?php get_header(); ?>

<div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
        <?php
        // Your existing loop for search results
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article <?php post_class('col'); ?>>
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="card-text">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
            endwhile;
        else :
            // Display a message when no search results are found
            echo '<p>' . esc_html__('No results found.', 'shak-ks_theme') . '</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
