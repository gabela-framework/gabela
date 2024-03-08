<?php

namespace Gabela\Controller;

//getRequired(USER_MODEL);

use Gabela\Core\Events\ForgetPasswordEvent;
use Gabela\Model\User;
use League\Event\EventDispatcher;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Throwable;

class ForgotPasswordSubmitController
{
    private $logger;

    /**
     * @var EventDispatcher
     */
    private EventDispatcher $dispatcher;

    /**
     * @var User
     */
    private User $userCollection;

    /**
     * @var EmailSenderController
     */
    private EmailSenderController $emailSender;

    public function __construct(EventDispatcher $dispatcher, User $userCollection, EmailSenderController $emailSender)
    {
        $this->logger = new Logger('users-controller');
        $this->logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
        $this->dispatcher = $dispatcher;
        $this->userCollection = $userCollection;
        $this->emailSender = $emailSender;
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if the email is submitted
            if (isset($_POST['email'])) {
                $email = $_POST['email'];

                $this->userCollection->setEmail($email);

                try {
                    if ($this->userCollection->forgotPassword($email)) {
                        // Retrieve the message and token returned by forgotPassword()
                        $result = $this->userCollection->forgotPassword($email);
                        $message = $result['message'];
                        $token = $result['token'];

                        $event = new ForgetPasswordEvent($email, $message, $token);
                        $this->dispatcher->dispatch($event);

                        $this->emailSender->sendForgetPasswordEmail($email, $message, $token); // send the email without the dispatcher

                        return redirect('/login');
                    }
                } catch (Throwable $e) {
                    $this->logger->error('An exception occurred', ['exception' => $e]);
                }
            }
        }
    }
}
