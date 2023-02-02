<?php
    require_once 'DB\db_helper.php';
    require_once 'DB\extra_helper.php';
    $dbh = get_db_connect();

    $errs = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = filter_input(INPUT_POST, 'email');
        $membername = filter_input(INPUT_POST, 'membername');
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST, 'password2');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $address = filter_input(INPUT_POST, 'address');
    
        if(empty($email)){
            $errs['email'] = '(必須) メールアドレスを入力してください。';
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errs['email'] = 'メールアドレスの形式が正しくありません。';
        }
        elseif(email_exists($dbh,$email) == false){
            $errs['email'] = 'このメールアドレスはすでに登録されています。';
        }

        if(empty($membername)){
            $errs['membername'] = '(必須) 名前を入力してください。';
        }

        if(check_words($password,4,20) == false){
            $errs['password'] = '(必須) パスワードは4~20文字で入力してください。';
        }
        elseif($password != $password2){
            $errs['password2'] = 'パスワードが一致しません。';
        }

        if($zipcode != ''){
            if(!preg_match("/\A\d{3}-?\d{4}\z/",$zipcode)){
                $errs['zipcode'] = '郵便番号は3桁－4桁で、間にハイフン(-)を入力してください。';
            }
        }

        if(empty($errs)){
            $data = insert_member_data($dbh,$email,$password,$membername,$zipcode,$address);
            header('Location:signupEnd.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="reset.css" rel="stylesheet">
    <link href="css\signup.css" rel="stylesheet"/>
    <title>新規会員登録</title>
</head>
<body>
<?php include "header.php" ?>
<?php include "sidebar.php" ?>                   

    <div class="login">
    <h1>新規会員登録</h1><br>
    <form action="" method="post">
        <table>
            <tr>
                <td><input class="kan" type="text" name="email"  placeholder="Eamil" required="required"/></td>
            </tr>
            <tr>
                <td style="color:red"><?= @$errs['email']?></td>
            </tr>
            <tr>
                <td><input class="kan" type="text" name="password" placeholder="Password(4~20文字)" required="required"/></td>
            </tr>
            <tr>
                <td style="color:red"><?= @$errs['password']?></td>
            </tr>
            <tr>
                <td><input class="kan" type="text" name="password2" placeholder="Password(再入力)" required="required"/></td>
            </tr>
            <tr>
                <td style="color:red"><?= @$errs['password2']?></td>
            </tr>
            <tr>
                <td><input class="kan" type="text" name="membername" placeholder="お名前" required="required"/></td>
            </tr>
            <tr>
                <td style="color:red"><?= @$errs['membername']?></td>
            </tr>
            <tr>
                <td><input class="kan" type="text" name="zipcode" placeholder="郵便番号" /></td>
            </tr>
            <tr>
                <td style="color:red"><?= @$errs['zipcode']?></td>
            </tr>
            <tr>
                <td><input class="kan" type="text" name="address" placeholder="住所" /></td>
            </tr>
        </table>
        <br>
        <input type="submit" class="btn btn-primary btn-block btn-large" value="登録する"/>
    </form>
    </div>
</body>
</html>