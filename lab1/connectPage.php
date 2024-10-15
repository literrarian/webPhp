

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная 1</title>
</head>

<body>
<main>
    <form action="" method="post">
        <h2>Подключение</h2>
        <label for="user">
            Пользователь: <input type="text" id="user" name="user">
        </label><br><br>

        <label for="dbname">
            БД: <input type="text" id="dbname" name="dbname">
        </label><br><br>

        <button type="submit" id="submit">Подключиться</button>
    </form>
</main>
<?php
    require_once 'funcs.php';
    if (isset($_POST['user'])||isset($_POST['dbname'])) {
        Connect($_POST['user'],$_POST['dbname']);}
?>
</body>
</html>