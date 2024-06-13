<?php

class Database {
    private $pdo;

    public function __construct($config) {
        // Ensure all required keys are present
        if (!isset($config['host'], $config['database'], $config['username'], $config['password'])) {
            throw new Exception("Incomplete database configuration provided.");
        }

        try {
            // Construct DSN from config
            $connection_string = "mysql:host={$config['host']};dbname={$config['database']};charset=utf8mb4";
            
            // Initialize PDO instance
            $this->pdo = new PDO($connection_string, $config['username'], $config['password']);
            
            // Set PDO attributes
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle PDOException
            throw new Exception("Database connection error: " . $e->getMessage());
        } catch (Exception $e) {
            // Handle other exceptions
            throw new Exception("Error initializing database: " . $e->getMessage());
        }
    }

    // Your other methods remain unchanged
    // ...

    public function execute($query_string, $params = []) {
        try {
            $query = $this->pdo->prepare($query_string);
            $query->execute($params);
            return $query;
        } catch (PDOException $e) {
            // Handle query execution error
            throw new Exception("Query execution error: " . $e->getMessage());
        }
    }
    public function getListing($listingId) {
        $query = $this->execute("SELECT * FROM listings WHERE id = ?", [$listingId]);
        return $query->fetch();
    }

    public function reserve($listingDetails) {
        $this->execute("UPDATE listings SET availability = false WHERE id = ?", [$listingDetails['listingId']]);
        $this->execute("INSERT INTO reserved (listingId, title, image, price, availability, location) VALUES (?, ?, ?, ?, ?, ?)", [
            $listingDetails['listingId'],
            $listingDetails['title'],
            $listingDetails['image'],
            $listingDetails['price'],
            ($listingDetails['availability'] ? 1 : 0),
            $listingDetails['location']
        ]);
    }

    public function returnListing($listingId) {
        $this->execute("UPDATE listings SET availability = true WHERE id = ?", [$listingId]);
        $this->execute("DELETE FROM reserved WHERE listingId = ?", [$listingId]);
    }
}
?>
