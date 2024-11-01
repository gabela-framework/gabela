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

    // Generic method to update data
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

    public function findAll()
    {
        // Prepare the SQL query
        $sql = "SELECT * FROM {$this->table}";

        // Execute the query
        $stmt = $this->db->query($sql);

        // Fetch all results as an associative array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Generic method to find a record by ID
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

    public function findById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

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
