<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");
$db = new Database($config);

if (isset($_SESSION['user_id'])) {
    $user = new User($db, $_SESSION['user_id']);
} else {
    header("Location: /login");
    die();
}

$query = "SELECT * FROM listings";
$params = [];

if (isset($_GET["search"]) && $_GET["search"] != "") {
    $search = $_GET["search"];
    $query .= " WHERE title LIKE :search";
    $params[":search"] = "%$search%";
}

if (isset($_GET["sort"])) {
    if ($_GET["sort"] == "price_asc") {
        $query .= " ORDER BY price ASC";
    } elseif ($_GET["sort"] == "price_desc") {
        $query .= " ORDER BY price DESC";
    }
}

$listings = $db
        ->execute($query, $params)
        ->fetchAll();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    echo '<link rel="stylesheet" href="Public/CSS/index.style.css">'; // Include the CSS link
    require "views/admin/listings.partial.view.php";
    die();
}

$title = "Listings";

if ($user->isAdmin()) {
    require "../app/views/index.view.php";
} else {
    require "../app/views/index.view.php";
}
?>