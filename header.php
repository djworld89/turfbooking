<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
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
        <a href="logout.php">Logout(<?= $_SESSION['name'] ?>)</a>
    </nav>
</header>