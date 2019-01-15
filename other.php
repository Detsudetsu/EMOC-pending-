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
        $result = $db->query("SELECT * FROM evaluation WHERE user_id =  {$_SESSION['id']} AND movie_id=$movie_id");
        while ($row = $result->fetch()) {
            $title = $db->query("SELECT * FROM movie WHERE id = $movie_id");
            while ($row2 = $title->fetch()) {
                echo "<h1>".h($row2['title'])."の評価</h1>";
                echo "<p>ワクワク:".h($row['excite'])."</p>";
                echo "<p>ほっこり:".h($row['relax'])."</p>";
                echo "<p>ドキドキ:".h($row['fear'])."</p>";
                echo "<p>しょんぼり:".h($row['sad'])."</p>";
                echo "<p>イライラ:".h($row['anger'])."</p>";
            }
        }
    }
    php?>
    </body>
<html>