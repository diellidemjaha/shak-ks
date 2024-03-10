<?php
/*
 * Template Name: Lajmet Page
 */

get_header();
?>


<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container bg-light">
            <?php
            $lajmet_query = new WP_Query(array(
                'post_type' => 'lajmet',
                'posts_per_page' => -1,
            ));

            while ($lajmet_query->have_posts()) : $lajmet_query->the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header text-light mb-0">
                        <h1 class="entry-title"><a style="color:white; text-decoration:none;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                        <div class="entry-meta">
                            <?php echo 'Published on ' . get_the_date(); ?>
                        </div>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                    <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('full', array('class' => 'img-fluid'));
                        }
                        the_content();
                        ?>
                    </div><!-- .entry-content -->

                    <footer class="entry-footer">
                        <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

