<?php

/**
 * @package   Task Management
 * @author    Ntabethemba Ntshoza
 * @date      11-10-2023
 * @copyright Copyright © 2023 VMP By Maneza
 */

namespace Gabela\Model;

use PDO;
use Exception;
use Monolog\Logger;
use Gabela\Core\Model;
use Gabela\Core\Database;
use Gabela\Model\UserInterface;
use Monolog\Handler\StreamHandler;

/**
 * Users class to get users from the database
 * @package Model
 */
class User extends Model 
{
    private $name;
    private $city;
    private $email;
    private $password;
    private $id;
    protected $db;
    private $role;
    private $logger;
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    public function __construct(PDO $db = null)
    {
        $this->db = Database::connect();
        $this->logger = new Logger('users');
        $this->logger->pushHandler(new StreamHandler('var/System.log', Logger::DEBUG));
    }

    /**
     * Get the value of id
     */
    public function getUserId()
    {
        return $this->id;
    }

    // Setter method for name
    public function setUserId($id)
    {
        $this->id = $id;
    }

    // Getter method for name
    public function getName()
    {
        return $this->name;
    }

    // Setter method for name
    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter method for email
    public function getEmail()
    {
        return $this->email;
    }

    // Setter method for email
    public function setEmail($email)
    {
        $this->email = $email;
    }

    // Getter method for password
    public function getPassword()
    {
        return $this->password;
    }

    // Setter method for password
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Get the value of city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  self
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of city
     */
    public function getWeatherCity()
    {
        // Get the user's ID for the currently logged-in user
        $user_id = $this->getWeatherUserId(); 
    
        // Use the findOne method from the Model class to find the city for the given user_id
        $condition = ['user_id' => $user_id];
        $user = $this->findOne($condition);
    
        // Check if the user was found
        if ($user && isset($user['city'])) {
            // Return the city if it exists
            return $user['city'];
        } else {
            // If no city is found, return a default city (Cape Town)
            return "Cape Town";
        }
    }
    

