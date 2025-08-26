<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="header.css">
<script src="header.js"></script>
<header>
    <div style="text-align:center;">
        <img src="turf_booking_mng.png" height="100px;">
    </div>
    <button class="menu-toggle" onclick="toggleMenu()">☰</button>
    <nav id="mainMenu">
        <a href="create.php">Create</a>
        <a href="list.php">List</a>
        <a href="slot-av.php">Slots Availability</a>
        <a href="pie.php">Sports wise collection</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="report_view.php">Report</a>
        <a href="https://wa.me/7304477711?text=Hi%20%2C%20I%20need%20help%20or%20more%20clearification%20on%20booking%20of%20turf%20%3F"
            target="_blank"><i style="padding: 0 10px;color:green" class="fab fa-whatsapp"></i>Support</a> <a
            href="logout.php">Logout(<?= $_SESSION['name'] ?>)</a>
    </nav>
</header>