<?php
// Многомерный массив
$multi_dimensional_array = array(
    "первый" => array(
        "второй" => array(
            "третий" => array(
                "четвёртый" => array(
                    "пятый" => array(
                        "дальше"=> array()
                    )
                )
            )
        )
    )
);

// Функция для отображения многомерного массива с разными цветами
function displayArray($array, $level = 0) {
    // Определяем цвет в зависимости от уровня вложенности
    switch ($level) {
        case 0:
            $color = 'red';
            break;
        case 1:
            $color = 'blue';
            break;
        case 2:
            $color = 'green';
            break;
        case 3:
            $color = 'purple';
            break;
        default:
            $color = 'yellow';
            break;
    }

    // Выводим открывающий тег
    echo "<ul style='color: $color;'>";

    // Обходим каждый элемент массива
    foreach ($array as $key => $value) {
        // Выводим ключ и значение элемента
        echo "<li>$key: ";
        // Если значение - массив, рекурсивно вызываем функцию для него
        if (is_array($value)) {
            displayArray($value, $level + 1);
        } else {
            // Выводим значение элемента
            echo "$value";
        }
        // Закрываем тег <li>
        echo "</li>";
    }

    // Закрываем тег <ul>
    echo "</ul>";
}

// Выводим многомерный массив с разными цветами
displayArray($multi_dimensional_array);
