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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    $email_user = $_POST["email"];
    $password_user = $_POST["password"];

    $authenticator = new Authenticator($conn);
    if ($authenticator->authenticate($email_user, $password_user)) {
        $_SESSION['email'] = $email_user;
        header("Location: ../task_01/index.php");
        exit();
    } else {
        echo "Неправильный email или пароль";
        exit();
    }
}

if (isset($_SESSION['email'])) {
    header("Location: ../task_01/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register_email"]) && isset($_POST["register_password"])) {
    $email_user = $_POST["register_email"];
    $password_user = $_POST["register_password"];

    // Хешируем пароль перед сохранением
    $hashed_password = password_hash($password_user, PASSWORD_DEFAULT);

    // Сохраняем пользователя в базе данных
    $sql = "INSERT INTO users (email, password) VALUES ('$email_user', '$hashed_password')";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Ошибка регистрации: " . $conn->error;
        exit();
    }

    // Приветствие после успешной регистрации
    echo "Здравствуйте, $email_user. Вы успешно зарегистрировались!";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../lab6/task_03/style.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <title>Форма авторизации</title>
</head>

<body>
<section>
    <form action="./index.php" method="post">
        <h1>Авторизация</h1>
        <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" name="email" required>
            <label>Email</label>
        </div>
        <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" required>
            <label>Пароль</label>
        </div>
        <div class="forget">
            <label><input type="checkbox">Запомнить меня</label>
        </div>
        <button>Войти</button>
    </form>
    <br>
    <form action="./index.php" method="post">
        <h1>Регистрация</h1>
        <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" name="register_email" required>
            <label>Email</label>
        </div>
        <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="register_password" required>
            <label>Пароль</label>
        </div>
        <button>Зарегистрироваться</button>
    </form>
</section>
</body>
</html>
