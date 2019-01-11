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
    <div class="login">
        <?php
        print '<p>ようこそ' . $_SESSION["user"] . 'さん[<a href="logout.php">ログアウト</a>]</p>';
        ?>
    </div>
        <h1> 映画リスト </h1>
        <form action='top.php' method='get'>
            感情を選択<br>
            <button name = emotion value="movie_id">選択なし</button>
            <button name = emotion value="excite">ワクワク</button>
            <button name = emotion value="relax">ほっこり</button>
            <button name = emotion value="fear">ドキドキ</button>
            <button name = emotion value="sad">しょんぼり</button>
            <button name = emotion value="anger">イライラ</button>
        </form>

            <?php
            function h($str)
            {
                return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
            }
            $db = new PDO("sqlite:movie.sqlite");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            if (isset($_GET['emotion'])) {
                $emotion = $_GET['emotion'];
            } else {
                $emotion = 'movie_id';
            }
            $result = $db->query("SELECT * FROM evaluation WHERE user_id =  {$_SESSION['id']} ORDER by $emotion DESC");
            //$result=$db->prepare("SELECT * FROM evaluation WHERE user_id=? ORDER by ? DESC");
            //$result->execute(array($_SESSION["id"]));
            while ($row = $result->fetch()) {
                $title = $db->prepare("SELECT * FROM movie WHERE id = ?");
                $title->execute(array($row['movie_id']));
                while ($row2 = $title->fetch()) {
                    echo '<a href="#" class="eval eval' . h($row["excite"]) . '">' . h($row2['title']) . "</a>";
                }
            }
            ?>

        <!-- visualization of evaluation -->
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', () => {
                
                // setup
                const canvas = document.getElementById("canvas");
                canvas.height = window.innerHeight;
                const ctx = canvas.getContext("2d");

                // function to draw circle
                const drawCircle = (evaluation_val, index) => {
                    ctx.fillStyle = `rgba(255,50,100,${0.4 + evaluation_val*0.1}`;
                    ctx.beginPath();
                    ctx.arc(80*(index%5)+35, 72*(index/5)+35, 10 + 5 * evaluation_val, 0, Math.PI * 2, true);
                    ctx.fill();
                }

                // main process
                <?php
                $result = $db->query("SELECT * FROM evaluation WHERE user_id =  {$_SESSION['id']} ORDER by $emotion DESC");
                for ($i = 0; $row = $result->fetch(); ++$i) {
                    $title = $db->prepare("SELECT * FROM movie WHERE id = ?");
                    $title->execute(array($row['movie_id']));
                    while ($row2 = $title->fetch()) {
                        echo 'drawCircle(' . h($row["excite"]) . ",$i" . ');';  // -> drawCircle(evaluation_val,index);
                    }
                }
                ?>
            });
        </script>

        
        <!-- set canvas -->
        <div id="canvas_wrapper">
            <canvas id="canvas" width="435px"></canvas>
        </div>

        <a href="search.php">映画を登録</a>          
    </body>
</html>