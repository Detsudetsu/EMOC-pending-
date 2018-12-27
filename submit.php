<?php
function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }

if (isset($_GET["user_id"]) && isset($_GET["movie_id"]) && isset($_GET["excite"])&& isset($_GET["relax"])&& isset($_GET["fear"])&& isset($_GET["sad"])&& isset($_GET["anger"])) {
  $user_id=$_GET["user_id"];
  $movie_id=$_GET["movie_id"];
  $excite=$_GET["excite"];
  $relax=$_GET["relax"];
  $fear=$_GET["fear"];
  $sad=$_GET["sad"];
  $anger=$_GET["anger"];

  $pdo=new PDO("sqlite:movie.sqlite");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $st=$pdo->query("INSERT INTO evaluation(user_id, movie_id, excite, relax, fear, sad, anger) VALUES (?,?,?,?,?,?,?)");
  $st->execute(array($user_id, $movie_id, $excite, $relax, $fear, $sad, $anger));

  $result = "登録しました。";
}else{
    $result = "登録できませんでした。";
}
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>登録</title>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <a href="top.html">トップページに戻る</a>
    <?php print '<p>'.h($result).'</p>'; ?>
</body>
</html>