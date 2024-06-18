<?php
// Include the functions file
require_once "../App/Core/functions.php";

// Include the Database class
require_once "../App/Core/Database.php";

// Authenticate the user
auth();

$config = require "../App/config.php";
$db = new Database($config);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apartment_id = $_GET['id'];
    $query = "SELECT * FROM apartments WHERE apartment_id = ?";
    $stmt = $db->execute($query, [$apartment_id]);
    $apartment = $stmt->fetch();
}


$title = "Edit Apartment";
require "../App/views/tasks/edit.view.php";
?>