    // Getter method for name
    public function getWeatherUserId()
    {
        // Retrieve the user's ID from the session
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        } else {
            // Handle the case where the user's ID is not found in the session
            return $this->city;
        }
    }

    /**
     * Save New Users
     *
     * @return mixed
     */
    public function save()
    {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Prepare data for insertion
        $data = [
            'name' => $this->name,
            'city' => $this->city,
            'email' => $this->email,
            'password' => $hashedPassword,
        ];

        if ($this->id) {
            // Update existing user
            return $this->update($data, $this->id);
        } else {
            // Insert new user
            if ($this->validatePassword($data['password'])) {
                return $this->insert($data);
            } else {
                $_SESSION['registration_error'] = 'Error registering, verify your detials and try again';
            }
        }
    }

    public function getUserById($userId)
    {

        $user = $this->findById($userId);
        if ($user) {
            return $user;
        }

        return null; // User not found or query failed
    }
    /**
     * Login funtion
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login($email, $password)
    {
        try {
            // Fetch user by email
            $user = $this->findByEmail($email);

            // Check if user exists
            if (!$user) {
                $_SESSION['login_error'] = 'Aaaahh!! Check your email/password...';
                return false; // User not found
            }

            // Verify the provided password against the stored hash
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['login_success'] = 'Hey ' . $user['name'] . ', you are logged in successfully!';

                return true;
            } else {
                $_SESSION['login_error'] = 'Aaaahh!! Check your email/password...';
                return false; // Incorrect password
            }
        } catch (Exception $e) {
            $errorMessage = 'An exception occurred: ' . $e->getMessage();
            $this->logger->error($errorMessage, ['exception' => $e]);
            $_SESSION['login_error'] = 'Aaaahh!! Something went wrong...';

            return false; // Handle unexpected exceptions
        }
    }

    /**
     * Summary of getUsersFromDatabase
     * @return array|bool
     */
    public function getUsersFromDatabase()
    {
        $result = $this->findAll();

        if ($result) {
            $userNames = [];

            foreach ($result as $row) {
                $userNames[] = $row;
            }

            return $userNames;
        } else {
            return false; // Query failed
        }
    }
    /**
     * Validate Password
     * @param string $password
     * 
     * @return bool
     */
    public function validatePassword($password)
    {
        // Check password length
        if (strlen($password) < 8) {
            return false;
        }

        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Check for at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Check for at least one digit
        if (!preg_match('/\d/', $password)) {
            return false;
        }

        // Password passed all checks
        return true;
    }

    /**
     * Forgot password function
     *
     * @param string $email
     * @return mixed
     */

    public function forgotPassword($email)
    {
        try {
            // Check if the email exists by fetching the user
            $user = $this->findByEmail($email);

            if (!$user) {
                // Email does not exist, return an error
                $_SESSION['reset_error'] = 'The email address does not exist. Verify and try again.';
                return redirect('/forgot-password');
            }

            // Generate reset token and expiration time
            $resetToken = bin2hex(random_bytes(16)); // Generate a random token
            $resetExpiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Expiration time set to 1 hour

            // Update the user's reset_token and reset_expiration in the database
            $updateData = [
                'reset_token' => $resetToken,
                'reset_expiration' => $resetExpiration
            ];

            // Use the updateRow method to update the user based on the email
            $this->updateRow($updateData, ['id' => $user['id']]);

            // Generate the reset link
            $resetLink = "{$this->getSiteUrl('/reset-password')}?email=" . urlencode($email) . "&token=" . urlencode($resetToken);
            $message = "To reset your password, click on the following link:\n<a href='{$resetLink}'>Reset your password now</a>";

            // Set session variables and return the message
            $_SESSION['reset_password'] = $message;
            $_SESSION['email'] = $email;
            $_SESSION['token'] = $resetToken;
            $_SESSION['updated_password'] = "The reset password link has been sent to your email. Please check your email and reset your password!";

            // Return the reset message and token
            return ['message' => $message, 'token' => $resetToken];
        } catch (Exception $e) {
            // Handle any exceptions during the process
            $_SESSION['registration_error'] = 'An error occurred during the password reset process.';
            $this->logger->error('An exception occurred while resetting the password', ['exception' => $e]);
            return false;
        }
    }

    /**
     * Get Website URL
     *
     * @param string $path
     * @return string
     */
    function getSiteUrl($path = '/')
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
        $host = $_SERVER['HTTP_HOST'];
        $scriptName = $_SERVER['SCRIPT_NAME'];

        // Remove the script filename to get the base URL
        $baseUrl = dirname($scriptName);

        return $protocol . $host . $baseUrl . $path;
    }


    /**
     * Check if the email already exist in the database
     *
     * @param string $email
     * @return mixed
     */
    private function emailExists($email)
    {
        // Define the condition to check for the email
        $condition = ['email' => $email];
    
        // Use the findOne method from the Model class to check if the email exists
        $result = $this->findOne($condition);
    
        // Check if a result is found
        if ($result) {
            return true;
        }
    
        // If no result is found, set the session message and return false
        $_SESSION['wrong_email'] = "{$email} does not exist, please verify and try again...";
        return false;
    }
    

    /**
     * Check if password is valid for pass reset
     *
     * @param string $email
     * @param string $token
     * @return boolean
     */
    public function isValidPasswordResetRequest($email, $token)
    {
        // Define the condition to check the valid reset request
        $condition = [
            'email' => $email,
            'reset_token' => $token,
            // Add a condition for reset_expiration to be greater than the current time
            'reset_expiration >' => date('Y-m-d H:i:s'),
        ];
    
        // Use the Model's findOne method to check for a valid reset request
        $result = $this->findOne($condition);
    
        // Return true if a matching record is found, otherwise false
        return !empty($result);
    }
    

    /**
     * Update Password function
     *
     * @param string $email
     * @param string $newPassword
     * @return bool
     */
    public function updatePassword($email, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $data = [
            'password' => $hashedPassword,
        ];

        $condition = [
            'email' => $email,
        ];

        // Use the Model's update method to perform the update
        $result = $this->update($data, $condition);

        if ($result) {
            $_SESSION['updated_password'] = "Password reset was successful! | Please Login!";
        }

        return $result;
    }


    /**
     * Get All users
     *
     * @return array
     */
    public static function getAllUsers()
    {
        $db = Database::connect();
        // Prepare the SQL statement to fetch all users
        $sql = "SELECT * FROM users";

        // Execute the query
        $result = $db->query($sql);

        // Check if the query was successful
        if ($result) {
            $users = [];
            $databaseInstance = Database::connect();

            // Fetch user data and create User objects
            // $stmt->bindParam(':name', $userName, PDO::PARAM_STR);
            $stmt = $db->prepare($sql);
            // $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user = new User($databaseInstance);
                $user->setUserId($row['id']);
                $user->setName($row['name']);
                $user->setCity($row['city']);
                $user->setEmail($row['email']);
                // Add more setters for other user properties as needed

                // Add the User object to the array
                $users[] = $user;
            }

            return $users;
        } else {
            return []; // Query failed
        }
    }


    /**
     * Get a user by ID
     *
     * @param string|int $userId
     * @return mixed
     */
    public function getUserByName($userName)
    {
        // Prepare the SQL statement to retrieve user data by name
        $sql = "SELECT * FROM users WHERE name LIKE :name";
        $stmt = $this->db->prepare($sql);

        // Bind the parameter and execute the statement
        $stmt->bindParam(':name', $userName, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Fetch the user data
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if a user with the provided name exists
            if ($userData) {
                return $userData;
            }
        }

        return null; // User not found or query failed
    }

    /**
     * Delete tasks associated with the user before deleteing the user
     *
     * @param [type] $userId
     * @return bool
     */
    private function deleteUserTasks($userId)
    {
        $taskModel = new self();
        $condition = ['user_id' => $userId];

        return $taskModel->delete($condition);
    }

    /**
     * Check if the user has the admin access role
     *
     * @return boolean
     */
    public static function isAdmin()
    {
        $user = self::getCurrentUser();

        // Check if the user exists and has the 'admin' role
        return $user && $user['role'] === 'admin';
    }

    /**
     * Check if the user is logged in
     *
     * @return boolean
     */
    public static function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }

    /**
     * Get a logged user
     *
     * @return array
     */
    public static function getCurrentUser()
    {
        // Check if the user is authenticated
        if (self::isAuthenticated()) {
            // Get the user ID from the session
            $userId = $_SESSION['user_id'];
            $userModel = new self();

            $userData = $userModel->findById($userId);

            // If the user data is found, return it
            if (!empty($userData)) {
                return $userData;
            }
        }

        return [];
    }
}
