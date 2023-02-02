<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();
    session_start();

    if(empty($_SESSION['member'])){
        header('Location:login.php');
        exit();
    }

    if(isset($_POST['buy'])){
        $email = $_SESSION['member']['email'];
        buy_insert_all($dbh,$email);
        uriage_insert_all($dbh,$email);
        delete_basket($dbh,$email);
        header('Location: buyend.php');
        exit();
    }

    if(isset($_POST['onebuy'])){
        $email = $_SESSION['member']['email'];
        $gamecode = $_POST['gameCode'];
        buy_insert_one($dbh,$email,$gamecode);
        uriage_insert_one($dbh,$email,$gamecode);
        delete_basket_one($dbh,$email,$gamecode);
        header('Location: buyend.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="reset.css" rel="stylesheet">
    <link href="css\uriage.css" rel="stylesheet"/>
    <title>RaptoR</title>
</head>
<body>
<?php include "header.php" ?>

    <p>すでに購入した商品があります。</p>
</body>
</html>