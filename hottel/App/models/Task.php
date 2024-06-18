<?php 
require_once "../App/Core/Database.php";

class Task {
    private $db;
    private $config;

    public function __construct() {
        $this->config = require("../App/config.php");
        $this->db = new Database($this->config);
    }

    public static function updateRoomAmount($config, $room_id, $amount) {
        try {
            $db = new Database($config);
            $query = "UPDATE apartments SET amount = :amount WHERE apartment_id = :room_id";
            $params = [
                ':amount' => $amount,
                ':room_id' => $room_id
            ];
            $db->execute($query, $params);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function showAll() {
        $result = $this->db->execute('SELECT * FROM apartments', []);
        return $result->fetchAll();
    }

    public function creator($user_id) {
        $result = $this->db->execute('SELECT * FROM users WHERE id=:user_id', [":user_id" => $user_id]);
        return $result->fetch();
    }

    public function delete($apartment_id) {
        $this->db->execute('DELETE FROM apartments WHERE apartment_id=:apartment_id', [
            ":apartment_id" => $apartment_id
        ]);
    }
}
?>
