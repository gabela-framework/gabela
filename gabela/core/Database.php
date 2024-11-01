<?php

namespace Gabela\Core;

use PDO;
use PDOException;

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

            // $host =  getenv('DB_HOST'); //$config['host'];
            // $username = getenv('DB_USERNAME');//$config['username'];
            // $password = getenv('DB_PASSWORD');//$config['password'];
            // $database = getenv('DB_DATABASE'); //$config['database'];

            try {
                $dsn = "mysql:host=$host;dbname=$database;charset=utf8mb4";
                self::$connection = new PDO($dsn, $username, $password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }

    /**
     * Summary of select
     * 
     * @param \PDO $dbConn
     * @param string $strQuery
     * @param array $params
     * @return array
     */
    public static function select(PDO $dbConn, string $strQuery, array $params = []): array
    {

        $rows = [];

        $stmt = $dbConn->prepare($strQuery, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $stmt->execute($params);

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        if (!empty($stmt)) $stmt->closeCursor();
        return $rows;
    }

    /**
     * Summary of execute
     * 
     * @param \PDO $dbConn
     * @param string $strQuery
     * @param array $params
     * @return int
     */
    public static function execute(PDO $dbConn, string $strQuery, array $params): int
    {

        $stmt = $dbConn->prepare($strQuery);
        $stmt->execute($params);

        $rowCount = $stmt->rowCount();

        if (!empty($stmt)) $stmt->closeCursor();

        return $rowCount;
    }

    /**
     * Summary of prepStoredProcCall
     * 
     * @param string $dbType database type, sqlsrv or mysql
     * @param string $strSPName
     * @param string $params
     * @return string
     */
    public static function processStoredProcedure(string $dbType, string $SPName, string $params = NULL): string
    {

        if ($dbType == 'sqlsrv') {

            $strVerb = 'exec';
            $strPOpen = ' ';
            $paramshut = '';
        } else {

            $strVerb = 'call';
            $strPOpen = '(';
            $paramshut = ')';
        }

        $strSQL = $strVerb . ' ' . $SPName;

        if (isset($params)) $strSQL .= ($strPOpen . $params . $paramshut);

        return $strSQL;
    }

    /**
     * @param array $params
     * @return string
     */
    public static function prepareSProcParmList(array $params): string
    {

        $parmList = '';

        foreach ($params as $parmName => $parmValue) {
            if ($parmList !== '') $parmList .= ',';
            $parmList .= (':' . $parmName);
        }

        return $parmList;
    }


    public function prepare($sql)
    {
        return self::$connection->prepare($sql);
    }
}
