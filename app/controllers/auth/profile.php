<?php
require_once "../app/core/Validator.php";
require_once "../app/core/Database.php";
require_once "../app/models/User.php";
$config = require("../app/config.php");
// Inicializē datubāzes savienojumu, izmantojot konfigurāciju
$database = new Database($config);

// Autentifikācijas funkcijas izsaukums
auth();

// Pārbaudiet, vai lietotāja ID ir sesijā
$userid = $_SESSION['user_id'] ?? null;

// Ja lietotājs nav pieslēdzies, iziet no skripta
if (is_null($userid)) {
    exit("neesi piesledzies.");
}

try {
    // Izveido lietotāja objektu, nododot datubāzes savienojumu un lietotāja ID
    $currentUser = new User($database, $userid);
} catch (Exception $ex) {
    exit($ex->getMessage());
}

// Ja POST pieprasījums ir saņemts
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Debugging: Izejas POST datus
    echo "Received POST data: Username = $username, Email = $email, Password = $password";

    try {
        // Atjauno lietotāja profilu ar ievadītajiem datiem
        $currentUser->updateProfile($username, $email, $password);
        // Pāradresē, lai izvairītos no formas atkārtotas iesniegšanas
        header("Location: /profile");
        exit();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

// Uzstāda lapas virsrakstu
$pageTitle = "Profile";
// Iegūst lietotāja datus
$userData = $currentUser->getUserData();

// Ielādē atbilstošo skatu, atkarībā no tā, vai lietotājs ir administrators
if ($currentUser->isAdmin()) {
    require "views/admin/profile.view.php";
} else {
    require "views/user/profile.view.php";
}
?>
