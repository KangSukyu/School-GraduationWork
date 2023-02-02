<?php
    require_once 'DB\db_helper.php';
    session_start();

    $email = '';
    $errs = [];

    if(!empty($_SESSION['member'])){
        header('Location:TopPage.php');
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $prevPage = $_SESSION['url'];
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        if($email==""){
            $errs[] = "メールアドレスを入力してください。";
        }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errs[] = "メールアドレスの形式に誤りがあります。";
        }

        if($password==""){
            $errs[] = "パスワードを入力してください。";
        }

        if(empty($errs)){
            $dbh = get_db_connect();
            $member = select_member($dbh,$email,$password);

            if($member !== false){
                session_regenerate_id(true);
                $_SESSION['member'] = $member;
                header('location:'.$prevPage);
            }else{
                $errs[] = "メールアドレスまたはパスワードに誤りがあります。";
            }
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="reset.css" rel="stylesheet">
    <link href="css\login.css" rel="stylesheet"/>

    <title>RaptoR</title>
</head>
<body>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>                   
    <div class="login">
    <h1>ログイン</h1><br>
    <?php foreach($errs as $e) : ?>
        <span style="color:red"><?= $e ?></span><br>
    <?php endforeach; ?>
    <form action="" method="POST">
        <input class = kan type="text" name="email" placeholder="Eamil"/><br>
        <input class = kan type="password" name="password" placeholder="Password"/><br>
        <input type="submit" class="btn btn-primary btn-block btn-large" value="ログイン"/>
    </form><br>
    <form action="Signup.php" method="POST">
        <input type="submit" class="btn btn-primary btn-block btn-large" value="新規会員登録">
    </form>
    </div>

</body>
</html>