<?php

guest();

$title = "Password Reset";
require "../App/Core/Database.php";
require "../App/Core/Validator.php";
$config = require("../App/config.php");
$db = new Database($config);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    if (!Validator::string($_POST["username"], min:1, max:255)) {
        $errors["username"] = "Invalid username!";
    }
    
    if (!Validator::string($_POST["user_identifier"], min:5, max:30)) {
        $errors["user_identifier"] = "Invalid identifier!";
    }

    if(!Validator::password($_POST["password"])) {
        $errors["password"] = "Nepareizs paroles formats";
    }

    $query = "SELECT * FROM users WHERE username = :username";
    $params = [
        ":username" => $_POST["username"]
    ];
    $user = $db->execute($query, $params)->fetch();
    if (!$user || $user["identifier"] == null || !password_verify($_POST["user_identifier"], $user["identifier"])) {
        $errors["user_identifier"] = "The username or identifier is incorrect, or the identifier wasn't set!";
    }

    if (empty($errors)) {
        $query = "UPDATE users SET password = :password;";
        $params = [
            ":password" => password_hash($_POST["password"], PASSWORD_BCRYPT)
        ];
        $db->execute($query, $params);

        $_SESSION["flash"] = "Password Changed";
        header("Location: /login");
        die();
    }
}


require "../App/views/auth/password-reset.view.php";
?>