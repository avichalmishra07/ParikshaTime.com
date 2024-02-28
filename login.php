<?php
session_start();

// Database connection (replace with your credentials)
$host = 'localhost';
$username = 'your_db_username';
$password = 'your_db_password';
$database = 'your_db_name';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        if (password_verify($password, $storedPassword)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $loginError = "Incorrect password. Please try again.";
        }
    } else {
        $loginError = "User not found. Please check your username.";
    }
}

?>