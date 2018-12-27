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
    <p>検索したい映画タイトルの頭文字をカタカナで入力してください</p>
    
    <form action=search.php method=get>
            <input type=text size=20 name=key>
            <input type=submit value="検索">
    </form>
    
    <br>

    <table cellpadding=0 cellspacing=0>
    <tr>
    <?php

        if(isset($_GET['id'])) 	      $id=$_GET['id']; 
        if(isset($_GET['title'])) 	  $title=$_GET['title']; 
        if(isset($_GET['key'])) 	  $key=$_GET['key']; 

        $db = new PDO("sqlite:movie.sqlite");

        if(isset($key)){
            $result=$db->query("SELECT*from movie");
            for($i = 0; $row=$result->fetch(); ++$i ){
                echo "<tr valign=center>";
                echo "<td >". h($row['id']) . "</td>";
                echo "<td >". h($row['title']). "</td>";
                echo "</tr>";
            }
        }
    ?>

    <tr> <td colspan=6>&nbsp</td> </tr>
    </table>

    <br>
    <a href="top.php">トップページに戻る</a>
</body>
</html>