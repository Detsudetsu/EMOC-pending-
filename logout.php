<?php
  session_start();

  $_SESSION = array();
  session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Logout</title>
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
      <h2>ログアウトしました</h2>
      <p><a href="top.php">ログイン画面にもどる</a></p>
  </body>
</html>
