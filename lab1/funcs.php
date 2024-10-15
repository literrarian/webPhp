<?php

function Connect($username,$dbname)
{
    $host = 'localhost';
    $port = 5433;
    $password = 'postgres';

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    } catch (PDOException $pe) {
        die("Ошибка");
    }
    echo('Подключение успешно');
    header("Location: ../../articles.php");

}
function getArticleByID($id)
{
    if (!$id)
    {
        echo ('Кошмар какой, напишите цифру');
        die();
    }
    $path = 'pics/';
    $conn = new PDO("pgsql:host=localhost;port=5433;dbname=postgres", 'postgres', 'postgres');
    $stmt = $conn->prepare('SELECT summary,article, pic FROM lab1 WHERE id=:id LIMIT 1;');
    $stmt->execute(array('id' => $id));
    if($stmt->rowCount() > 0){
        foreach($stmt as $row){
            echo 'Статья: ' ."<br>". $row[0] ."<br>".$row[1];
            $file = $path . $row[2];
            echo '<a><img src=' . $file . '></a>';
        }
    }
    else{
        echo "Не найдено";
    }
    $conn = null;
}
function getArticleByCompany($company)
{
    $conn = new PDO("pgsql:host=localhost;port=5433;dbname=postgres", 'postgres', 'postgres');
    $result = $conn->query('SELECT name,summary,article FROM lab1;');
    while($row = $result->fetch()){
        if (str_contains($row[1],$company)|| str_contains($row[2],$company))
        {
            echo($row[0].'<br>');
        }
    }

    $conn = null;
}
?>