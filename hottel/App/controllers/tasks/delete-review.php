<?php
require_once "../App/Core/functions.php";
auth(); // Authenticate the user

if (!$_SESSION['is_admin']) {
    header("Location: /");
    exit();
}

// Include the Database class
require_once "../App/Core/Database.php";

// Database configuration
$config = require "../App/config.php";
$db = new Database($config);

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $review_id = $_POST['review_id'] ?? null;

    if ($review_id !== null) {
        // Prepare the SQL query to delete the reviews
        $deleteQuery = "DELETE FROM reviews WHERE id = :review_id"; // Update the column name if necessary
        $db->execute($deleteQuery, ['review_id' => $review_id]);
    }

    // Redirect to the reviews page after deletion
    header("Location: /reviews");
    exit();
}
?>
