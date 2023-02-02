<?php
  require_once 'DB\db_helper.php';
  $dbh = get_db_connect();
  session_start();
  $prevPage = $_SESSION['url'];

  if(!empty($_SESSION['member'])){
    $email = $_SESSION['member']['email'];
    $buy_history_all = buy_history($dbh, $email);
  }else{
    header('location:'.$prevPage);
  }
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="reset.css" rel="stylesheet">
  <link href="css\buyhistory.css" rel="stylesheet"/>
  <title>RaptoR</title>
</head>
<body>
<?php include "header.php" ?>
  <h1>購入履歴</h1><br>
  <div class="lank">
  <?php if (empty($buy_history_all)) : ?>
        <p>購入履歴がありません。</p>
    <?php else : ?>
    <table class="tatesen">
      <tr>
        <th width="150">購入日</th>
        <th width="300"></th>
        <th width="700">ゲーム名</th>
        <th width="150">単価</th>
      </tr>
      <?php foreach($buy_history_all as $game) : ?>
        <div class="his">
        <tr class="uri">
          <td class="rank">
            <?= $game['timestamp'] ?>
          </td>
          <td>
            <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
            <img id="Himg" src="images/<?= $game['gameImage'] ?>" width="300" height="150" align="left"/>
          </td>
          <td>
            <a href="game.php?gameCode=<?= $game['gameCode'] ?>">
            <div class ="name"><?= $game["gameName"] ?></div>
          </td>
          <td>
            <?php if($game['price'] == 0): ?>
              <div class="moji">無料プレイ</div>
            <?php else: ?>
              <div class="moji">¥<?= number_format($game['price']) ?></div>
            <?php endif ?>
          </td>
        </tr>
        </div>
      <?php endforeach ?>
    </table>
    <?php include "sidebar.php" ?>
  <?php endif; ?>
  </div>
</body>
</html>