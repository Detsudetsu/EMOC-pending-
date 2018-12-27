<?php
  session_start();

  if (isset($_GET["username"]) && isset($_GET["password"])) {
    $username = $_GET["username"];
    $password = $_GET["password"];

    $pdo = new PDO("sqlite:movie.sqlite");
      $st = $pdo->prepare("select*from user where username=?");
      $st->execute(array($username));
      $user_on_db = $st->fetch();
      
      if(!$user_on_db){
          $result = "指定したユーザが存在しません。";
      } else if($password === $user_on_db["password"]){
          $_SESSION["user"] = $username;
          $_SESSION["id"] = $user_on_db["id"];
          $result ="ようこそ".$username."さん。ログインに成功しました。";
      } else {
          $result = "パスワードが違います。";
      }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login success</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
      <h2><?php print $result;?></h2>
      <p><a href="top.php">トップページに戻る</a></p>
    </div>
  </body>
</html>
