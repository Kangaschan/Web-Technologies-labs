<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем текст из формы
    $text = $_POST["text"];

    // Разделяем текст на слова
    $words = explode(" ", $text);

    // Переменная для подсчета встречающихся букв "о" и "О"
    $o_count = 0;

    // Проходим по каждому слову
    foreach ($words as $key => &$word) {
        // Каждое третье слово переводим в верхний регистр
        if (($key + 1) % 3 == 0) {
            $word = strtoupper($word);
        }

        $o_count += mb_substr_count($word, 'о') + mb_substr_count($word, 'О');//англ
        $o_count += mb_substr_count($word, 'о') + mb_substr_count($word, 'О');//рус

        $word_length = mb_strlen($word);
        $new_word = '';
        for ($i = 0; $i < $word_length; $i++) {
            if (($i + 1) % 3 == 0) {
                $new_word .= '<span style="color: violet;">' . mb_substr($word, $i, 1) . '</span>';
            } else {
                $new_word .= mb_substr($word, $i, 1);
            }
        }
        $word = $new_word;
    }

    // Собираем обработанный текст обратно
    $processed_text = implode(" ", $words);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Обработка текста</title>
</head>
<body>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <textarea name="text" rows="10" cols="50"></textarea><br>
    <input type="submit" value="Обработать">
</form>

<?php
// Выводим обработанный текст
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h2>Обработанный текст:</h2>";
    echo $processed_text;

    // Выводим количество букв "о" и "О"
    echo "<h3>Общее количество букв 'о' и 'О': $o_count</h3>";
}
?>
</body>
</html>
