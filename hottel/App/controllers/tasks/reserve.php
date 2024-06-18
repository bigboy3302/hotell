<?php
require "../App/Core/Database.php";

auth();
$config = require "../App/config.php";
$db = new Database($config);

$reservations = $db->execute("SELECT * FROM reservations WHERE user_id = ?", [$_SESSION['user_id']])->fetchAll();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (isset($_POST['cancel'])) {
            $reserve_id = $_POST['reserve_id'];
            $db->unreserve($reserve_id);
            header("Location: /");
            die();
        } elseif (isset($_POST['finished'])) {
            $reserve_id = $_POST['reserve_id'];
            $db->unreserve($reserve_id);
            header("Location: /write-review");
            die();
        } elseif (isset($_POST['apartment_id'])) {
            $apartment_id = $_POST['apartment_id'];
            $db->reserve($apartment_id, $_SESSION['user_id']);
            header("Location: /");
            die();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

$title = "reserve";
require "../App/views/tasks/reserve.view.php";
?>
