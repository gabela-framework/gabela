<?php

namespace Gabela\Model;

interface UserInterface
{
    public function getUserId();

    public function setUserId($id);

    public function getName();

    public function setName($name);

    public function getEmail();

    public function setEmail($email);

    public function getPassword();

    public function setPassword($password);

    public function getCity();

    public function setCity($city);

    
    public function setRole($role);

    public function getRole();

    public function getWeatherCity();

    public function getWeatherUserId();

    public function save();

    public function login($email, $password);

    public function validatePassword($password);

    public function forgotPassword($email);

    public function isValidPasswordResetRequest($email, $token);

    public function updatePassword($email, $newPassword);

    public static function getAllUsers();

    public function getUsersFromDatabase();

    public function getUserById($userId);

    public function update();

    public function delete($userId);

    public static function isAdmin();

    public static function getCurrentUser();

    public static function isAuthenticated();

}
