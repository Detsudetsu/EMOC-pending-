<?php
    session_start();
    if (!isset($_SESSION["user"])) {
        header("Location: login_form.php");
        exit;
     }
?>
<?php
    function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
    $pdo=new PDO("sqlite:movie.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    if (isset($_GET["excite"])&& isset($_GET["relax"])&& isset($_GET["fear"])&& isset($_GET["sad"])&& isset($_GET["anger"])) {
        $user_id=$_SESSION["id"];
        $movie_id=$_SESSION["movie_id"];
        $excite=$_GET["excite"];
        $relax=$_GET["relax"];
        $fear=$_GET["fear"];
        $sad=$_GET["sad"];
        $anger=$_GET["anger"];

        $st=$pdo->query("INSERT INTO evaluation(user_id,movie_id,excite, relax, fear, sad, anger) VALUES (?,?,?,?,?,?,?)");
        $st->execute(array($user_id,$movie_id,$excite, $relax, $fear, $sad, $anger));

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
    <link rel="stylesheet" type="text/css" media="screen"  href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <?php print '<p>'.h($result).'</p>'; ?>
    <a href="top.php">トップページに戻る</a>
</body>
</html>