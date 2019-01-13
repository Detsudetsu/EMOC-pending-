<?php
    session_start();
    function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
    $pdo=new PDO("sqlite:movie.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    if(isset($_GET["username"])&& isset($_GET["password"])){
        $username=$_GET["username"];
        $password=$_GET["password"];
    
        $st=$pdo->prepare("INSERT INTO user(username, password) VALUES (?,?)");
        $st->execute(array($username,$password));
        $result = "登録しました。";
    }else{
        $result = "登録できませんでした。";
    }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>registration form</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <?php print '<p>'.h($result).'</p>'; ?>
    <a href="top.php">トップページに戻る</a>
  </body>
</html>