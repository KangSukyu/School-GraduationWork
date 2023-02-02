<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();
    $kategori_all = select_kategori_all($dbh);

    if(isset($_GET['kategoriId'])){
        $kategoriid = $_GET['kategoriId'];
        $game_list = select_game_by_kategoriid($dbh,$kategoriid);
    }else{
        $game_list = null;
    }

    $http_host = $_SERVER['HTTP_HOST'];
    $request_url = $_SERVER['REQUEST_URI'];
    $url = 'http://' . $http_host . $request_url;
    session_start();
    $_SESSION['url'] = $url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RaptoR</title>
    <link href="css\reset.css" rel="stylesheet">
    <link href="css\kategori.css" rel="stylesheet"/>
</head>
<body>

<?php include "header.php" ?>
    <h1>カテゴリー</h1><br>
    <ul class="tab">
        <?php foreach($kategori_all as $kategori) : ?>
            <li>
                <a class="tc" href="Kategori.php?kategoriId=<?= $kategori['kategoriId'] ?>">
                <b><?= $kategori['kategoriName'] ?></b></a>
            </li>
        <?php endforeach ?>
    </form>

    <!-- <form action="" method="POST">
        <?php foreach($kategori_all as $kategori) : ?>
                <?= $kategori['kategoriId'] ?><?= $kategori['kategoriName'] ?>
        <?php endforeach ?>
        <input type="submit" value="検索"><br>
    </form> -->
    </ul>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
    <!--自作のJS-->
    <!-- <script src="JS\kategori.js"></script>かてごりのJavaScript -->
        <table align="left">
        <?php if($game_list != null):?> 
            <?php foreach($game_list as $game) : ?>
                <?php if($game['flag'] == TRUE): ?>
                    <div class="yoko">
                     <ul class="tktab">
                        <li>
                            <div class="maov">
                                <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
                                <div class="size"><img class="gazou" src="images/<?= $game['gameImage'] ?>"/></div>
                                <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
                                <div class="kabuse">
                                    <div class="moji"><strong><?= $game['gameName'] ?></strong></div>
                                    <?php if($game['price'] == 0): ?>
                                    <div class="moji">無料プレイ</div>
                                    <?php else: ?>
                                    <div class="moji">¥<?= number_format($game['price']) ?></div>
                                    <?php endif ?>
                                    <div class="moji"><?= $game['recommend'] == 1 ? "★おすすめゲーム★" : "" ?></div>
                                </div><!-- kabuse -->
                            </div><!-- maov -->
                        </li>
                     </ul>
                    </div><!-- yoko -->
                <?php endif ?>
            <?php endforeach ?>
        <?php else:?>
            <div class="tt"><p>カテゴリーを選択してください。</p></div>
        <?php endif ?>
        </table>
    <?php include "sidebar.php" ?>
</body>
</html>