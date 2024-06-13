<?php
guest();
require "../app/core/Validator.php";
require "../app/core/Database.php";
require "../app/models/User.php";
$config = require("../app/config.php");



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    $db = new Database($config);
    $errors = validateInput($_POST);

    if (empty($errors)) {
        if (accountExists($db, $_POST["email"])) {
            $errors["email"] = "Konts jau eksistē";
        } else {
            registerUser($db, $_POST);
            initializeSession($db, $_POST["email"]);
            setFlashMessage("Tu esi reģistrējies");
            redirectTo("/login");
        }
    }
}

function validateInput($input) {
    $errors = [];
    if (!Validator::email($input["email"])) {
        $errors["email"] = "Nepareizs epasts";
    }
    if (!Validator::password($input["password"])) {
        $errors["password"] = "Vispār atceries paroli?";
    }
    if (!Validator::username($input["username"])) {
        $errors["username"] = "Tu lietotaja vārdu aizmirsi!";
    }
    return $errors;
}

function accountExists($db, $email) {
    $query = "SELECT * FROM users WHERE email = :email";
    $params = [":email" => $email];
    return $db->execute($query, $params)->fetch(PDO::FETCH_ASSOC);
}

function registerUser($db, $data) {
    $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $params = [
        ":username" => $data["username"],
        ":email" => $data["email"],
        ":password" => password_hash($data["password"], PASSWORD_BCRYPT)
    ];
    $db->execute($query, $params);
}

function initializeSession($db, $email) {
    $query = "SELECT id FROM users WHERE email = :email";
    $new_user_id = $db->execute($query, [":email" => $email])->fetchColumn();

    $_SESSION["user_id"] = $new_user_id;
    $_SESSION["email"] = $email;
}

function setFlashMessage($message) {
    $_SESSION["flash"] = $message;
}

function redirectTo($url) {
    header("Location: " . $url);
    die();
}




$title = "Register";
require "../app/views/auth/register.view.php";