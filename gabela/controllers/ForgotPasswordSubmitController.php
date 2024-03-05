<?php

namespace Gabela\Controller;

getRequired(USER_MODEL);

use Throwable;
use Monolog\Logger;
use Gabela\Model\User;
use Monolog\Handler\StreamHandler;

class ForgotPasswordSubmitController
{
    private $logger;

    public function __construct($logger = null)
    {
        $this->logger = new Logger('users-controller');
        $this->logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the email is submitted
            if (isset($_POST['email'])) {
                $email = $_POST['email'];

                $user = new User();

                $user->setEmail($email);

                try {
                    if ($user->forgotPassword($email)) {

                        return redirect('/forgot-password');
                    }
                } catch (Throwable $e) {
                    $this->logger->error('An exception occurred', ['exception' => $e]);
                }
            }
        }
    }
}
