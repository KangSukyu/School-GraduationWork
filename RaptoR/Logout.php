<?php
    session_start();
    $_SESSION = [];

    $session_name = session_name();
    if (isset($_COOKIE[$session_name])) {
        setcookie($session_name,'',time()-3600);
    }
    session_destroy();

    $url = 'http://10.42.96.1/2JN1/group7/RaptoR/TopPage.php';
    session_start();
    $_SESSION['url'] = $url;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="reset.css" rel="stylesheet">
    <link href="css\uriage.css" rel="stylesheet"/>
    <link href="css\Logout.css" rel="stylesheet"/>
    <title>RaptoR</title>
</head>
<body>
<?php include "header.php" ?>
    <h1>ログアウト</h1><br><br><br><br>
    <h3>ログアウトしました。<br>
        ありがとうございます。<br>
        またのご利用お待ちしております。
    </h3>
        <?php include "sidebar.php" ?>
</body>
</html>