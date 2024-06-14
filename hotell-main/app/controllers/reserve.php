<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");
$database = new Database($config);

if (!empty($_SESSION['user_id'])) {
    $user = new User($database, $_SESSION['user_id']);
} else {
    header("Location: /login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve-button'])) {
    $listingId = filter_input(INPUT_POST, 'listingId', FILTER_SANITIZE_NUMBER_INT);

    // Fetch listing details
    $listingDetails = $database->getListing($listingId);

    if ($listingDetails) {
        // Reserve the listing
        $database->reserve([
            'listingId' => $listingId,
            'title' => $listingDetails['title'],
            'image' => $listingDetails['image'],
            'price' => $listingDetails['price'],
            'availability' => false,
            'location' => $listingDetails['location']
        ]);

        header("Location: /");
        exit();
    } else {
        // Handle error if listing not found
        // Redirect or display error message
    }
}

$pageTitle = "Reserve";