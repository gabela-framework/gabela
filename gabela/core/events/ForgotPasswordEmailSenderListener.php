<?php

/**
 * @package   Forgot Password Sender event listner
 * @author    Ntabethemba Ntshoza
 * @date      16-02-2024
 * @copyright Copyright © 2024 VMP By Maneza
 */

namespace Gabela\Core\Events;

use Gabela\Controller\EmailSenderController;
use League\Event\Listener;

class ForgotPasswordEmailSenderListener implements Listener
{
    protected $emailSender;

    /**
     * Email sender event listner
     *
     * @param EmailSenderController $emailSender
     */
    public function __construct(EmailSenderController $emailSender)
    {
        $this->emailSender = $emailSender;
    }

    /**
     * invoke the event
     *
     * @param object $event
     * @return void
     */
    public function __invoke(object $event): void
    {
        $email = $event->getEmail();
        $resetToken = $event->getResetToken();
        $message = $event->getResetMessage();

        $this->emailSender->sendForgetPasswordEmail($email, $message, $resetToken);
    }
}