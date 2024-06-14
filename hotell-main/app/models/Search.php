<?php

require_once "../app/core/Database.php";

class SearchModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function searchItems($query) {
        $sql = "SELECT * FROM tasks WHERE title LIKE :query OR description LIKE :query";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $query . '%');
        return $this->db->resultSet();
    }

    public function searchItemsByFirstLetter($letter, $userId) {
        $sql = "SELECT * FROM tasks WHERE (title LIKE :query OR description LIKE :query) AND user_id = :user_id";
        $this->db->query($sql);
        $this->db->bind(':query', '%' . $letter . '%');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
}