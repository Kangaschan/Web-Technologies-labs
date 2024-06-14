<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>лаб2, метода</title>
    <style>
        /* Стили для активной ссылки */
        .active {
            background-color: lightblue;
        }
    </style>
</head>
<body>
<?php
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';

function isActive($page, $currentPage) {
    if ($page === $currentPage) {
        return 'class="active"';
    } else {
        return '';
    }
}
?>

<nav>
    <ul>
        <li><a href="?page=home" <?php echo isActive('home', $currentPage); ?>>Главная</a></li>
        <li><a href="?page=about" <?php echo isActive('about', $currentPage); ?>>О компании</a></li>
        <li><a href="?page=services" <?php echo isActive('services', $currentPage); ?>>Услуги</a></li>
        <li><a href="?page=price" <?php echo isActive('price', $currentPage); ?>>Цены</a></li>
        <li><a href="?page=contact" <?php echo isActive('contact', $currentPage); ?>>Контакты</a></li>
    </ul>
</nav>

<div>
    <?php
    // Отображение содержимого в зависимости от текущей страницы
    switch ($currentPage) {
        case 'home':
            echo "<h1>Добро пожаловать на главную страницу!</h1>";
            break;
        case 'about':
            echo "<h1>Информация о компании</h1>";
            break;
        case 'services':
            echo "<h1>Наши услуги</h1>";
            break;
        case 'price':
            echo "<h1>Прайс-лист</h1>";
            break;
        case 'contact':
            echo "<h1>Наши контакты</h1>";
            break;
        default:
            echo "<h1>404: Страница не найдена</h1>";
            break;
    }
    ?>
</div>
</body>
</html>
