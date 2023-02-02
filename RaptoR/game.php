<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();
    session_start();

    if(isset($_GET['gameCode'])){
        $gamecode = $_GET['gameCode'];
        $game = inner_join_game($dbh, $gamecode);
        $_SESSION['gameCode'] = $_GET['gameCode'];
    }

    if(!empty($_SESSION['member'])){
        $member = $_SESSION['member'];
    }
    
    $http_host = $_SERVER['HTTP_HOST'];
    $request_url = $_SERVER['REQUEST_URI'];
    $url = 'http://' . $http_host . $request_url;
    $_SESSION['url'] = $url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css\reset.css" rel="stylesheet">
    <link href="css\game.css" rel="stylesheet"/>
    <title>商品明細</title>
</head>
<body>
<?php include "header.php" ?>
    <h1><?=$game['gameName']?></h1><br>
    <table class="center">
        <tr>
            <td rowspan="9">
                <div class="width">
                   <video class="video" src="video/<?= $game['gameVideo']?>" autoplay muted loop></video>
                </div>
            </td>
            <td>
                <div class="Explanation">
                    <?= $game['gameExplanation']?>
                </div>
            </td>
        </tr>
        
        <tr class="setuko">
            <td>
                <div class="moto">カテゴリー：</div><?= $game['kategoris']?>
            </td>
        </tr>
        <tr class="setuko">
            <td>
            <div class="moto">開発元：</div><?= $game['developerName']?>
            </td>
        </tr>
        <tr class="setuko">
            <td>
            <div class="moto">パブリッシャー：</div><?= $game['publisherName']?>
            </td>
        </tr>
        <tr class="setuko">
            <td>
                <?php if($game['price'] == 0): ?>
                    <div class="moji">無料プレイ</div>
                <?php else: ?>
                    <div class="moto">単価：</div><div class="moji">¥<?= number_format($game['price']) ?></div>
                <?php endif ?>
            </td>
        </tr>
        <tr class="setuko">
            <td>
            <div class="moto">発売日：</div><?= $game['releaseDate']?>
            </td>
        </tr>
        <tr>
            <td>
                <?php if($game['recommend']==1): ?>
                    <div class="osusume">★おすすめ★</div>
                <?php else: ?>
                    
                <?php endif ?>
            </td>
        </tr>
        <tr  class="setuko">
            <td>
                <?php if(isset($member['membername'])): ?>
                <form action="cart.php" method="POST">
                    <input type="hidden" name="gameCode" value="<?= $game['gameCode'] ?>"/>
                    <input class="buy" type="submit" name="add" style="width: 150px; height: 40px;" value="カートに入れる"/>
                </form>
                <?php else: ?>
                    <p>【ログインしないと購入はできません。】</p>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php include "sidebar.php" ?>
</body>
</html>