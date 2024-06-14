<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");


$db = new Database($config);
$user = new User($db, $_SESSION['user_id']);

// Ja lietotājs nav administrators, pārsūtīt uz sākumlapu
if (!$user->isAdmin()) {
    header("Location: /");
    die();
}

$errors = [];
$title = "";
$image = "";
$price = "";
$location = "";
$id = "";

// Pārbaudīt, vai pieprasījuma metode ir POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? "";
    $title = $_POST["title"] ?? "";
    $price = $_POST["price"] ?? "";
    $location = $_POST["location"] ?? "";

    // Validācija
    if (!Validator::string($title, ['min' => 1, 'max' => 255])) {
        $errors["title"] = "Nosaukums nedrīkst būt tukšs vai pārāk garš";
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE && $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors["image"] = "Kļūda attēla augšupielādē";
    }

    if (!Validator::number($price, ['min' => 1, 'max' => 9999])) {
        $errors["price"] = "Nepareiza cena";
    }

    if (!Validator::string($location, ['min' => 1, 'max' => 255])) {
        $errors["location"] = "Lokācija nedrīkst būt tukša vai pārāk gara";
    }

    // Ja nav kļūdu, veikt datubāzes atjaunināšanu
    if (empty($errors)) {
        $imagePath = "";

        // Pārbaudīt, vai ir augšupielādēts attēls
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = $uploadFile;
            } else {
                $errors["image"] = "Neizdevās augšupielādēt attēlu";
            }
        }

        // Ja nav kļūdu, izpildīt datubāzes atjaunināšanu
        if (empty($errors)) {
            $query = "UPDATE listings
                      SET title = :title, price = :price, location = :location" . ($imagePath ? ", image = :image" : "") . "
                      WHERE id = :id";
            
            $params = [
                ":title" => $title,
                ":price" => $price,
                ":location" => $location,
                ":id" => $id
            ];

            if ($imagePath) {
                $params[":image"] = $imagePath;
            }

            $db->execute($query, $params);

            header("Location: /");
            exit();
        }
    }
} elseif (isset($_GET["id"])) {
    // Ja pieprasījuma metode ir GET un ir norādīts ID, iegūt ieraksta datus
    $id = $_GET["id"];
    $query = "SELECT * FROM listings WHERE id = :id";
    $params = [":id" => $id];
    $listing = $db->execute($query, $params)->fetch();

    // Aizpildīt mainīgos ar esošo ierakstu datiem
    $title = $listing["title"];
    $image = $listing["image"];
    $price = $listing["price"];
    $location = $listing["location"];
}



// Include the view file to render the page
require "../app/views/edit.view.php";