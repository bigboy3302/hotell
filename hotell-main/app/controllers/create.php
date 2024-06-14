<?php
// No need to start session as it's already started elsewhere

require "../app/models/Task.php";
require "../app/core/Validator.php";

// Pārbaudām vai lietotājs ir administrators
function checkIfAdmin($user) {
    if (!$user->isAdmin()) {
        header("Location: /");
        die();
    }
}

// Validē POST datus un atgriež kļūdu masīvu
function validatePostData($postData, $fileData) {
    $errors = [];

    if (!Validator::string($postData["location"], min: 1, max: 255)) {
        $errors["location"] = "Location cannot be empty or too long";
    }

    if (!Validator::string($postData["title"], min: 1, max: 255)) {
        $errors["title"] = "Title cannot be empty or too long";
    }

    if ($fileData['error'] !== UPLOAD_ERR_OK) {
        $errors["image"] = "Invalid image format";
    }

    if (!Validator::number($postData["price"], min: 1, max: 9999)) {
        $errors["price"] = "Invalid price format";
    }

    if (!isset($postData["availability"]) || !Validator::number($postData["availability"], min: 0, max: 1)) {
        $errors["availability"] = "Invalid availability";
    }

    return $errors;
}

// Augšupielādē failu un atgriež ceļu vai kļūdu
function uploadImage($fileData) {
    $uploadDir = 'Public/images/';
    $uploadFile = $uploadDir . basename($fileData['name']);
    
    if (move_uploaded_file($fileData['tmp_name'], $uploadFile)) {
        return $uploadFile;
    } else {
        throw new Exception("Failed to move the uploaded file");
    }
}

// Pārbaudām vai lietotājs ir administrators
checkIfAdmin($user);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $errors = validatePostData($_POST, $_FILES['image']);

        if (empty($errors)) {
            $uploadFilePath = uploadImage($_FILES['image']);
            
            $query = "INSERT INTO listings (title, image, price, availability, location)
                      VALUES (:title, :image, :price, :availability, :location);";
            $params = [
                ":title" => $_POST["title"],
                ":image" => $uploadFilePath, // Saglabā ceļu uz attēlu
                ":price" => $_POST["price"],
                ":availability" => $_POST["availability"],
                ":location" => $_POST["location"],
            ];
            $db->execute($query, $params);

            header("Location: /");
            die();
        }
    } catch (Exception $e) {
        $errors["image"] = $e->getMessage();
    }
}
$title = "Create a task";
require "../app/views/create.view.php";