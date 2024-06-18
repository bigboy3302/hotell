<?php
require "../App/Core/Database.php";

class Auth {
    private $db;
    private $config;

    public function __construct() {
        $this->config = require("../App/config.php");
        $this->db = new Database($this->config);
    }

    public function getUser($username) {
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->execute($query, [$username]);
        return $stmt->fetch();
    }
    

    public function register($username, $password, $email) {
        $query = "INSERT INTO users (username, password, email)
        VALUES (:username, :password, :email);";
        $params = [
            ":username" => $username,
            ":password" => password_hash($password, PASSWORD_BCRYPT),
            ":email" => $email
        ];
        $this->db->execute($query, $params);
    }
}

class Apartment {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function getApartment($apartment_id) {
        $query = "SELECT * FROM apartments WHERE apartment_id = :apartment_id";
        $params = [
            ":apartment_id" => $apartment_id
        ];
        return $this->db->execute($query, $params)->fetch();
    }

    public function createApartment($name, $price, $availability, $stars) {
        $query = "INSERT INTO apartments (name, price, availability, stars)
                  VALUES (:name, :price, :availability, :stars)";
        $params = [
            ":name" => $name,
            ":price" => $price,
            ":availability" => $availability,
            ":stars" => $stars
        ];
        $this->db->execute($query, $params);
    }

    public function createAdmin($username, $password, $email) {
        $query = "INSERT INTO users (username, password, email, admin)
        VALUES (:username, :password, :email, :admin);";
        $params = [
            ":username" => $username,
            ":password" => password_hash($password, PASSWORD_BCRYPT),
            ":email" => $email,
            ":admin" => true
        ];
        $this->db->execute($query, $params);
    }

    
}
?>
