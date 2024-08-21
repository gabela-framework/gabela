<?php

namespace Gabela\Core;

class Session
{
    public static function getCurrentUserId()
    {
        $userID = null;

        if (isset($_SESSION['user_id'])) {
            $userID = $_SESSION['user_id'];
        } else {
            $userID = "You not logged in";
        }

        return $userID;
    }

    public static function  getCurrentUsername()
    {
        $username = null;

        if (isset($_SESSION['user_name'])) {
            $username = $_SESSION['user_name'];
        } else {
            $username = 'You not logged in'; 
        }

        return $username;
    }

    public static function getCurrentUserEmail()
    {
        $userEmail = null;

        if (isset($_SESSION['user_email'])) {
            $userEmail = $_SESSION['user_email'];
        } else {
            $userEmail = 'You not logged in';        
        }

        return $userEmail;
    }

    public static function getCurrentUser()
    {
        $currentUser = [
            'id' => static::getCurrentUserId(),
            'name' => static::getCurrentUsername(),
            'email' => static::getCurrentUserEmail()
        ];

        return $currentUser;
    }

    /**
     * Flush all the session assigned
     *
     * @return void
     */
    public static function flush()
    {
        $_SESSION = [];
    }

    public static function destroy()
    {
        static::flush();

        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
}