<?php
session_start();

require_once './Authenticator.php';

$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "Users";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    exit();
}

$authenticator = new Authenticator($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $email_user = $_POST["email"];
    $password_user = $_POST["password"];
    if ($authenticator->authenticate($email_user, $password_user)) {
        $_SESSION['email'] = $email_user;
        header("Location: ../task_01/index.php");
        exit();
    } else {
        echo "Неправильный email или пароль";
    }
}

$conn->close();
?>
