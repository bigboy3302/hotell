<?php
require_once '../app/core/Database.php';

class User {
    private $database;
    private $userId;
    private $userDetails;

    public function __construct($database, $userId) {
        $this->database = $database;
        $this->userId = $userId;
        $this->loadUserDetails();
    }

    private function loadUserDetails() {
        $query = 'SELECT * FROM users WHERE id = :id';
        $user = $this->database->execute($query, ['id' => $this->userId])->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: /login");
            exit();
        }

        $this->userDetails = $user;
    }

    public function getUserDetails() {
        return $this->userDetails;
    }

    public function updateProfile($username, $email, $password = null) {
        $updateFields = [
            'username' => $username,
            'email' => $email,
            'id' => $this->userId
        ];

        $sql = 'UPDATE users SET username = :username, email = :email';
        
        if ($password) {
            $updateFields['password'] = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ', password = :password';
        }

        $sql .= ' WHERE id = :id';

        try {
            $this->database->execute($sql, $updateFields);
            $this->loadUserDetails();
        } catch (Exception $e) {
            throw new Exception("Profile update failed: " . $e->getMessage());
        }
    }

    public function isAdministrator() {
        return isset($this->userDetails['admin']) && $this->userDetails['admin'] == 1;
    }
}
?>
