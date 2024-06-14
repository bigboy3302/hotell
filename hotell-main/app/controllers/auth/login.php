<?php
guest();
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $db = new Database($config);

    $errors = [];

    if (!isset($_POST["email"]) || empty(trim($_POST["email"]))) {
        $errors["email"] = "Email is required";
    }

    if (!isset($_POST["password"]) || empty(trim($_POST["password"]))) {
        $errors["password"] = "Password is required";
    }

    if (empty($errors)) {
        // Validate email and password (you can add more validation logic here if needed)

        // Query the database for the provided email
        $query = "SELECT * FROM users WHERE email = :email";
        $params = [":email" => $_POST["email"]];
        $user_data = $db->execute($query, $params)->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and password is correct
        if ($user_data && password_verify($_POST["password"], $user_data["password"])) {
            $_SESSION["user_id"] = $user_data["id"];
            $_SESSION["username"] = $user_data["username"];
            $_SESSION["admin"] = $user_data["admin"];
            $_SESSION["user"] = true;

            header("Location: /"); // Redirect to homepage or dashboard
            exit(); // Ensure that no more PHP code is executed
        } else {
            $errors["email"] = "Invalid email or password"; // Set error message
        }
    }

    // If there are errors, unset the session message and proceed to render the view
    unset($_SESSION["message"]);
}

$title = "Login";
require "../app/views/auth/login.view.php";
?>
