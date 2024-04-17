<?php
// check-login.php

// Load WordPress
require_once("wp-load.php");

// Check if user is logged in
$is_logged_in = is_user_logged_in();

// List of menu items to be disabled for non-logged-in users
$disabled_menu_items = array('eLEJA', 'eHARTA', 'eARKITEKTI', 'eNDIHMA', 'Gjeoportali', 'eRegulativa');

// Output JavaScript code to add class to disabled menu items
?>
<script>
    var isUserLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;

    jQuery(function($) {
        // Check if the user is not logged in
        if (!isUserLoggedIn) {
            // Loop through each disabled menu item and add 'disabled' class
            <?php foreach ($disabled_menu_items as $item) : ?>
                $('.menu-item:contains("<?php echo $item; ?>")').addClass('disabled');
            <?php endforeach; ?>
        }
    });
</script>