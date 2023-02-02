<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RaptoЯとは</title>
    <link href="reset.css" rel="stylesheet">
    <link href="css\raptor.css" rel="stylesheet"/>
</head>
<body>
    <?php include "header.php" ?>
    <?php include "sidebar.php" ?>   
    <header id="header">
    <div id="loading">Loading...</div>
    <div id="youtube-area">
    <h1>RaptoЯとは</h1>
    <div id="youtube"></div><!--youtube表示エリア-->
    <div id="youtube-mask"></div><!--youtubeマスクエリア-->
    </div>
    </header>
    <div id="container">
    <p>RaptoЯとはPCゲーム・PCソフトウェアのダウンロード販売を目的としたプラットフォームでです。</p>
    <!--/container--></div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="JS\raptor.js"></script>
</body>
</html>