<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
        ?>
                <div class="container bg-light mt-2 mb-2">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="card vh-50 mt-3 p-4 h-100 custom-box">
                            <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <div class="entry-meta">
                                </div>
                            </header><!-- .entry-header -->
                            
                            <div class="entry-content">
                                </div><!-- .entry-content -->
                                
                                <?php echo '<div class="mt-0">Published on ' . get_the_date(); '</div>'?>
                        <!-- <footer class="entry-footer"> -->
                            <?php edit_post_link('Edit', '<span class="edit-link">', '</span>'); ?>
                    <!-- .entry-footer -->
                    </article><!-- #post-<?php the_ID(); ?> -->
                </div>
                </div>
        <?php
            endwhile;
        else :
            // Display a message when no search results are found
            echo '<p>' . esc_html__('No results found.', 'shak-ks_theme') . '</p>';
        endif;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
