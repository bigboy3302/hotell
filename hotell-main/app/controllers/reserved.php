<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");



// Inicializējam datubāzes savienojumu, izmantojot konfigurācijas iestatījumus
$databaseConnection = new Database($config);

// Pārbaudām, vai sesijā ir definēts lietotāja ID
if (isset($_SESSION['user_id'])) {
    // Izveidojam jaunu User objektu, izmantojot datubāzes savienojumu un lietotāja ID
    $currentUser = new User($databaseConnection, $_SESSION['user_id']);
} else {
    // Ja lietotāja ID nav, pāradresējam uz pieteikšanās lapu un beidzam skripta izpildi
    header("Location: /login");
    exit();
}

// Izpildām vaicājumu, lai iegūtu visus rezervētos ierakstus
$queryString = "SELECT * FROM reserved";
$reservedEntries = $databaseConnection->execute($queryString)->fetchAll(); // Iegūstam visus rezervētos ierakstus

// Definējam lapas virsrakstu
$pageTitle = "Reserved Listings";

// Pārbaudām, vai lietotājam ir administratora tiesības un attiecīgi ielādējam pareizo skatu
if ($currentUser->isAdmin()) {
    include "../app/views/reserved.view.php";
} else {
    include "../app/views/reserved.view.php";
}

?>
