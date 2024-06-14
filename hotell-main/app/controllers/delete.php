<?php
auth();
require "../app/config.php";
require "../app/core/Database.php";

$dbConnection = new Database($config);

// Pārbaudām, vai pieprasījuma metode ir POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Iegūstam no POST pieprasījuma saņemto listings ID
    $listingId = $_POST["listingId"];

    // Definējam SQL vaicājumu, lai dzēstu ierakstu ar attiecīgo ID
    $sql = "DELETE FROM listings WHERE id = :listingId";
    // Parametru piesaistīšana SQL vaicājumam
    $parameters = [":listingId" => $listingId];

    // Izpildām SQL vaicājumu ar piesaistītajiem parametriem
    $dbConnection->execute($sql, $parameters);

    // Pāradresējam lietotāju uz sākumlapu un pārtraucam skripta izpildi
    header("Location: /");
    exit();
}