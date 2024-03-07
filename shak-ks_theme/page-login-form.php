
<?php

/*
 * Template Name: Login form Template
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Form</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your Custom Styles -->
    <link rel="stylesheet" href="path/to/your/custom-style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img  src="<?php echo get_stylesheet_directory_uri(); ?>/logo.png" alt="Logo" class="img-fluid" style="max-height: 100px;">
                   <div class="font-weight-bold fs-2">shak-ks</div>
                    </div>
                    
                    <!-- Login Form -->
                    <form id="login-form" action="<?php echo esc_url(site_url('wp-login.php', 'login_post')); ?>"  method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="login-username" name="log" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="login-password" name="pwd" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="login">Login</button>
                        </div>
                    </form>
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
