<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="text" name="expr" placeholder="Например: 8 9 + 1 7 - *">
        <button type="submit">Вычислить</button>
    </form>

    <?php
    if (isset($_POST['expr'])) {
        $input = $_POST['expr'];
        $tokens = explode(" ", $input);

        $stack = [];

        foreach ($tokens as $t) {
            if ($t == "+" || $t == "-" || $t == "*") {
                $b = array_pop($stack);
                $a = array_pop($stack);

                if ($t == "+") $stack[] = $a + $b;
                if ($t == "-") $stack[] = $a - $b;
                if ($t == "*") $stack[] = $a * $b;
            } else {
                $stack[] = (int)$t;
            }
        }   

        echo $stack[0];
    }
    ?>
</body>
</html>