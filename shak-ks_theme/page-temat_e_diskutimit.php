
<?php
/*
 * Template Name: Temat e Diskutimit Page
 */

get_header();
?>

<!-- <div class="container bg-light"> -->

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
        <div class="container bg-light">
            <?php
            while (have_posts()) : the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header text-light m-0">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <?php echo 'Published on ' . get_the_date(); ?>
                        </div>
                    </header><!-- .entry-header -->
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!-- .entry-content -->
                    
                    <footer class="entry-footer">
                        <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
                    </footer><!-- .entry-footer -->
                </article><!-- #post-<?php the_ID(); ?> -->
                
                <?php comments_template(); ?>
            <?php endwhile; ?>
        </div>
        </main><!-- #main -->
    </div><!-- #primary -->
    
<?php get_footer(); ?>
