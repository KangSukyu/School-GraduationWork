<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();
    session_start();
    $prevPage = $_SESSION['url'];

    if(isset($_SESSION['member'])){
        $email = $_SESSION['member']['email'];
    }else{
        header('location:'.$prevPage);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['add'])){
            $gamecode = $_POST['gameCode'];

            if(check_buy($dbh,$email,$gamecode) == false){
                $alert = "<script type='text/javascript'>alert('すでに購入した商品です。');</script>";
                echo $alert;

            }else if(check_basket($dbh,$email,$gamecode) == true){
                insert_basket($dbh,$email,$gamecode);

            }else{
                $alert = "<script type='text/javascript'>alert('カートに同じ商品があります。');</script>";
                echo $alert;
            }
        }
        else if(isset($_POST['delete'])){
            delete_basket($dbh,$email);
        }else if(isset($_POST['onedelete'])){
            $gamecode = $_POST['gameCode'];
            // var_dump($gamecode);
            delete_basket_one($dbh,$email,$gamecode);
        }

    }

    if(!empty($_SESSION['member'])){
        $email = $_SESSION['member']['email'];
        $basket = select_basket($dbh,$email);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="reset.css" rel="stylesheet">
    <link href="css\cart.css" rel="stylesheet"/>
    <title>ショッピングカート</title>
</head>
<body>
    <?php include "header.php" ?>
    <h1>カート</h1><br>
    <div class="carthaba">
    <?php if (empty($basket)) : ?>
        <p>カートに商品はありません。</p>

    <?php else : ?>
        <?php foreach($basket as $game): ?>
            <table>
                <tr>
                    <td rowspan="4" width="400" height="200">
                        <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
                        <img src="images/<?= $game['gameImage'] ?>" />
                    </td>
                    <td>
                        <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
                        <strong class="name"><?= $game['gameName'] ?></strong>
                    </td>
                </tr>
                <tr>
                    <td>
                    <div class="moji"><?= $game['gameExplanation'] ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if($game['price'] == 0): ?>
                        <div class="price">無料プレイ</div>
                        <?php else: ?>
                        <div class="price">¥<?= number_format($game['price']) ?></div>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php if($game['recommend'] == 1): ?>
                        <div class="osusume">★おすすめ★</div>
                        <?php endif ?>
                    </td>
                </tr>
                <tr>
                    <td >
                        <div class="btnyoko">
                        <form action="Buy.php" method="POST">
                            <input type="hidden" name="gameCode" value="<?= $game['gameCode'] ?>"/>
                            <input class="onebuy" type="submit" name="onebuy" value="購入"/>
                        </form>
                        <form action="" method="POST">
                            <input type="hidden" name="gameCode" value="<?= $game['gameCode'] ?>"/>
                            <input class="onebye" type="submit" name="onedelete" value="削除"/>
                        </form>
                        </div><!-- btnyoko -->
                    </td>
                </tr>
            </table>
            <hr />
        <?php endforeach; ?>
        </div>
        <div class="btnkotei">
        <form action="Buy.php" method="POST">
            <input class="allbuy" type="submit" name="buy" value="すべての商品を購入"/>
        </form>
        <form action="" method="POST">
            <input type="hidden" name="gameCode" value="<?= $game['gameCode'] ?>"/>
            <input class="allbye" type="submit" name="delete" value="すべての商品を削除"/>
        </form>
        </div>
    <?php endif; ?>
    <?php include "sidebar.php" ?>
    <!-- <script src="JS\cart.js"></script> -->

    
</body>
</html>
