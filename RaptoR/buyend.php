<?php
    session_start();
    $err = '';

    if(isset($_SESSION['error'])){
        $err = $_SESSION['error'];
    }


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="reset.css" rel="stylesheet">
    <link href="css\buyend.css" rel="stylesheet"/>
    <title>RaptoR</title>
</head>
<body>
    <?php include "header.php" ?>
<div id="wrapper">
<canvas id="particle"></canvas>
<!--/wrapper--></div>
    <?php if (!empty($err)) : ?>
        <p><?= $err ?></p>
    <?php else : ?>
        <h3><a href="Kategori.php">ゲームの購入を続ける</a></h3>
        <h3><a href="buyHistory.php">購入履歴へ</a></h3>
        <h3><a href="TopPage.php">トップページへ戻る</a></h3>
    <?php endif; ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="JS\particleText.js"></script><!--https://github.com/55Kaerukun/particleText.jsからダウンロードして使用-->
<!--自作のJS-->
<script src="JS\buyend.js"></script>
</body>
</html>