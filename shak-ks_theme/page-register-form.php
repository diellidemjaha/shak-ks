    <?php
    // registration-form.php
    get_header(); // Include if necessary

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
                        <form id="registration-form"  action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                            <input type="hidden" name="action" value="custom_register_user">
                            <input type="hidden" name="registration_form" value="1">
                            <div class="mb-3">
                                <label for="role" class="form-label">Zgjedh rolin:</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="shfrytezues_i_loguar">Shfrytezues i loguar</option>
                                    <option value="vizitor_i_loguar">Vizitor i loguar</option>
                                    <option value="shfrytezues_i_autorizuar">Shfrytezues i autorizuar</option>
                                    <option value="kompani_e_autorizuar">Kompani e autorizuar</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Emri:</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Mbiemri:</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="mb-3">
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
                                <label for="personal_id" class="form-label">Nr Personal i ID-së:</label>
                                <input type="text" class="form-control" id="personal_id" name="personal_id">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Kredencialet:</label>
                                <input type="text" class="form-control" id="credentials" name="credentials">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="submit">Regjistrohu</button>
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

    <script>
    // JavaScript to show/hide fields based on selected role
    jQuery(document).ready(function($) {
        $('#role').change(function() {
            var selectedRole = $(this).val();

            // Show/hide fields based on selected role
            if (selectedRole === 'vizitor_i_loguar') {
                $('#firstname, #lastname, #email, #username, #password').closest('.mb-3').show();
                $('#personal_id, #credentials').closest('.mb-3').hide();
            } else if (selectedRole === 'shfrytezues_i_loguar') {
                $('#firstname, #lastname, #email, #username, #password, #personal_id').closest('.mb-3').show();
                $('#credentials').closest('.mb-3').hide();
            } else if (selectedRole === 'shfrytezues_i_autorizuar' || selectedRole === 'kompani_e_autorizuar') {
                $('#firstname, #lastname, #email, #username, #password, #personal_id, #credentials').closest('.mb-3').show();
            }
        });
    });
</script>
