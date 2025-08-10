
<?php
$conn = new mysqli("localhost", "root", "", "turf_booking_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
