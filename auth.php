<?php
session_start();
$con = new mysqli('localhost', 'root', '', 'webproj');

if ($con->connect_error) {
    die("Database Connection Failed: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $con->prepare("SELECT * FROM `loginlog` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();


        if ($password==$row['password']) {
            echo "Password match! Redirecting...";
            $_SESSION['user'] = $row['username'];
            header("Location: http://localhost:5500/index2.html");
            exit();
        } else {
            echo "Password does NOT match!";
            exit();
        }
    } else {
        echo "Username not found!";
        exit();
    }

    $stmt->close();
    $con->close();
}

header("Location: http://localhost/AD-LAB-PROJ/login.html"); // Redirect on failure
exit();
?>
