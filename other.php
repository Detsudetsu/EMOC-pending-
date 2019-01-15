<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login_form.php");
    exit;
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>My Movie</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
    <?php
    function h($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
    }
    $db = new PDO("sqlite:movie.sqlite");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    if (isset($_GET['movie_id'])) {
        $movie_id = $_GET['movie_id'];
        if(!isset($user_show)){
        $user_show = $_SESSION['id'];
        } else {
            $user_show=$_GET['user_show'];
            print $user_show;
        }
        $result = $db->query("SELECT * FROM evaluation WHERE  movie_id=$movie_id");
        $title = $db->query("SELECT * FROM movie WHERE id = $movie_id");
            while ($row2 = $title->fetch()) {
                echo "<h1>".h($row2['title'])."</h1><br>";
                while ($row = $result->fetch()) {
                $name = $db->query("SELECT*FROM user WHERE id = {$row['user_id']}");
                while ($row3 = $name->fetch()) {
                echo "<h2>".h($row3['username'])."さんの評価</h2>";
                echo "<p>ワクワク:".h($row['excite'])."</p>";
                echo "<p>ほっこり:".h($row['relax'])."</p>";
                echo "<p>ドキドキ:".h($row['fear'])."</p>";
                echo "<p>しょんぼり:".h($row['sad'])."</p>";
                echo "<p>イライラ:".h($row['anger'])."</p>";
                }
            }
        }
        echo "<a href='top.php'>トップページに戻る</a>";
    }
    php?>
    </body>
<html>