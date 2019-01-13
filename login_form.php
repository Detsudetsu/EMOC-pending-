<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Login form</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
      <h2>ユーザ名とパスワードを入力してください</h2>
      <form action="login_submit.php" method="get">
      ユーザ名<br><input type="text" name="username"><br>
      パスワード<br><input type="password" name="password"><br>
      <input type="submit" value="送信">
      <br><a href="registration.php">新規登録はこちら</a>
      </form>
  </body>
</html>
