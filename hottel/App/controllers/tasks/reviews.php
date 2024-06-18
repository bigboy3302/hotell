<?php
require_once "../App/Core/functions.php";
auth(); // Authenticate the user

// Include the Database class
require_once "../App/Core/Database.php";

// Database configuration
$config = require "../App/config.php";
$db = new Database($config);

$sort = $_GET['sort'] ?? '';
$search = $_GET['search'] ?? '';

// Build the SQL query with search and sorting
$reviewsQuery = "SELECT * FROM reviews WHERE 1";

if (!empty($search)) {
    $reviewsQuery .= " AND apartment LIKE :search";
}

if ($sort === 'stars_high_low') {
    $reviewsQuery .= " ORDER BY stars DESC";
} elseif ($sort === 'stars_low_high') {
    $reviewsQuery .= " ORDER BY stars ASC";
}

$params = [];
if (!empty($search)) {
    $params[':search'] = "%$search%";
}

$reviews = $db->execute($reviewsQuery, $params)->fetchAll(PDO::FETCH_ASSOC);

$is_admin = $_SESSION['is_admin'] ?? false; // Check if the user is an admin

$title = "Reviews";
require "../App/views/tasks/reviews.view.php";
