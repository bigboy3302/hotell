<?php
require '../App/Core/Database.php'; // Adjust the path as necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room = $_POST['room'];
    $userId = $_SESSION['user_id'];

    $db = new Database();
    $query = "UPDATE users SET chosen_room = :room WHERE id = :id";
    $db->query($query);
    $db->bind(':room', $room);
    $db->bind(':id', $userId);
    $db->execute();

    header('Location: /profile');
    exit();
}
?>
