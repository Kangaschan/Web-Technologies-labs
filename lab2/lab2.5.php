<?php
// Проверяем, были ли переданы аргументы через HTTP запросы
if (isset($_GET['words'])) {
    // Получаем переданные слова из массива $_GET
    $words = explode(" ", $_GET['words']);

    // Инициализируем переменную для хранения самого длинного слова
    $longest_words = [];
    $max_length = 0;

    // Обходим каждое переданное слово
    foreach ($words as $word) {
        $word_length = mb_strlen($word);

        // Если длина текущего слова больше максимальной длины, обновляем максимальную длину
        if ($word_length > $max_length) {
            $max_length = $word_length;
            // Сбрасываем массив самых длинных слов, так как нашли новое самое длинное слово
            $longest_words = [$word];
        }
        // Если длина текущего слова равна максимальной длине, добавляем его в массив самых длинных слов
        elseif ($word_length === $max_length) {
            $longest_words[] = $word;
        }
    }

    // Выводим самые длинные слова
    echo "Самые длинные слова: " . implode(", ", $longest_words) . "\n";
} else {
    // Если слова не были переданы через HTTP запросы, выводим сообщение об ошибке
    echo "Слова не были переданы через HTTP запросы.\n"; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отправка массива строк</title>
</head>
<body>
<form action="lab2.5.php" method="get">
    <label for="words">Слова (разделенные пробелом):</label><br>
    <textarea id="words" name="words" rows="4" cols="50"></textarea><br><br>

    <input type="submit" value="Найти самые длинные слова">
</form>
</body>
</html>
