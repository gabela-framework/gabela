<?php

/**
 * @package   Task Management
 * @author    Ntabethemba Ntshoza
 * @date      11-10-2023
 * @copyright Copyright © 2023 VMP By Maneza
 */

?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <!-- Include your CSS and Bootstrap links here -->

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="assets/includes/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php if (isset($_SESSION['reset_password'])) : ?>
                    <div class="alert alert-success"><?php printValue($_SESSION['reset_password']); ?></div>
                    <?php unset($_SESSION['reset_password']); // Clear the message after displaying
                    ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_password'])) : ?>
                    <div class="alert alert-error"><?php printValue($_SESSION['error_password']); ?></div>
                    <?php unset($_SESSION['error_password']);
                    ?>
                <?php endif; ?>

                <h1 class="text-center">Reset Your Password</h1>
                <?php if (isset($resetPasswordSuccess)) : ?>
                    <p class="text-success"><?php printValue($resetPasswordSuccess); ?></p>
                <?php endif; ?>

                <?php if (isset($resetPasswordError)) : ?>
                    <p class="text-success"><?php printValue($resetPasswordError); ?></p>
                <?php endif; ?>

                <form method="post" action="<?= EXTENTION_PATH ?>/reset-password-submit">
                    <div class="form-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="form-control" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include your scripts or links to JavaScript files if needed -->

    <!-- Include Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>