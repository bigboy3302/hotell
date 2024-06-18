<?php
require_once "../App/Core/functions.php";
auth(); // Authenticate the user

// Include the Database class
require_once "../App/Core/Database.php";
require_once "../App/Core/Validator.php"; // Include the Validator class

// Database configuration
$config = require "../App/config.php";
$db = new Database($config);

$username = $_SESSION['username']; // Get the logged-in user's username
$errors = [];

// Handle unreserving if the finished parameter is set
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['finished'])) {
    $reserve_id = $_POST['reserve_id'];
    $db->unreserve($reserve_id);
    $selectedApartment = $_POST['apartment'];
} else {
    $selectedApartment = $_GET['apartment'] ?? ''; // Get the selected apartment from the GET parameters
}

// Fetch all apartments
$apartmentsQuery = "SELECT name FROM apartments";
$apartments = $db->execute($apartmentsQuery, [])->fetchAll(PDO::FETCH_ASSOC);

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && !isset($_POST['finished'])) {
    // Retrieve form data
    $apartment = $_POST['apartment'] ?? $selectedApartment;
    $name = $username; // Use the logged-in user's username
    $experience = $_POST['experience'] ?? '';
    $stars = $_POST['stars'] ?? '';

    // Validate input using Validator class
    if (!Validator::string($experience, 1)) {
        $errors['experience'] = "Experience is required.";
    }
    if (!Validator::number($stars, 1, 5)) {
        $errors['stars'] = "Please select a valid star rating.";
    }

    if (empty($errors)) {
        // Prepare the SQL query to insert the new review
        $insertQuery = "INSERT INTO reviews (apartment, name, experience, stars) 
                        VALUES (:apartment, :name, :experience, :stars)";
        $reviewData = [
            'apartment' => $apartment,
            'name' => $name,
            'experience' => $experience,
            'stars' => $stars,
        ];
        $db->execute($insertQuery, $reviewData);

        // Redirect to a confirmation or another page after review submission
        header("Location: /");
        exit();
    } else {
        $selectedApartment = $apartment; // Ensure the selected apartment is preserved
    }
}

$title = "Write Review";
require "../App/views/tasks/write-review.view.php";
?>
