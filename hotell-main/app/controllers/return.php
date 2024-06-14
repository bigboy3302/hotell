<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");

$db = new Database($config);

// Pārbaudiet, vai lietotājs ir autentificējies
function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

// Iegūstiet lietotāja informāciju
function getUser($db) {
    return new User($db, $_SESSION['user_id']);
}

// Pārbaudiet, vai lietotājs ir autentificējies
if (isAuthenticated()) {
    $user = getUser($db);
} else {
    header("Location: /login");
    exit(); // exit()  funkcijai
}

// Apstrādājiet pieprasījumu, ja ir nospiesta atgriešanas poga
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['return-button'])) {
    $listingId = $_POST['listingId'];
    $db->returnListing($listingId);

    header("Location: /reserved");
    exit(); // exit()  funkcijai
}