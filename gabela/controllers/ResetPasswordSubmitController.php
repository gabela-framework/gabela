<?php

namespace Gabela\Controller;

//getRequired(USER_MODEL);

use Gabela\Model\User;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ResetPasswordSubmitController
{
    private $logger;

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
        // Create a log channel
        $this->logger = new Logger('reset_password_submit');
        $this->logger->pushHandler(new StreamHandler('var/System.log', Logger::ERROR));
        $this->userCollection = $userCollection;
    }

    public function submit()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get form data (new password)
                $newPassword = $_POST['newPassword'];
                $confirmPassword = $_POST['confirmPassword'];

                // Check if the passwords match
                if ($newPassword === $confirmPassword) {
                    // Check if the provided email and token are valid
                    if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
                        $email = $_SESSION['email'];
                        $token = $_SESSION['token'];
                    }

                    // Check if the provided email and token are valid
                    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

                    if (!empty($email) && !empty($token)) {

                        if ($this->userCollection->isValidPasswordResetRequest($email, $token)) {
                            // Update the user's password (ensure it's securely hashed)
                            $this->userCollection->updatePassword($email, $newPassword);

                            if (isset($_SESSION['email']) && isset($_SESSION['token'])) {
                                unset($_SESSION['email']);
                                unset($_SESSION['token']);
                            }

                            return redirect('/login');
                        } else {
                            // Invalid request
                            $errorMessage = "Email or token is not valid. Make sure the link is valid or try to <a href='" . EXTENTION_PATH . "/login'>log in again</a>";
                            $this->logger->error($errorMessage);

                            $_SESSION['error_password'] = $errorMessage;

                            return redirect('/reset-password');
                        }
                    } else {
                        $errorMessage = "Email or token is not valid. Make sure the link is valid or try to <a href='" . EXTENTION_PATH . "/login'>log in again</a>";
                        $this->logger->error($errorMessage);

                        printValue($errorMessage);
                        $_SESSION['error_password'] = $errorMessage;

                        return redirect('/reset-password');
                    }
                } else {
                    // Passwords don't match
                    $resetPasswordError = "Passwords do not match.";
                    $this->logger->error($resetPasswordError);
                }
            }

            return redirect('/reset-password-submit');
        } catch (\Exception $e) {
            // Log any unexpected exceptions
            $this->logger->error('An unexpected exception occurred', ['exception' => $e]);
            // You may choose to display a generic error message or handle it accordingly.
        }
    }
}
