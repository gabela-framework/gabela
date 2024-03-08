<?php

namespace Gabela\Core;

class Session
{
    public function getCurrentUserId()
    {
        $userID = null;

        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];
        } else {
            throw new \InvalidArgumentException('User Session is not available you need to login first.');
        }

        return $userID;
    }

    public function getCurrentUsername()
    {
        $username = null;

        if (isset($_SESSION['user_name'])) {
            $username = $_SESSION['user_name'];
        } else {
            throw new \InvalidArgumentException('User Session is not available you need to login first.');
        }

        return $username;
    }

    public function getCurrentUserEmail()
    {
        $userEmail = null;

        if (isset($_SESSION['user_email'])) {
            $userEmail = $_SESSION['user_email'];
        } else {
            throw new \InvalidArgumentException('User Session is not available you need to login first.');
        }

        return $userEmail;
    }

    public function getCurrentUser()
    {
        $currentUser = [
            'id' => $this->getCurrentUserId(),
            'name' => $this->getCurrentUsername(),
            'email' => $this->getCurrentUserEmail()
        ];

        return $currentUser;
    }
}