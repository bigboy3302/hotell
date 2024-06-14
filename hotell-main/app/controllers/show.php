<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");
// Izveido jaunu Database objektu izmantojot konfigurāciju
$database = new Database($config);

// Izveido jaunu User objektu ar datubāzi un sesijas lietotāja ID
$loggedInUser = new User($database, $_SESSION['user_id']);

// SQL vaicājums, lai iegūtu datus no listings tabulas pēc norādītā ID
$sqlQuery = "SELECT * FROM listings WHERE id = :id";
$queryParams = [":id" => $_GET["id"]];

// Izpilda SQL vaicājumu un iegūst rezultātu
$listingData = $database->execute($sqlQuery, $queryParams)->fetch();

// Nosaka lapas nosaukumu
$pageTitle = "Listing info";

// Pārbauda, vai lietotājs ir administrators un ielādē attiecīgo skatu
if ($loggedInUser->isAdmin()) {
    require "../app/views/show.view.php";
} else {
    require "../app/views/show.view.php";
}
