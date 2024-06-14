<?php
// Подключение к базе данных
define('DB_HOST', 'localhost'); // Хост базы данных
define('DB_USER', 'root'); // Имя пользователя базы данных
define('DB_PASSWORD', '1234'); // Пароль для доступа к базе данных
define('DB_NAME', 'News'); // Имя базы данных
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Проверка соединения на наличие ошибок
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Установка кодировки UTF8
$conn->set_charset("utf8");

// Получение даты новости из параметра запроса
$date = $_GET['date'];

// Запрос к базе данных для получения данных новости по этой дате
$sql = "SELECT * FROM calendar WHERE date = '$date'";
$result = $conn->query($sql);

// Проверка наличия новости
if ($result->num_rows > 0) {
    // Отображение данных новости
    $row = $result->fetch_assoc();
    echo "<h2>{$row['title']}</h2>";
    echo "<p>{$row['content']}</p>";
    echo "<img src='{$row['img']}' alt='Изображение новости'>";
} else {
    // Если новость не найдена
    echo "<p>Новость не найдена.</p>";
}

// Закрытие соединения
$conn->close();
?>
