<?php
session_start();
if (!isset($_SESSION["user"])) {
         header("Location: login_form.php");
         exit;
      }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>My Movie</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
            <h1> 映画リスト </h1>
            <?php
            print '<p>ようこそ'.$_SESSION["user"].'さん[<a href="logout.php">ログアウト</a>]</p>';
            ?>
            <form action='top.php' method='get'>
                    感情を選択:<select name="emotion">
                    <option value="movie_id">選択なし</option>
                    <option value="excite">ワクワク</option>
                    <option value="relax">ほっこり</option>
                    <option value="fear">ドキドキ</option>
                    <option value="sad">しょんぼり</option>
                    <option value="anger">イライラ</option>
                </select>
            <input type="submit" value="決定">
            </form>
            <table>
            <tr>
            <td>タイトル</td>
            <td><b>ワクワク度 </b></td>
            <td><b>ほっこり度</b></td>
            <td><b>ドキドキ度</b></td>
            <td><b>しょんぼり度</b></td>
            <td><b>イライラ度</b></td></tr>

            <?php
                function h($str) { return htmlspecialchars($str, ENT_QUOTES, "UTF-8"); }
            $db = new PDO("sqlite:movie.sqlite");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            if(isset($_GET[emotion])){
                $emotion = $_GET[emotion];
            }else{
                $emotion = 'movie_id';
            }
            $result=$db->query("SELECT * FROM evaluation WHERE user_id =  {$_SESSION['id']} ORDER by $emotion DESC");
            //$result=$db->prepare("SELECT * FROM evaluation WHERE user_id=? ORDER by ? DESC");
            //$result->execute(array($_SESSION["id"]));
                for($i = 0; $row=$result->fetch(); ++$i ){  
                    $title=$db->prepare("SELECT * FROM movie WHERE id = ?");
            $title->execute(array($row['movie_id']));
                for($i = 0; $row2=$title->fetch(); ++$i ){          
                    echo "<tr>";
                    echo "<td>". h($row2['title']). "</td>";
                    echo "<td>". h($row['excite']). "</td>";
                    echo "<td>". h($row['relax']). "</td>";
                    echo "<td>". h($row['fear']). "</td>";
                    echo "<td>". h($row['sad']). "</td>";
                    echo "<td>". h($row['anger']). "</td>";
                    echo "</tr>";
            }
        }
            ?>
            </table>   
            <a href="search.php">映画を登録</a>          
            </body>
            </html>
            
            