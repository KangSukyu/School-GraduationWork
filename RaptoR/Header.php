<?php 
    require_once 'DB\db_helper.php';
    $dbh = get_db_connect();
    
    if(!empty($_SESSION['member'])){
        $member = $_SESSION['member'];
        $email = $_SESSION['member']['email'];
        $cnt = count_basket($dbh,$email);
    }
    // print_r($_POST);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css\reset.css" rel="stylesheet">
    <link href="css\HeaderStyle.css" rel="stylesheet">
</head>

<header class="header">
    <div class="logo">
        <a href="TopPage.php"><img src="images\logo.jpg" alt="RaptoRロゴ"/></a>
    </div>
<div class="iro">
        <?php if(isset($member['membername'])): ?>
            <div class="member">
                <!-- <div class="mname"><?= @$member['membername'] ?>さん<br></div> -->
                <!-- <a href="buyHistory.php">購入履歴</a><br>
                <a href="cart.php">カート()</a><br> -->
                <!-- <a href="Logout.php">ログアウト</a> -->
            </div>
        <?php else: ?>
        <!-- <form action="Login.php" method="post">
            <input class="loginBtn" type="submit" style="width: 200px; height: 50px;" value="ログイン">
        </form> -->
        <?php endif; ?>
<br>
    <!-- <div class="content">
        <form action="" method="POST" id="tag-form">
            <input type="hidden" value="" name="tag" id="rdTag" />
            <button type="submit">TAG登録</button>
        </form>

        <ul id="tag-list">
        </ul>

        <div>
            <input type="text" id="tag" size="7" placeholder="TAG入力" />
        </div>
    </div>
<br> -->
    <div id="kensaku">
        <form action="SearchResult.php" method="GET">
            <input type="text" style="width: 500px; border:1px #000 solid; height: 30px;" name="keyword" placeholder="ゲーム名、ゲーム説明、カテゴリー、開発元を 検索">
            <input type="submit" class="kbtn" value="検索">
        </form><br>
    </div>    
</div>
    <table class="gnavi">
        <tr>
            <th class="top"><a href="TopPage.php">Top</a></th>
            <th><a href="kategori.php">カテゴリー</a></th>
            <th><a href="Uriage.php">売上上位</a></th>
            <?php if(isset($member['membername'])): ?>
                <th><?= @$member['membername'] ?>さん</th>
                <th><a href="buyHistory.php">購入履歴</a></th>
                <th><a href="cart.php">カート(<?= $cnt?>)</a></th>
                <th><a href="Logout.php">ログアウト</a></th>
            <?php else: ?>
                <th><a href="Login.php">ログイン</a></th>
            <?php endif; ?>
        </tr>
    </table>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="JS\topPage.js"></script>
</header>
<body>
<!-- <script src="JS\tag.js"></script> -->
</body>
</html>