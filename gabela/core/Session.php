<?php

namespace Gabela\Core;

class Session
{
    public function getCurrentUserId()
    {
        return $_SESSION['user_id'];
    }

    public function getCurrentUsername()
    {
        return $_SESSION['user_name'];
    }

    public function getCurremtUser()
    {
        $currentUser = [
            'id' => $this->getCurrentUserId(),
            'name' => $this->getCurrentUsername(),
            'email' => $_SESSION['user_email'],
        ];

        return $currentUser;
    }
}