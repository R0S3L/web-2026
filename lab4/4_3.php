<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    <input type="text" name="date" placeholder="ДД.ММ.ГГГГ">
    <button type="submit">Определить</button>
</form>

<?php
if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $parts = explode('.', $date);
    $day = (int)$parts[0];
    $month = (int)$parts[1];

    if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) echo "Водолей";
    else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) echo "Рыбы";
    else if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) echo "Овен";
    else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) echo "Телец";
    else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 20)) echo "Близнецы";
    else if (($month == 6 && $day >= 21) || ($month == 7 && $day <= 22)) echo "Рак";
    else if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) echo "Лев";
    else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) echo "Дева";
    else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 22)) echo "Весы";
    else if (($month == 10 && $day >= 23) || ($month == 11 && $day <= 21)) echo "Скорпион";
    else if (($month == 11 && $day >= 22) || ($month == 12 && $day <= 21)) echo "Стрелец";
    else echo "Козерог";
}
?>
</body>
</html>