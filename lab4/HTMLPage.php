<?php

class HTMLPage
{
    private $title;
    private $conn;
    private $files;
    public $content;

    public function __construct($title)
    {
        $this->title = $title;
        $this->connectDB();
        $this->files = array_values(array_diff(scandir('images'), array('..', '.')));
    }

    private function connectDB()
    {
        $host = 'localhost';
        $port = 5433;
        $password = 'postgres';
        $username = 'postgres';
        $dbname = 'postgres';
        try {
            $this->conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
            $this->content = file_get_contents('html.html');
        } catch (PDOException $pe) {
            die($pe);
        }
    }

    public function header()
    {
        $this->content = str_replace('{{ header }}', $this->title, $this->content);
    }

    public function footer()
    {
        $footer = "&copy; 2024 Бебебе Бябябя all rights reserved";
        $this->content = str_replace('{{ footer }}', $footer, $this->content);
    }

    public function logo()
    {
        $this->content = str_replace('{{ logo }}', 'images/Logo.jpg', $this->content);

    }

    public function menu()
    {
        $stmt = $this->conn->query('SELECT id, name FROM lab4');
        $listHtml = '';
        while ($row = $stmt->fetch()) {
            $listHtml .= "<li><a href='item.php?id={$row[0]}'>{$row[1]}</a></li>";
        }
        $this->content = str_replace('{{ menu }}', $listHtml, $this->content);

    }

    public function content($text)
    {
        if (isset($_GET['id'])) {
            $article_id = (int)$_GET['id'];
            $stmt = $this->conn->prepare('SELECT id, name, article FROM lab4 WHERE id = ?');
            $stmt->execute([$article_id]);
            $article = $stmt->fetch();

            if ($article) {
                $pic_id = strlen((string)$article['id']) == 2 ? 't' . $article_id . '.jpg' : 't0' . $article_id . '.jpg';
                $files = $this->files;
                $key = array_search($pic_id, $files);
                if ($key) {
                    $article[] = $files[$key];
                } else {
                    $article[] = 'none';
                }
                $this->title = $article['name'];
                //переведи артикл в строку!!!!!!!!!!11!!!!111!!!!!
                $sight = $article;
                $content = "<h2>{$sight[1]}</h2>
                <p>{$sight[2]}</p>
                <img src='images/{$sight[3]}' alt='Фото4ка' class='article-image' />";
                $this->content = str_replace('{{ content }}', $content, $this->content);

            }
        } else {
            $this->content = str_replace('{{ content }}', $text, $this->content);
        }
    }

    public function write($content)
    {
        $this->header();
        $this->logo();
        $this->menu();
        $this->content($content);
        $this->footer();
        echo $this->content;
    }
}

?>