<?php
// Include the functions file
require_once "../App/Core/functions.php";

// Include the Database class
require_once "../App/Core/Database.php";

// Authenticate the user
auth();

$config = require "../App/config.php";
$db = new Database($config);

$apartment_id = $_POST['apartment_id']; // Get the apartment_id from the POST request

$stmt = $db->execute("SELECT * FROM apartments WHERE apartment_id = ?", [$apartment_id]); // Execute the query
$apartment = $stmt->fetch(); // Fetch the specific apartment

$title = "Information";
require "../App/views/tasks/show.view.php";
?>
