<?php
// Определение констант для доступа к базе данных
define('DB_HOST', 'localhost'); // Хост базы данных
define('DB_USER', 'root'); // Имя пользователя базы данных
define('DB_PASSWORD', '1234'); // Пароль для доступа к базе данных
define('DB_NAME', 'News'); // Имя базы данных

// Подключение к базе данных
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Проверка соединения на наличие ошибок
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Установка кодировки UTF8
$conn->set_charset("utf8");

// Функция для проверки наличия новостей на определенную дату
function newsExists($date, $conn) {
    $sql = "SELECT COUNT(*) as count FROM calendar WHERE date = '$date'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

// Создание календаря
echo "<h2>Календарь новостей</h2>";
echo "<table border='1'>";
echo "<tr><th>Дата</th><th>Наличие новостей</th></tr>";

// Генерация календаря на текущий месяц
$currentMonth = date('m');
$currentYear = date('Y');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

for ($day = 1; $day <= $daysInMonth; $day++) {
    $date = date("$currentYear-$currentMonth-$day");
    echo "<tr>";
    echo "<td>$date</td>";
    echo "<td>";
    if (newsExists($date, $conn)) {
        echo "<a href='news.php?date=$date'>Есть новости</a>";
    } else {
        echo "Нет новостей";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

// Закрытие соединения
$conn->close();
?>
