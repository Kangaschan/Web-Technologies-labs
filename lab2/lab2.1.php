<?php
$parameters = array();

// Получаем параметры из командной строки
for ($i = 1; $i < $argc; $i++) {
    // Определяем тип данных для каждого параметра
    $parameter = $argv[$i];
    if (is_numeric($parameter)) {
        if (strpos($parameter, '.') !== false) {
            $parameters[$parameter] = "дробное число";
        } else {
            $parameters[$parameter] = "целое число";
        }
    } else {
        $parameters[$parameter] = "строка";
    }
}

// Выводим результаты
foreach ($parameters as $param => $type) {
    echo "Параметр '$param' имеет тип данных: $type\n";
}
?>
