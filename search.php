<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login_form.php");
        exit;
     }
?>
<?php
function h($str){return htmlspecialchars($str, ENT_QUOTES, "UTF-8");}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>検索画面</title>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>映画を検索</h1>
    <?php

        if(isset($_GET['id'])) 	      $id=$_GET['id']; 
        if(isset($_GET['title'])) 	  $title=$_GET['title']; 
        if(isset($_GET['key'])) 	  $key=$_GET['key']; 

        $db = new PDO("sqlite:movie.sqlite");
        
        if(isset($key)){
            if($key==="ア"){
                $result=$db->query("SELECT*from movie WHERE head='a'");
            }else if($key==="カ"){
                $result=$db->query("SELECT*from movie WHERE head='ka'");
            }else if($key==="サ"){
                $result=$db->query("SELECT*from movie WHERE head='sa'");
            }else if($key==="タ"){
                $result=$db->query("SELECT*from movie WHERE head='ta'");
            }else if($key==="ナ"){
                $result=$db->query("SELECT*from movie WHERE head='na'");
            }else if($key==="ハ"){
                $result=$db->query("SELECT*from movie WHERE head='ha'");
            }else if($key==="マ"){
                $result=$db->query("SELECT*from movie WHERE head='ma'");
            }else if($key==="ヤ"){
                $result=$db->query("SELECT*from movie WHERE head='ya'");
            }else if($key==="ラ"){
                $result=$db->query("SELECT*from movie WHERE head='ra'");
            }else if($key==="ワ"){
                $result=$db->query("SELECT*from movie WHERE head='wa'");
            }else{
                echo "<p>正しく入力し直してください</p>";
                echo "<a href='search.php'>検索をやり直す</a><br>";
                echo "<a href='top.html'>トップページに戻る</a>";
                exit();
            }
                for($i = 0; $row=$result->fetch(); ++$i ){
                echo "<table cellpadding=0 cellspacing=0>";
                echo "<tr valign=center>";
                echo "<td >". h($row['id']) . ":</td>";
                echo "<td >". h($row['title']). "</td>";
                echo "</tr>";
                echo "</table>";
                echo "<br>";
                }
                echo "<p>登録したい映画のIDを入力して下さい</p>";
                echo "<form action=form.php method=get>";
                echo "<input type=text size=20 name=movie_id>";
                echo "<input type=submit value='検索'><br>";
                echo "<a href='search.php'>検索をやり直す</a>";
        }else{
            echo "<p>検索したい映画タイトルの頭文字をカタカナで入力してください</p>";
            echo "<form action=search.php method=get>";
            echo "<input type=text size=20 name=key>";
            echo "<input type=submit value='検索'>";
            echo "</form>";
            echo "<br>";
        }
    ?>
    <br>
    <a href="top.php">トップページに戻る</a>
</body>
</html>