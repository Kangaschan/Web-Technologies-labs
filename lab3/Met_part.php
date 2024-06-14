<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Contents</title>
</head>
<body>
<h2>Directory Contents</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="directory">Введите путь к каталогу:</label><br>
    <input type="text" id="directory" name="directory"><br><br>
    <input type="submit" value="Получить содержимое">
</form>

<?php
function formatSize($bytes) {
    $kb = $bytes / 1024;
    return round($kb, 2) . ' KB';
}

function displayDirectoryContents($dir) {
    if (is_dir($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $path = $dir . '/' . $file;
                echo '<hr>';
                echo '<p><strong>Имя:</strong> ' . $file . '</p>';
                echo '<p><strong>Размер:</strong> ';
                if (is_dir($path)) {
                    $size = formatSize(dirSize($path));
                } else {
                    $size = formatSize(filesize($path));
                }
                echo $size . '</p>';
                echo '<p><strong>Дата создания:</strong> ' . date("Y-m-d H:i:s", filectime($path)) . '</p>';
                echo '<p><strong>Дата последней модификации:</strong> ' . date("Y-m-d H:i:s", filemtime($path)) . '</p>';
                echo '<p><strong>Дата последнего доступа:</strong> ' . date("Y-m-d H:i:s", fileatime($path)) . '</p>';
                echo '<p><strong>Иконка:</strong> ';
                if (is_dir($path)) {
                    echo 'Папка';
                } else {
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo '<img src="image_icon.png" alt="Иконка изображения">';
                    } elseif ($ext == 'txt') {
                        echo '<img src="text_icon.png" alt="Иконка текстового файла">';
                    } else {
                        echo 'Другой файл';
                    }
                }
                echo '</p>';
                if (is_file($path) && in_array($ext, ['txt', 'html', 'css', 'php'])) {
                    echo '<p><strong>Содержание (первые 100 символов):</strong> ';
                    echo htmlspecialchars(file_get_contents($path, NULL, NULL, 0, 100));
                    echo '</p>';
                }
            }
        }
    } else {
        echo '<p style="color:red;">Ошибка: Указанный путь не является каталогом.</p>';
    }
}

function dirSize($dir) {
    $size = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file){
        $size += $file->getSize();
    }
    return $size;
}

function calculateGraphicsPercentage($dir) {
    $totalSize = dirSize($dir);
    $graphicSize = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir)) as $file){
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $graphicSize += $file->getSize();
        }
    }
    $percentage = ($graphicSize / $totalSize) * 100;
    return round($percentage, 2);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['directory']) && !empty($_POST['directory'])) {
        $directory = $_POST['directory'];
        echo '<h3>Содержимое каталога: ' . $directory . '</h3>';
        displayDirectoryContents($directory);
        $graphicsPercentage = calculateGraphicsPercentage($directory);
        echo '<p><strong>Процентное отношение графических файлов к общему объему данных:</strong> ' . $graphicsPercentage . '%</p>';
    } else {
        echo '<p style="color:red;">Ошибка: Путь к каталогу не был указан.</p>';
    }
}
?>
</body>
</html>
