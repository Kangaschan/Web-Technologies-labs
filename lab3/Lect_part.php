<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge Sets</title>
</head>
<body>
<h2>Merge Sets</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="set1">Введите первый набор чисел:</label><br>
    <input type="text" id="set1" name="set1"><br>
    <label for="set2">Введите второй набор чисел:</label><br>
    <input type="text" id="set2" name="set2"><br><br>
    <input type="submit" value="Объединить">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['set1']) && isset($_POST['set2'])) {
        $set1 = explode(" ", $_POST['set1']);
        $set2 = explode(" ", $_POST['set2']);

        if (!allNumeric($set1) || !allNumeric($set2)) {
            echo "<p style='color:red;'>Ошибка: Наборы должны содержать только числа.</p>";
            exit;
        }

        $set1 = array_filter($set1);
        $set2 = array_filter($set2);

        $result = array_merge($set1, array_diff($set2, $set1));

        echo "<p>Результат объединения: " . implode(" ", $result) . "</p>";
    } else {
        echo "<p style='color:red;'>Ошибка: Необходимо передать оба набора чисел.</p>";
    }
}

function allNumeric($array) {
    foreach ($array as $value) {
        if (!is_numeric($value)) {
            return false;
        }
    }
    return true;
}
?>
</body>
</html>
