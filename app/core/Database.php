<?php

class Database {
    private $pdo;

    public function __construct($config) {
        try {
            // Ensure all necessary configuration parameters are present
            if (!isset($config['host']) || !isset($config['dbname']) || !isset($config['user']) || !isset($config['password'])) {
                throw new Exception("Incomplete database configuration provided.");
            }

            // Building the connection string using the configuration array
            $connection_string = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8mb4";
            
            // Create a new PDO instance with the connection string and credentials
            $this->pdo = new PDO($connection_string, $config['user'], $config['password']);
            
            // Set PDO attributes for error handling and default fetch mode
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle PDO exceptions
            throw new Exception("Database connection error: " . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            throw new Exception("Error initializing database: " . $e->getMessage());
        }
    }

    public function execute($query_string, $params = []) {
        try {
            // Prepare and execute the query with parameters
            $query = $this->pdo->prepare($query_string);
            $query->execute($params);
            return $query;
        } catch (PDOException $e) {
            // Handle query execution error
            throw new Exception("Query execution error: " . $e->getMessage());
        }
    }

    // Add more methods as per your application's requirements
}
?>
