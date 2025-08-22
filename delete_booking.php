<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
header("Content-Type: application/json");

include('db.php');


if (isset($_POST['id'])) {
    $bookingId = intval($_POST['id']);

    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();

    echo json_encode(["status" => "success", "id" => $bookingId]);


    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No booking ID provided"]);
}

$conn->close();
?>