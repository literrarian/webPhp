

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
        <h2>Введите id статьи: </h2>
        <label for="article">
            id: <input type="number" id="article" name="article">
        </label><br><br>
        <button type="submit" id="submit">Найти</button>
    </form>

    <form action="" method="post">
        <h2>Введите название компании: </h2>
        <label for="company">
            Компания: <input type="text" id="company" name="company">
        </label><br><br>
        <button type="submit" id="submit">Найти</button>
    </form>

    <?php
    require_once 'funcs.php';
    if (isset($_POST['article'])) {
        getArticleByID($_POST['article']);}
    if (isset($_POST['company'])) {
        getArticleByCompany(ucfirst($_POST['company'])); }
    ?>

</main>
</body>
</html>