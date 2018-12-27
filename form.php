<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>登録画面</title>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
  </head>
  <body>
      <form action=submit.php method="get">
      <h2>新しい映画を登録</h2>
      
      <input type=submit   value="登録">
      </form>
  </body>
</html>
