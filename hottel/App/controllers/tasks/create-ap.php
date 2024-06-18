<?php
require_once "../App/Core/functions.php";
auth();

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    // If not admin, redirect to home page or show an error
    header("Location: /");
    die("Access denied. Admins only.");
}

$errors = [];

// If the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Include the Database class
    require_once "../App/Core/Database.php";
    require_once "../App/Core/Validator.php"; // Include the Validator class

    // Validate and process form data to insert the apartment
    $config = require "../App/config.php";
    $db = new Database($config);

    // Retrieve form data and sanitize the apartment name
    $name = htmlspecialchars($_POST['name'] ?? '');
    $price = $_POST['price'] ?? 0;
    $amount = $_POST['amount'] ?? 0;
    $stars = $_POST['stars'] ?? 0;
    $image_url = $_POST['image_url'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';

    // Validate input using Validator class
    if (!Validator::string($name, 1)) {
        $errors['name'] = "Apartment name is required.";
    }
    if (!Validator::number($price, 0)) {
        $errors['price'] = "Please enter a valid price.";
    }
    if (!Validator::number($amount, 0)) {
        $errors['amount'] = "Please enter a valid amount.";
    }
    if (!Validator::number($stars, 1, 5)) {
        $errors['stars'] = "Please select a valid star rating.";
    }
    if (!Validator::string($image_url, 1)) {
        $errors['image_url'] = "Image URL is required.";
    }
    if (!Validator::string($description, 1)) {
        $errors['description'] = "Description is required.";
    }
    if (!Validator::date($date)) {
        $errors['date'] = "Please enter a valid date.";
    }

    if (empty($errors)) {
        // Prepare the SQL query to insert the new apartment
        $insertQuery = "INSERT INTO apartments (name, price, amount, stars, image_url, description, date) 
                        VALUES (:name, :price, :amount, :stars, :image_url, :description, :date)";
        $apartmentData = [
            'name' => $name,
            'price' => $price,
            'amount' => $amount,
            'stars' => $stars,
            'image_url' => $image_url,
            'description' => $description,
            'date' => $date
        ];
        $db->execute($insertQuery, $apartmentData);

        // Redirect to the index page after apartment creation
        header("Location: /");
        exit();
    }
}

$title = "Create";

require "../App/views/tasks/create-ap.view.php";
?>
