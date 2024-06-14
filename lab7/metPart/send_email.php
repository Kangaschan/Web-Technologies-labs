<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "email_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Получение списка адресатов из базы данных
    $sql = "SELECT email FROM recipients";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Отправка письма каждому адресату
        while($row = $result->fetch_assoc()) {
            $to = $row['email'];
            $headers = "From: your_email@example.com";

            if (mail($to, $subject, $message, $headers)) {
                echo "Email sent to: " . $to . "<br>";
            } else {
                echo "Failed to send email to: " . $to . "<br>";
            }
        }
    } else {
        echo "No recipients found.";
    }

    $conn->close();
}
?>
