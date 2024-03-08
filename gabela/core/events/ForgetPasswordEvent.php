<?php

namespace Gabela\Core\Events;

class ForgetPasswordEvent
{
    private $email;
    private $resetToken;
    private $message;

    public function __construct(
        $email, 
        $resetToken,
        $message
        )
    {
        $this->email = $email;
        $this->resetToken = $resetToken;
        $this->message = $message;
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
