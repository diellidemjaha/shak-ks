<?php
if (comments_open() || get_comments_number()) :
?>
   <div id="comments" class="comments-area">
    <h2 class="comments-title">
        <?php
        $comment_count = get_comments_number();
        if ($comment_count === 1) {
            echo 'One Comment';
        } else {
            echo $comment_count . ' Comments';
        }
        ?>
    </h2>

    <ul class="comment-list">
        <?php
        wp_list_comments(array(
            'style'       => 'ul',
            'short_ping'  => true,
            'avatar_size' => 42,
        ));
        ?>
    </ul>

    <?php
    the_comments_pagination(array(
        'prev_text' => '&laquo; Previous',
        'next_text' => 'Next &raquo;',
    ));
    ?>
</div>


        <?php comment_form(); ?>

    </div>

<?php
endif; 
?>
