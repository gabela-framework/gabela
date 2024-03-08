<?php

namespace Gabela\Controller;

use Gabela\Model\User;

class OldPasswordSubmitController
{
    /**
     * @var User
     */
    private User $userCollection;

    /**
     * Password reset constructor
     *
     * @param User $userCollection
     */
    public function __construct(User $userCollection)
    {
        $this->userCollection = $userCollection;
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data (new password)
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            // Check if the passwords match
            if ($newPassword === $confirmPassword) {
                // Check if the provided email and token are valid
                if (isset($_GET['email']) && isset($_GET['token'])) {
                    $email = $_GET['email']; // You can get these from the query parameters.
                    $token = $_GET['token'];

                    //$user = new User(); // Assuming you have a User class with appropriate methods.

                    if ($this->userCollection->isValidPasswordResetRequest($email, $token)) {
                        // Update the user's password (ensure it's securely hashed)
                        $this->userCollection->updatePassword($email, $newPassword);

                        // Password updated successfully

                        printValue('<meta http-equiv="refresh" content="5;url=/">');

                        // return redirect('');

                        exit; // Terminate script execution
                    } else {
                        // Invalid request
                        $resetPasswordError = "Invalid or expired reset link.";
                    }
                } else {
                    $resetPasswordError = "Email or token is not valid make sure the link is valid or <a href='/'>log in again</a>";
                }
            } else {
                // Passwords don't match
                $resetPasswordError = "Passwords do not match.";
            }
        }
    }
}
