<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <input type="number" name="year" placeholder="Введите год">
        <button type="submit">Проверить</button>
    </form>

    <?php
    if (isset($_POST['year'])) {
        $year = (int)$_POST['year'];

        if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
            echo "YES";
        } else {
            echo "NO";
        }
    }
    ?>   
</body>
</html>

