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

if (isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Add any additional input validation here

    if ($password !== $confirmPassword) {
        $signupError = "Passwords do not match. Please try again.";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user information into the database
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to dashboard or desired page
            exit();
        } else {
            $signupError = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
