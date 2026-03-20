<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Польска</title>
</head>
<body>
    <form method="post">
        <input type="text" name="expr" placeholder="Например: 8 9 + 1 7 - *">
        <button type="submit">Вычислить</button>
    </form>

    <?php
    if (isset($_POST['expr'])) {
        $input = $_POST['expr'];
        $sign = explode(" ", $input);

        $numbers = [];

        foreach ($sign as $s) {
            if ($s == "+" || $s == "-" || $s == "*") {
                $b = array_pop($numbers);
                $a = array_pop($numbers);

                if ($t == "+") $numbers[] = $a + $b;
                if ($t == "-") $numbers[] = $a - $b;
                if ($t == "*") $numbers[] = $a * $b;
            } else {
                $numbers[] = (int)$t;
            }
        }   

        echo $numbers[0];
    }
    ?>
</body>
</html>