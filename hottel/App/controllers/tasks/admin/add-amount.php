<?php

// Include necessary files
require_once "../App/Core/Database.php";
require_once "../App/models/Task.php";
require_once "../App/Core/Validator.php"; // Include the Validator class

// Authenticate the user as admin
isAdmin();

$title = "Add room amount";

// Load database configuration from config.php
$config = require "../App/config.php";
$db = new Database($config);

// Fetch all apartments
$task = new Task();
$apartments = $task->showAll();

$error = '';

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $room_id = $_POST['room_id'] ?? '';
    $room_amount = $_POST['room_amount'] ?? '';

    // Validate input using Validator class
    if (Validator::number($room_id) && Validator::number($room_amount, 0)) {
        // Prepare the SQL query to update the room amount
        $updateQuery = "UPDATE apartments SET amount = :room_amount WHERE apartment_id = :room_id";
        $db->execute($updateQuery, ['room_amount' => $room_amount, 'room_id' => $room_id]);

        header("Location: /");
        exit();
    } else {
        $error = "Invalid input. Please enter a valid number.";
    }
}

require "../App/views/tasks/admin/add-amount.view.php";
?>
