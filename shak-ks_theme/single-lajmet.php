<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container bg-light">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="entry-header mt-2 mb-2">
                        <?php the_title('<h1 class="entry-title mb-3">', '</h1>'); ?>
                        <div class="entry-meta">
                           <div class="fs-1" style="color:black;" <?php echo 'Published on ' . get_the_date() . '</div>'; ?>
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

                        <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
                </article><!-- #post-<?php the_ID(); ?> -->
            <?php endwhile; ?>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
