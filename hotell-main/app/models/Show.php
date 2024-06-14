<?php
require "../app/core/Database.php";

class ShowModel {
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    public function getTaskById($id) {
        $query = $this->db->query("SELECT * FROM tasks WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}