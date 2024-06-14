<?php
// Получаем количество строк из параметров командной строки
if ($argc != 2) {
    echo "Usage: php generate_table.php <number_of_rows>\n";
    exit(1);
}

$num_rows = intval($argv[1]);

// Генерируем HTML таблицу
echo "<table border='1'>\n";
echo "<tr><th>№</th></tr>\n";
for ($i = 1; $i <= $num_rows; $i++) {
    echo "<tr><td>$i</td></tr>\n";
}
echo "</table>";
?>
