<?php
guest();
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database($config);

    $errors = [];

    if (!isset($_POST["username"]) || empty(trim($_POST["username"]))) {
        $errors["username"] = "Username is required";
    }

   // Check if password is provided
   if (!isset($_POST["password"]) || empty(trim($_POST["password"]))) {
    $errors["password"] = "Password is required";
}

if (empty($errors)) {
    // Validate username (you can implement your own validation logic here)
    $username = trim($_POST["username"]);

    // Query the database for the provided username
    $query = "SELECT * FROM users WHERE username = :username";
    $params = [":username" => $username];
    $user_data = $db->execute($query, $params)->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and password is correct
    if ($user_data && password_verify($_POST["password"], $user_data["password"])) {
        $_SESSION["user_id"] = $user_data["id"];
        $_SESSION["username"] = $user_data["username"];
        $_SESSION["admin"] = $user_data["admin"];
        $_SESSION["user"] = true;

        header("Location: /");
        exit();
    } else {
        $errors["username"] = "Invalid username or password";
    }
}
}

unset($_SESSION["message"]);

$title = "Login";
require "../app/views/auth/login.view.php";