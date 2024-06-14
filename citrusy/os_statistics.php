<?php
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

$sql = "SELECT os_name, count FROM os_statistics ORDER BY count DESC";
$result = $conn->query($sql);

echo "<h1>Operating System Statistics</h1>";
echo "<table border='1'>
<tr>
<th>Operating System</th>
<th>Count</th>
</tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['os_name'] . "</td>";
        echo "<td>" . $row['count'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='2'>No data available</td></tr>";
}
echo "</table>";

$conn->close();
?>
