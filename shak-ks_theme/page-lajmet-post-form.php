<?php 
/* Template Name: Frontend Post Form */
get_header(); 
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center mb-4">Posto Lajm të ri</h2>
            <?php 
            if (is_user_logged_in()) :
                // Display form for logged-in users
                ?>
                <form id="submit-post-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title">Titulli i Lajmit</label>
                        <input type="text" class="form-control mb-2" id="post_title" name="post_title" required>
                    </div>
                    <div class="form-group">
                        <label for="post_content">Pershkimi i Lajmit</label>
                        <textarea class="form-control mb-2" id="post_content" name="post_content" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="featured_image">Ngarko Foto</label>
                        <input type="file" class="form-control-file mb-2" id="featured_image" name="featured_image">
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Posto Lajmin</button>
                </form>
                <?php
            else :
                // Display message for non-logged-in users
                echo '<p>You must be logged in to submit a post.</p>';
            endif; 
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
