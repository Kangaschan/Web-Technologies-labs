<?php
if (!function_exists('getOS')) {
    function getOS() {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $osArray = [
            'Windows' => 'Windows',
            'Mac OS' => 'Macintosh',
            'Linux' => 'Linux',
            'Android' => 'Android',
            'iOS' => 'iPhone',
        ];

        foreach ($osArray as $os => $match) {
            if (stripos($userAgent, $match) !== false) {
                return $os;
            }
        }
        return 'Unknown';
    }
}

$servername = "localhost";
$username = "root"; // Убедитесь, что это правильное имя пользователя
$password = "1234"; // Убедитесь, что это правильный пароль
$dbname = "website_statistics";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$os = getOS();

// Проверяем, существует ли уже запись для данной ОС
$sql = "SELECT * FROM os_statistics WHERE os_name='$os'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Обновляем существующую запись
    $sql = "UPDATE os_statistics SET count=count+1 WHERE os_name='$os'";
} else {
    // Вставляем новую запись
    $sql = "INSERT INTO os_statistics (os_name, count) VALUES ('$os', 1)";
}

if ($conn->query($sql) === TRUE) {
    // Опционально: можно убрать echo, чтобы не выводить сообщение на каждую загрузку страницы
    // echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
