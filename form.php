<?php
    session_start();
    if(isset($_SESSION["user"])){
          
      }else{
          header("Location:login_form.php");
        exit;
      }
?>
<?php
  function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>登録画面</title>
    <link rel="stylesheet" type=""range"/value="1" min="1" max="5"dia="screen" href="main.css" />
  </head>
  <body>
      <form action=submit.php method="get">
      <h2>新しい映画を登録</h2>
      <p>それぞれの感情にたいして1~5の数値で評価してください</p>
      <?php 
      if(isset($_GET['movie_id'])) 	  $movie_id=$_GET['movie_id']; 

      $db = new PDO("sqlite:movie.sqlite");
      $result=$db->query("SELECT*from movie WHERE id='$movie_id'");
      $row=$result->fetch();
      print "<h3>".h($row['title'])."</h3>";
      ?>

      <table border=0 cellpadding=0 cellspacing=0>
      <tr><td>わくわく:</td><td> <input type="button" class="circleBtn excite" value="1" name="excite"></td></tr>
      <tr><td>ほっこり:</td><td> <input type="button" class="circleBtn relax" value="1" name="relax"></td></tr>
      <tr><td>どきどき:</td><td> <input type="button" class="circleBtn fear" value="1" name="fear"></td></tr>
      <tr><td>しょんぼり:</td><td> <input type="button" class="circleBtn sad" value="1" name="sad"></td></tr>
      <tr><td>いらいら:</td><td> <input type="button" class="circleBtn anger" value="1" name="anger"></td></tr>
      <tr><td> </td><td>

      <!-- 横並びだとこう。name="$emotion"をつけていないので登録テストは上のもので -->
      <input type="button" class="circleBtn excite" value="1">
      <input type="button" class="circleBtn relax" value="1">
      <input type="button" class="circleBtn fear" value="1">
      <input type="button" class="circleBtn sad" value="1">
      <input type="button" class="circleBtn anger" value="1">
      <script src="clickCircleBtn.js"></script>

      <input type=hidden name="movie_id" value=<?php print $movie_id?>>
      <?php 
        $_SESSION["movie_id"]=$movie_id;
      ?>
      <input type=submit border=0 value="登録"></td></tr>
      </table>
      </form>
      <a href="top.php">トップページに戻る</a>
  </body>
</html>
