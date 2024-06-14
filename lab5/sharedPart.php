<?php
// Определение констант для доступа к базе данных
define('DB_HOST', 'localhost'); // Хост базы данных
define('DB_USER', 'root'); // Имя пользователя базы данных
define('DB_PASSWORD', '1234'); // Пароль для доступа к базе данных
define('DB_NAME', 'Games'); // Имя базы данных

// Подключение к базе данных
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Проверка соединения на наличие ошибок
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Установка кодировки UTF8
$conn->set_charset("utf8");

// SQL-запрос для получения данных из таблицы games
$sql = "SELECT * FROM games";

// Выполнение запроса
$result = $conn->query($sql);

// Вывод данных в табличном виде
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Release Date</th>
                <th>Platform</th>
                <th>Rating</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id"]."</td>
                <td>".$row["title"]."</td>
                <td>".$row["genre"]."</td>
                <td>".$row["releaseDate"]."</td>
                <td>".$row["platform"]."</td>
                <td>".$row["rating"]."</td>
             </tr>";
    }
    echo "</table>";
} else {
    echo "0 результатов";
}

// SQL-запрос для объединения данных из двух таблиц
$sql = "SELECT games.title, characters.name 
        FROM games 
        INNER JOIN characters ON games.id = characters.game_id";

// Выполнение запроса
$result = $conn->query($sql);

// Вывод объединенных данных
if ($result->num_rows > 0) {
    echo "<h2>Объединенные данные:</h2>";
    while($row = $result->fetch_assoc()) {
        echo "Игра: ".$row["title"]." - Персонаж: ".$row["name"]."<br>";
    }
} else {
    echo "0 результатов";
}

// Закрытие соединения
$conn->close();
?>
