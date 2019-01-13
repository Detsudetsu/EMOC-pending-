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
                $result=$db->query("SELECT*from movie WHERE head='$key'");
        }else{
                $result=$db->query("SELECT*from movie");
            }
            echo "<form action=search.php method=get>";
            echo "<button name=key value='a'>ア行</button>";
            echo "<button name=key value='ka'>カ行</button>";
            echo "<button name=key value='sa'>サ行</button>";
            echo "<button name=key value='ta'>タ行</button>";
            echo "<button name=key value='na'>ナ行</button>";
            echo "<button name=key value='ha'>ハ行</button>";
            echo "<button name=key value='ma'>マ行</button>";
            echo "<button name=key value='ya'>ヤ行</button>";
            echo "<button name=key value='ra'>ラ行</button>";
            echo "<button name=key value='wa'>ワ行</button>";
            echo "</form>";
            echo "<br>";
                for($i = 0; $row=$result->fetch(); ++$i ){
                echo "<a href='form.php?movie_id=".h($row['id'])."'>".h($row['title'])."</a>";
                echo "<br>";
                }
    ?>
    <br>
    <a href="top.php">トップページに戻る</a>
</body>
</html>