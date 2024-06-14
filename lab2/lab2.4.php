<?php
// Проверяем, было ли передано число через HTTP запросы
if (isset($_GET['number'])) {
    // Получаем число из массива $_GET
    $num = $_GET['number'];

    // Проверяем, является ли переданное значение числом
    if (!is_numeric($num)) {
        echo "Параметр должен быть числом.\n";
        exit(1);
    }

    // Переводим число в строку для удобства обработки
    $num_str = (string)$num;

    // Инициализируем переменную для хранения суммы цифр
    $sum = 0;

    // Считаем сумму цифр
    for ($i = 0; $i < strlen($num_str); $i++) {
        $sum += intval($num_str[$i]);
    }

    // Выводим результат
    echo "Сумма цифр числа $num равна: $sum\n";
} else {
    // Если число не было передано, выводим сообщение об ошибке
    echo "Число не было передано через HTTP запросы.\n";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отправка числа</title>
</head>
<body>
<form action="lab2.4.php" method="get">
    <label for="number">Число:</label>
    <input type="number" id="number" name="number" required><br><br>

    <input type="submit" value="Посчитать сумму цифр">
</form>
</body>
</html>
