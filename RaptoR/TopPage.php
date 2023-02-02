<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();

    $game_list = select_recommend_game($dbh);

    $http_host = $_SERVER['HTTP_HOST'];
    $request_url = $_SERVER['REQUEST_URI'];
    $url = 'http://' . $http_host . $request_url;
    session_start();
    $_SESSION['url'] = $url;
    
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>RaptoR</title>

    <meta name="description"  content="書籍「動くWebデザインアイディア帳」のサンプルサイトです">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!--==============レイアウトを制御する独自のCSSを読み込み===============-->
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="css\toppage.css">
</head>

<body>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>                   

    <h1><今月のおすすめゲーム></h1>
        <ul class="slider">
        <?php foreach($game_list as $game) : ?>
            <?php if($game['flag'] == TRUE): ?>
                <li>
                    <a href="game.php?gameCode=<?= $game['gameCode'] ?>"><img src="images/<?= $game['gameImage'] ?>"/></a>
                    <div class="tc"><strong><?= $game['gameName'] ?></strong></div>
                </li>
            <?php endif ?>
        <?php endforeach ?>
        </ul>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!--自作のJS-->
<script src="JS\topPage.js"></script>
</body>
</html>