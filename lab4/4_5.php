<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="number" name="n">
        <button type="submit">Вычислить</button>
    </form>

    <?php
    function factorial($n) {
        if ($n <= 1) return 1;
        return $n * factorial($n - 1);
    }

    if (isset($_POST['n'])) {
        echo factorial((int)$_POST['n']);
    }
    ?>
</body>
</html>