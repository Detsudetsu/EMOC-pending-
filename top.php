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
        <!-- set canvas -->
        <div id="canvas_wrapper">
            <canvas id="canvas" width="160px" height="300px"></canvas>
        </div>        
        <a href="search.php" class="eval eval4">映画を登録</a>
        <form action='top.php' method='get'>
            感情を選択<br>
            <button name = emotion value=1>選択なし</button>
            <button name = emotion value="excite" class="excite">ワクワク</button>
            <button name = emotion value="relax" class="relax">ほっこり</button>
            <button name = emotion value="fear" class="fear">ドキドキ</button>
            <button name = emotion value="sad" class="sad">しょんぼり</button>
            <button name = emotion value="anger" class="anger">イライラ</button>
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
                $emotion = 1;
            }
            
            echo "<style type='text/css'>";
            echo "button.excite{}";
            echo "button.relax{}";
            echo "button.fear{}";
            echo "button.sad{}";
            echo "button.anger{}";
            if($emotion=="excite"){
                echo "button.excite{
                    background-color: #f79b23 !important;
                    color: #FFF;
                 }";
            }else if($emotion=="relax"){
                echo "button.relax{
                    background-color: #7ed168 !important;
                    color: #FFF;
                 }";
            }else if($emotion=="fear"){
                echo "button.fear{
                    background-color: #be4eff  !important;
                    color: #FFF;
                 }";
            }else if($emotion=="sad"){
                echo "button.sad{
                    background-color: #5e76ff !important;
                    color: #FFF;
                 }";
            }else if($emotion=="anger"){
                echo "button.anger{
                    background-color: #b10000 !important;
                    color: #FFF;
                 }";
            }
            echo "</style>";
            
            $result = $db->query("SELECT * FROM evaluation WHERE user_id =  {$_SESSION['id']}");
            while ($row = $result->fetch()) {
                $title = $db->prepare("SELECT * FROM movie WHERE id = ?");
                $title->execute(array($row['movie_id']));
                while ($row2 = $title->fetch()) {
                    echo '<a href="#" class="eval eval' . h($row["$emotion"]) . ' '.$emotion.'">' . h($row2['title']) . "</a>";
                    //echo '<a href="#" class="eval eval' . h($row["$emotion"]) . '">' . h($row2['title']) . "</a>";
                }
            }
            ?>

        <!-- visualization of evaluation -->
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', () => {
                
                // setup
                const canvas = document.getElementById("canvas");
                const ctx = canvas.getContext("2d");

                // set color
                const excite = "#f79b23a0";
                const relax = "#7ed168a0";
                const fear = "#be4effa0";
                const sad = "#5e76ffa0";
                const anger = "#b10000a0";

                // function to draw circle
                const drawCircle = (evaluation_val, index, emotion) => {
                    ctx.fillStyle = "#323232";
                    ctx.fillStyle = emotion;
                    ctx.beginPath();
                    ctx.arc(20*(index%5)+35, 20*(parseInt(index/5))+35, 5 + 2 * evaluation_val, 0, Math.PI * 2, true);
                    ctx.fill();
                }

                // main process
                <?php
                $result = $db->query("SELECT * FROM evaluation WHERE user_id =  {$_SESSION['id']}");
                for ($i = 0; $row = $result->fetch(); ++$i) {
                    $title = $db->prepare("SELECT * FROM movie WHERE id = ?");
                    $title->execute(array($row['movie_id']));
                    while ($row2 = $title->fetch()) {
                        echo 'drawCircle(' . h($row["$emotion"]) . ",$i," . h($emotion) . ');';  // -> drawCircle(evaluation_val,index);
                    }
                }
                ?>
            });
        </script>  
    </body>
</html>