<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Счастливый билет</title>
</head>
<body>
    <form method="post">
        <input type="text" name="start" placeholder="Начало">
        <input type="text" name="end" placeholder="Конец">
        <button type="submit">Найти</button>
    </form>

    <?php
    if (isset($_POST['start']) && isset($_POST['end'])) {
        $start = (int)$_POST['start'];
        $end = (int)$_POST['end'];

        for ($i = $start; $i <= $end; $i++) {
            $num = str_pad($i, 6, "0", STR_PAD_LEFT);

            $sum1 = $num[0] + $num[1] + $num[2];
            $sum2 = $num[3] + $num[4] + $num[5];

            if ($sum1 == $sum2) {
                echo $num . "<br>";
            }
        
        }
    }
    ?>    
</body>
</html>