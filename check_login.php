<?php
include('db.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password, is_admin FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed, $is_admin);
        $stmt->fetch();
        if (password_verify($password, $hashed)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['is_admin'] = $is_admin;
            $_SESSION['name'] = $username;
            header('Content-Type: application/json');
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
            // header("Location: " . ($is_admin ? "admin_dashboard.php" : "dashboard.php"));
            exit();
        } else {
            header('Content-Type: application/json');
            echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(["status" => "error", "message" => "Invalid username or password"]);
    }
}
?>