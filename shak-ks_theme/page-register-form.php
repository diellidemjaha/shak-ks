<?php
get_header();

if (isset($_GET['registration_error'])) {
    $error_message = urldecode($_GET['registration_error']);
    echo '<div class="registration-error alert alert-danger mt-3">' . esc_html($error_message) . '</div>';
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/logo.png" alt="Logo" class="img-fluid" style="max-height: 100px;">
                        <div class="font-weight-bold fs-2">shak-ks</div>
                    </div>

                    <!-- Registration Form -->
                    <form id="registration-form" action="<?php echo esc_url(home_url('/registration-form/')); ?>" method="post">
                        <div class="mb-3">
                        <input type="hidden" name="registration_form" value="1">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="personal_id" class="form-label">Personal ID Number:</label>
                            <input type="text" class="form-control" id="personal_id" name="personal_id" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" name="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

