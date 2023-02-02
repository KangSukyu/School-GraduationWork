<?php
  require_once 'DB\db_helper.php';
  $dbh = get_db_connect();

  if(isset($_GET['keyword'])){
    $keyword = ($_GET['keyword']);
    $keyword_list = select_goods_by_keyword($dbh,$keyword);
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
    <link href="reset.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css\SearchResult.css">
    <title>RaptoR</title>
</head>

<body>
<?php include "header.php" ?>
  <?php if(isset($keyword)): ?>
    <h1>検索結果</h1><br>
    <div class="lank">
    <table>
      <tr>
        <th width="450"></th>
        <th width="500">ゲーム名</th>
        <th width="150">カテゴリー</th>
        <th width="80">開発元</th>
        <th width="150">発売日</th>
        <th width="80">単価</th>
        <th></th>
      </tr>
      <?php $count = 0; ?>
      <?php foreach($keyword_list as $game) : ?>
        <?php if($game['flag'] == TRUE): ?>
        <tr class="uri">
          <td>
            <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
            <img src="images/<?= $game['gameImage'] ?>" width="400" height="200" align="left"/><br>
          </td>
          <td>
            <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
            <div class ="name"><?= $game["gameName"] ?></div>
          </td>
          <td>
            <?= $game['kategoriName'] ?>
          </td>
          <td>
            <?= $game['developerName'] ?>
          </td>
          <td>
            <?= $game['releaseDate'] ?>
          </td>
          <td>
            <?php if($game['price'] == 0): ?>
              <div class="moji">無料プレイ</div>
            <?php else: ?>
              <div class="moji">¥<?= number_format($game['price']) ?></div>
            <?php endif ?>
          </td>
          <td>
            <?php if($game['recommend'] == 1): ?>
              <div class="osusume">★おすすめ★</div>
            <?php endif ?>
          </td>
        </tr>
      <?php $count++ ?>
      <?php endif ?>
      <?php endforeach ?>

    </table>
  </div>
    <h2><?= $count ?>件検索できました。</h2>
  <?php else: ?>
    <h2>検索してください。</h2>
  <?php endif ?> 
    <?php include "sidebar.php" ?>
</body>
</html>