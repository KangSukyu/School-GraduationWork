<?php
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();

    $http_host = $_SERVER['HTTP_HOST'];
    $request_url = $_SERVER['REQUEST_URI'];
    $url = 'http://' . $http_host . $request_url;
    session_start();
    $_SESSION['url'] = $url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RaptoR</title>
    <link href="css\reset.css" rel="stylesheet">
    <link href="css\kategori.css" rel="stylesheet"/>
</head>
<body>
    <?php include "header.php" ?>
    <h1>カテゴリー</h1><br>
    <div class="checkbox">
        <form id="form" action="./check.php" method="POST">
            <input type="checkbox" id="checkbox2" name="checkbox[]" value="1"/>
            <label for="checkbox1">RPG</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="2"/>
            <label for="checkbox2">FPS</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="3"/>
            <label for="checkbox3">アクション</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="4"/>
            <label for="checkbox4">カジュアル</label>
            
            <input type="checkbox" id="checkbox2" name="checkbox[]" value="5"/>
            <label for="checkbox5">サンドボックス</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="6"/>
            <label for="checkbox6">アドベンチャー</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="7"/>
            <label for="checkbox7">MMO</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="8"/>
            <label for="checkbox8">ファンタジー</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="9"/>
            <label for="checkbox9">ハックアンドスラッシュ</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="10"/>
            <label for="checkbox10">対戦型格闘</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="11"/>
            <label for="checkbox11">オープンワールド</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="12"/>
            <label for="checkbox12">オンラインプレイ</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="13"/>
            <label for="checkbox13">パーティー</label>

            <input type="checkbox" id="checkbox2" name="checkbox[]" value="14"/>
            <label for="checkbox14">サバイバル</label>
            
            <input type="submit" id="submit" value="検索"/>
        </form>
    </div>

    <?php include "sidebar.php" ?>
</body>
</html>