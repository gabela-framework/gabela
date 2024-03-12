<?php

namespace Gabela\Core\Events;

class ForgetPasswordEvent
{
    private $email;
    private $resetToken;
    private $message;

    public function __construct(
        $email, 
        $message,
        $resetToken
        )
    {
        $this->email = $email;
        $this->message = $message;
        $this->resetToken = $resetToken;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getResetToken()
    {
        return $this->resetToken;
    }

    public function getResetMessage()
    {
        return $this->message;
    }
}
