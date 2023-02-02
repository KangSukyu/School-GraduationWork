<?php
    require_once 'DB\db_helper.php';
    
    $dbh = get_db_connect();

    $test_goods = select_testgoods($dbh);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品表示</title>
    <link href="css\reset.css" rel="stylesheet">
    <link href="css\kategori.css" rel="stylesheet"/>
</head>
<body>
    <?php include "header.php" ?>
    <h1>カテゴリー検索結果</h1>
    <table border="1">
        <?php foreach($test_goods as $goods): ?>
            <tr>
                <td>
                    <?= $goods['gameName'] ?>
                </td>
                <td>
                    <?= $goods['kategoris'] ?>
                </td>
                <td>
                    <?= $goods['price'] ?>
                </td>
            </tr>
            <?php endforeach ?>
    </table>
<?php
    $checkbox='';
    if(isset($_POST['checkbox']) == true){
        $array=$_POST['checkbox'];
        foreach($array as $value){
            $checkbox.=$value.',';
        }
        $k_data=rtrim($checkbox,',');
    }
    // print $k_data;

    $kubun_goods = check_goods($dbh,$k_data);
    foreach($kubun_goods as $goods):
?>
    <table border="1">
        <tr>
            <td>
                <?= $goods['gameName'] ?>
            </td>
            <td>
                <?= $goods['kategoris'] ?>
            </td>
            <td>
                <?php if($goods['price'] == 0): ?>
                    <div class="moji">無料プレイ</div>
                <?php else: ?>
                    <div class="moji">¥<?= number_format($goods['price']) ?></div>
                <?php endif ?>
            </td>
            <td>
                <?= $goods['recommend'] == 1 ? "★おすすめゲーム★" : "" ?>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
</body>
</html>