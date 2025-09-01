<?php
include('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header('Content-Type: application/json');
        echo json_encode(["status" => "error", "message" => "UserName already exist!!"]);

    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, email,mobile) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $email, $mobile);
        $stmt->execute();
        header('Content-Type: application/json');
        echo json_encode(["status" => "success", "message" => "Registered successfully !!", "user" => $username]);
        exit();
    }
}
?>