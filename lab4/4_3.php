<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="date" placeholder="День и Месяц">
        <button type="submit">Определить знак зодиака</button>
    </form>

    <?php
    // Выносим логику определения знака в функцию
    function getZodiacSign($day, $month) {
        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) return "Водолей";
        else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) return "Рыбы";
        else if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) return "Овен";
        else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) return "Телец";
        else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) return "Близнецы";
        else if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) return "Рак";
        else if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) return "Лев";
        else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) return "Дева";
        else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) return "Весы";
        else if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) return "Скорпион";
        else if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) return "Стрелец";
        else return "Козерог";
    }

    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $parts = explode('.', $date);

        // Проверка, чтобы избежать ошибок, если точка не введена
        if (count($parts) >= 2) {
            $day = (int)$parts[0];
            $month = (int)$parts[1];
            
            // Вызываем функцию и выводим результат
            echo getZodiacSign($day, $month);
        }
    }
    ?>
</body>
</html>