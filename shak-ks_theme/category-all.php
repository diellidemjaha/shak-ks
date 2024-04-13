<?php
/**
 * Template Name: All Categories
 * Description: A template to display all categories and their respective posts.
 */

get_header(); ?>

<div class="container mt-5">
    <h1 class="text-center" style="color:#05014a;">All Categories</h1>

    <?php
    // Get all categories
    $categories = get_categories();

    // Loop through each category
    foreach ($categories as $category) :
    ?>
        <section class="mt-5">
            <h2 class="text-center"><?php echo $category->name; ?></h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <?php
                // Query posts in this category
                $category_posts = new WP_Query(array(
                    'post_type' => 'ekryeqyteti', // Change to your custom post type name
                    'cat' => $category->term_id,
                    'posts_per_page' => -1, // Display all posts
                ));

                // Loop through posts
                if ($category_posts->have_posts()) :
                    while ($category_posts->have_posts()) : $category_posts->the_post();
                ?>
                        <article <?php post_class('col'); ?>>
                            <div class="card">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="card-text">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </div>
                        </article>
                <?php
                    endwhile;
                else :
                    // Display a message when no posts are found in this category
                    echo '<p>No posts found in this category.</p>';
                endif;
                ?>
            </div>
        </section>
    <?php endforeach; ?>
</div>

<?php
// Restore global post data
wp_reset_postdata();

get_footer();
?>
