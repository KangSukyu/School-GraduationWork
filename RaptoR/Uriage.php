<?php
  require_once 'DB\db_helper.php';
  $dbh = get_db_connect();
  $uriage_all = uriage_top($dbh);
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
    <link href="css\uriage.css" rel="stylesheet"/>
    <title>RaptoR</title>
    <?php include "sidebar.php" ?>
</head>
<body>
<?php include "header.php" ?>
  <h2><sapn>売上上位</sapn></h2><br>
  <div class="lank">
    <table>
      <tr>
        <th width="120">ランク</th>
        <th width="300"></th>
        <th width="700">ゲーム名</th>
        <th width="150">単価</th>
      </tr>
      <?php $count = 1; ?>
      <?php foreach($uriage_all as $uriage) : ?>
        <?php if($uriage['flag'] == TRUE): ?>
        <tr class="uri">
          <td class="rank">
            <?= $count ?>
          </td>
          <td>
            <a href="game.php?gameCode=<?= $uriage['gameCode'] ?>">
            <img id="Uimg"src="images/<?= $uriage['gameImage'] ?>" width="300" height="150" align="left"/>
          </td>
          <td>
            <a href="game.php?gameCode=<?= $uriage['gameCode'] ?>">
            <div class="name"><?= $uriage["gameName"] ?></div>
          </td>
          <td>
            <?php if($uriage['price'] == 0): ?>
              <div class="moji">無料プレイ</div>
            <?php else: ?>
              <div class="moji">¥<?= number_format($uriage['price']) ?></div>
            <?php endif ?>
          </td>
        </tr>
      <?php $count++ ?>
      <?php endif ?>
      <?php endforeach ?>
    </table>
  </div>
  <br>
</body>
</html>