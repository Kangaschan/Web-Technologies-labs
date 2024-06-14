<?php
// Функция для замены e-mail на #Cтоп e-mail#
function replaceEmails($message) {
    // Регулярное выражение для поиска e-mail адресов, заканчивающихся на @bsuir.by и @poit.by
    $pattern = '/\b(?!(?:[a-zA-Z0-9._%+-]+@bsuir\.by|[a-zA-Z0-9._%+-]+@poit\.by))\b[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}\b/';

    // Замена всех e-mail на #Cтоп e-mail# кроме e-mail'ов БГУИР и ПОИТ
    $replacement = '#Cтоп e-mail#';
    $message = preg_replace($pattern, $replacement, $message);
    return $message;
}



// Функция для сохранения отзыва в файл
function saveReview($name, $message) {
    // Открыть файл для записи
    $file = fopen("reviews.txt", "a");
    // Проверка успешности открытия файла
    if ($file) {
        // Записать отзыв в файл
        fwrite($file, "Name: $name\nMessage: $message\n\n");
        // Закрыть файл
        fclose($file);
        return true;
    } else {
        return false; // Возвращаем false, если не удалось открыть файл
    }
}

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST["name"];
    $message = $_POST["message"];

    // Замена e-mail адресов в сообщении
    $message = replaceEmails($message);

    // Сохранение отзыва в файл
    if (!saveReview($name, $message)) {
        echo "Не удалось сохранить отзыв.";
    }
}

// Функция для вывода отзывов из файла
function displayReviews() {
    // Попытка открыть файл с отзывами
    if (file_exists("reviews.txt")) {
        // Чтение содержимого файла
        $reviews = file_get_contents("reviews.txt");
        // Вывод содержимого файла
        echo nl2br($reviews);
    } else {
        echo "Отзывов пока нет.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы</title>
</head>
<body>
<h2>Форма отзывов</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Имя: <input type="text" name="name"><br><br>
    Сообщение: <textarea name="message" rows="5" cols="40"></textarea><br><br>
    <input type="submit" name="submit" value="Отправить">
</form>
<hr>
<h2>Отзывы</h2>
<div>
    <?php displayReviews(); ?>
</div>
</body>
</html>
