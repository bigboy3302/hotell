<?php
// Include the functions file
require_once "../App/Core/functions.php";

// Include the Database class
require_once "../App/Core/Database.php";

// Include the Task model
require_once "../App/models/Task.php";

// Authenticate the user
auth();

$config = require "../App/config.php";
$db = new Database($config);

// Handle the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $task = new Task();
    $apartment_id = $_POST['apartment_id'];
    $task->delete($apartment_id);
    header('Location: /'); // Redirect to the tasks list after deletion
    exit;
}

// Get the search term and sort option from the GET request
$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? '';

// Build the SQL query
$query = "SELECT * FROM apartments WHERE name LIKE ? ";
$params = ["%$search%"];

// Add the sorting option to the SQL query
if ($sort === 'price_high_low') {
    $query .= "ORDER BY price DESC";
} elseif ($sort === 'price_low_high') {
    $query .= "ORDER BY price ASC";
} elseif ($sort === 'date_new_old') {
    $query .= "ORDER BY date DESC";
} elseif ($sort === 'date_old_new') {
    $query .= "ORDER BY date ASC";
}

$stmt = $db->execute($query, $params); // Execute the query
$apartments = $stmt->fetchAll(); // Fetch all rows

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/edit') {
    $apartment_id = $_POST['apartment_id'];
    $query = "SELECT * FROM apartments WHERE apartment_id = ?";
    $stmt = $db->execute($query, [$apartment_id]);
    $apartment = $stmt->fetch();
}

$title = "Home page";
require "../App/views/tasks/index.view.php";
?>
