<?php
/*
 * Template Name: User Registered Template
 */

 get_header(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Registered</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your Custom Styles -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center">
                    <!-- Icon or Image for User Registered -->
                    <i class="bi bi-check-circle text-success fs-1"></i>
                    <h1 class="mt-3">User Registered!</h1>
                    <p>Welcome to shak-ks! You are now a subscriber.</p>
                    
                    <!-- Homepage Link -->
                    <p class="mt-3">
                        Go to <a href="<?php echo home_url(); ?>" class="btn btn-primary">Homepage of shak-ks</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
