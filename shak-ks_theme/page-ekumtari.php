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
                    <p class="card-text">Shiqo lajmet e fundit.</p>
                    <a href="<?php echo get_post_type_archive_link('lajmet'); ?>" class="btn btn-primary">Shiqo Lajmet</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Temat e Diskutimit</h5>
                    <p class="card-text">Eksploroni dhe diskutoni temat e ndryshme.</p>
                    <a href="<?php echo get_post_type_archive_link('temat_e_diskutimit'); ?>" class="btn btn-primary">Shiqo Temat e Diskutimit</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
