<?php
/*
 * Template Name: eKUMTARI Page
 */

get_header();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lajmet</h5>
                    <p class="card-text">View the latest news.</p>
                    <a href="<?php echo get_post_type_archive_link('lajmet'); ?>" class="btn btn-primary">View Lajmet</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Temat e Diskutimit</h5>
                    <p class="card-text">Explore and discuss various topics.</p>
                    <a href="<?php echo get_post_type_archive_link('temat_e_diskutimit'); ?>" class="btn btn-primary">View Temat e Diskutimit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
