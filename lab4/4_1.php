<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Високосный год</title>
</head>
<body>
    <h1>Проверка года</h1>
    
    <form method="post">
        <input type="number" name="year" placeholder="Введите год" required>
        <button type="submit">Проверить</button>
    </form>

    <?php
    function isLeapYear($year) {
        // Год високосный, если делится на 4, но не на 100, ИЛИ делится на 400
        return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    }

    if (isset($_POST['year'])) {
        $year = (int)$_POST['year'];

        if (isLeapYear($year)) {
            echo "<div class='result'> Год $year — високосный.</div>";
        } else {
            echo "<div class='result'> Год $year — невисокосный.</div>";
        }
    }
    ?>   
</body>
</html>