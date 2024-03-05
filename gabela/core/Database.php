<?php 

namespace Gabela\Core;

use mysqli;

class Database
{
    private static $connection;

    public static function connect()
    {
        if (!self::$connection) {
            $config = getIncluded(WEB_CONFIGS);

            $host = $config['host'];
            $username = $config['username'];
            $password = $config['password'];
            $database = $config['database'];

            self::$connection = new mysqli($host, $username, $password, $database);

            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }

        return self::$connection;
    }

    public function prepare($sql)
    {
        return self::$connection->prepare($sql);
    }
}
