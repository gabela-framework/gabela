<?php

namespace Gabela\Core;

use PDO;
use Exception;

abstract class Model
{
    protected $db;
    protected $table;
    protected $primaryKey;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Inserts data into the database table.
     *
     * This method takes an associative array of data, constructs an SQL INSERT statement,
     * and executes it to insert the data into the database table associated with this model.
     *
     * @param array $data An associative array where the keys are the column names and the values are the data to insert.
     * @return mixed The ID of the last inserted row on success, or false on failure.
     * @throws Exception If an error occurs during the execution of the SQL statement.
     */
    // Generic method to insert data
    public function insert(array $data)
    {
        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));


        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {

            $stmt->bindValue(":$key", $value);

        }
      
        try {
            if ($stmt->execute()) {
                return $this->db->lastInsertId();
            } else
                return false;
        } catch (Exception $e) {
            // Handle exception (log or rethrow)
            $_SESSION['registration_error'] = 'An error occurred during the password reset process.';
           // $this->logger->error('An exception occurred while resetting the password', ['exception' => $e]);
            //return false;
            throw $e;
        }
    }

    /**
     * Generic method to update data
     *
     * This method is used to update data in the database.
     * It can be used to modify records based on specific conditions.
     *
     * @param array $data An associative array of column-value pairs to update.
     * @param mixed $id The primary key value of the record to update.
     * @return bool Returns true on success, false on failure.
     */
    public function update(array $data, $id)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE {$this->table} SET {$set} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(":id", $id);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            // Handle exception
            throw $e;
        }
    }

    /**
     * Updates a row in the database table with the provided data and conditions.
     *
     * @param array $data An associative array of column-value pairs to update.
     * @param array $conditions An associative array of column-value pairs to use in the WHERE clause.
     * @return bool Returns true on success or false on failure.
     */
    public function updateRow($data, $conditions)
    {
        $sql = "UPDATE {$this->table} SET ";

        // Dynamically build the update query
        $fields = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }
        $sql .= implode(', ', $fields);

        // Add WHERE clause based on conditions (e.g., 'id')
        $where = [];
        foreach ($conditions as $key => $value) {
            $where[] = "$key = :$key";
        }
        $sql .= " WHERE " . implode(' AND ', $where);

        // Prepare and execute statement
        $stmt = $this->db->prepare($sql);

        // Bind values for both data and conditions
        foreach (array_merge($data, $conditions) as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }


    /**
     * Generic method to delete data
     *
     * This method is used to delete data from the database.
     * It can be used to remove records based on specific conditions.
     *
     * @param string $table The name of the table from which to delete data.
     * @param array $conditions An associative array of conditions to match for deletion.
     * @return bool Returns true on success, false on failure.
     */
    // Generic method to delete data
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $id);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            // Handle exception
            throw $e;
        }
    }
    /**
     * Retrieve all records from the database table.
     *
     * This method prepares and executes an SQL query to select all records
     * from the table associated with the current model instance. It returns
     * the results as an associative array.
     *
     * @return array An associative array containing all records from the table.
     */
    public function findAll()
    {
        // Prepare the SQL query
        $sql = "SELECT * FROM {$this->table}";

        // Execute the query
        $stmt = $this->db->query($sql);

        // Fetch all results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Generic method to find a record by ID.
     *
     * This method prepares and executes a SQL query to find a record
     * in the database table specified by the class property `$table`.
     * It uses the primary key specified by the class property `$primaryKey`
     * to search for the record with the given ID.
     *
     * @param mixed $id The ID of the record to find.
     * @return array|false The record as an associative array if found, false otherwise.
     */
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find a record by its ID.
     *
     * This method executes a SQL query to find a record in the database table
     * associated with this model by its ID. It prepares the SQL statement,
     * binds the ID value to the query, executes the query, and returns the
     * result as an associative array.
     *
     * @param int $id The ID of the record to find.
     * @return array|false The record as an associative array, or false if no record is found.
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Finds a single record in the database that matches the given condition.
     *
     * This method constructs an SQL query to select a record from the table
     * associated with this model, based on the provided condition array.
     * The condition array should be an associative array where the keys are
     * column names (optionally with comparison operators) and the values are
     * the values to match.
     *
     * Example usage:
     * ```php
     * $condition = ['id' => 1];
     * $result = $model->findOne($condition);
     * ```
     *
     * @param array $condition An associative array of column-value pairs to use as conditions.
     *                         The keys can include comparison operators (e.g., 'reset_expiration >').
     * @return array|null The first matching record as an associative array, or null if no match is found.
     */
    public function findOne(array $condition)
    {
        // Start building the SQL query
        $sql = "SELECT * FROM {$this->table} WHERE ";

        // Prepare an array to store query placeholders and values
        $queryConditions = [];
        $values = [];

        // Loop through the condition array and prepare the query parts
        foreach ($condition as $column => $value) {
            // Check if the column contains a comparison operator (e.g., 'reset_expiration >')
            if (strpos($column, ' ') !== false) {
                $queryConditions[] = "$column :$column";
            } else {
                $queryConditions[] = "$column = :$column";
            }

            // Store the value associated with the condition
            $values[$column] = $value;
        }

        // Join the conditions with AND for the WHERE clause
        $sql .= implode(' AND ', $queryConditions);

        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);

        // Execute the statement with the values
        $stmt->execute($values);

        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the first result if found, otherwise return null
        return $result ?: null;
    }
}
