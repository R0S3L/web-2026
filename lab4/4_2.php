<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Цифры в буквы</title>
</head>
<body>
    <form method="post">
        <input type="number" name="digit" min="0" max="9">
        <button type="submit">Показать</button>
    </form>

    <?php
    function digitToWord($d) {
        if ($d == 0) return "Ноль";
        if ($d == 1) return "Один";
        if ($d == 2) return "Два";
        if ($d == 3) return "Три";
        if ($d == 4) return "Четыре";
        if ($d == 5) return "Пять";
        if ($d == 6) return "Шесть";
        if ($d == 7) return "Семь";
        if ($d == 8) return "Восемь";
        if ($d == 9) return "Девять";
    }

    if (isset($_POST['digit'])) {
        echo digitToWord((int)$_POST['digit']);
    }
    ?>
</body>
</html>