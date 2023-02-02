<?php
require_once 'config.php';

// DBに接続する
function get_db_connect() 
{
    try{
        $dbh = new PDO(DSN, DB_USER, DB_PASSWORD);
    }
    catch (PDOException $e){
        echo $e->getMessage();
        die();
    }

    return $dbh;
}

//kategori.php
// DBから全商品グループを取得する
function select_kategori_all($dbh)
{
    $sql = "SELECT * FROM kategori";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $data =[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=$row;
    }
    return $data;
}

//kategori.php
// DBから全おすすめ商品を取得する
function select_recommend_game($dbh)
{
    $sql = "SELECT * FROM game WHERE Recommend = 1";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    return $data;
}

//kategori.php
// DBから指定したグループコードの商品を取得する
function select_game_by_kategoriid($dbh, $kategoriid)
{
    $sql = "SELECT * FROM game WHERE kategoriid = :kategoriid ORDER BY recommend DESC";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':kategoriid', $kategoriid, PDO::PARAM_INT);
    $stmt->execute();

    $data = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    return $data;
}

//game.php
function inner_join_game($dbh, $gamecode)
{
    $sql = "SELECT * FROM game AS g RIGHT JOIN kategori AS k ON g.kategoriid = k.kategoriid RIGHT JOIN developer AS d ON g.developerId = d.developerId RIGHT JOIN publisher AS p ON g.publisherId = p.publisherId WHERE gamecode = :gamecode";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':gamecode', $gamecode, PDO::PARAM_INT);
    $stmt->execute();

    $game = $stmt->fetch(PDO::FETCH_ASSOC);
    return $game;
}

//login.php
// メールアドレス, パスワードが一致する会員データを取得する
function select_member($dbh, $email, $password)
{
    $sql = "SELECT * FROM Member WHERE email=:email AND password=:password";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    return $member;
}

//signup.php
function insert_member_data($dbh,$email,$password,$membername,$zipcode,$address){
    $sql = "INSERT INTO Member(email,password,membername,zipcode,address) VALUES(:email,:password,:membername,:zipcode,:address)";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':membername', $membername, PDO::PARAM_STR);
    $stmt->bindValue(':zipcode', $zipcode, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->execute();

}

function email_exists($dbh, $email){
    $sql = "SELECT COUNT(*) AS count FROM Member WHERE email=:email";

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['count'] <= 0){
        return true;
    }else{
        return false;
    }
}

function uriage_top($dbh){
    $sql = "SELECT g.gameCode, g.gameName,g.gameImage ,g.price,g.flag, COUNT(u.gamecode) FROM game AS g RIGHT JOIN uriage AS u ON g.gamecode = u.gamecode GROUP BY g.gameCode, g.gameName, g.gameImage ,g.price,g.flag ORDER BY COUNT(u.gamecode)DESC";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $data =[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]=$row;
    }
    return $data;
}

// DBから、引数 $goodscode の商品を取得する
function select_game_by_gamecode($dbh, $gamecode)
{
    $sql = "SELECT * FROM game WHERE gamecode = :gamecode";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':gamecode', $gamecode, PDO::PARAM_INT);
    $stmt->execute();

    $game = $stmt->fetch(PDO::FETCH_ASSOC);
    return $game;

}

function insert_sale($dbh,$email,$gamecode,$buydate)
{	
    $sql = "INSERT INTO Buy(email,gamecode,buydate) VALUES(:email,:gamecode,:buydate)";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gamecode', $gamecode, PDO::PARAM_INT);
    $stmt->bindValue(':buydate', $buydate, PDO::PARAM_STR);
    $stmt->execute();
    
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);
    return $sale;
}

function buy_history($dbh, $email)
{
    $sql = "SELECT * FROM buy AS b RIGHT JOIN game AS g ON b.gamecode = g.gamecode WHERE email = :email ORDER BY timestamp DESC";

    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $game =[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $game[]=$row;
    }
    return $game;
}

function select_goods_by_keyword($dbh,$keyword){
    $keyword2 = $keyword;
    $sql = "SELECT * FROM game AS g RIGHT JOIN kategori AS k ON g.kategoriId = k.kategoriId RIGHT JOIN developer AS d ON g.developerId = d.developerId WHERE gamename LIKE :gamename OR kategoriName LIKE :kategoriName OR developerName LIKE :developerName OR gameExplanation LIKE :gameExplanation ORDER BY recommend DESC, releaseDate DESC";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':gamename', "%".$keyword."%", PDO::PARAM_STR);
    $stmt->bindValue(':kategoriName', "%".$keyword2."%", PDO::PARAM_STR);
    $stmt->bindValue(':developerName', "%".$keyword2."%", PDO::PARAM_STR);
    $stmt->bindValue(':gameExplanation', "%".$keyword2."%", PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetchAll();

}

function insert_basket($dbh,$email,$gamecode)
{	
    $sql = "INSERT INTO basket(email,gamecode) VALUES(:email,:gamecode)";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gamecode', $gamecode, PDO::PARAM_INT);
    $stmt->execute();
}

function select_basket($dbh,$email){
    $sql = "SELECT * FROM basket AS b RIGHT JOIN game AS g ON b.gamecode = g.gamecode WHERE email = :email";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $basket =[];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $basket[]=$row;
    }
    return $basket;
}

function check_basket($dbh,$email,$gamecode){
    $sql = "SELECT COUNT(*) AS cnt FROM basket WHERE gamecode = :gamecode AND email = :email";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gamecode', $gamecode, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['cnt'] <= 0){
        return true;
    }else{
        return false;
    }

}

function delete_basket($dbh,$email){
    $sql = "DELETE FROM basket WHERE email = :email";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
}

function delete_basket_one($dbh,$email,$gamecode){
    $sql = "DELETE FROM basket WHERE email = :email AND gameCode = :gameCode";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gameCode', $gamecode, PDO::PARAM_INT);
    $stmt->execute();
}

function count_basket($dbh,$email){
    $sql = "SELECT COUNT(*) AS cnt FROM basket WHERE email = :email";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $count = $stmt->fetchColumn();
    return $count;
}

function buy_basket($dbh,$email){
    $sql = "SELECT gamecode FROM basket WHERE email = :email";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row;
}

function check_buy($dbh,$email,$gamecode){
    $sql = "SELECT COUNT(*) AS cnt FROM buy WHERE gamecode = :gamecode AND email = :email";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gamecode', $gamecode, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row['cnt'] <= 0){
        return true;
    }else{
        return false;
    }
}

function buy_insert_all($dbh,$email){
    $sql = "INSERT Into buy (email, gameCode) (select email, gameCode from basket where email = :email)";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

}

function buy_insert_one($dbh,$email,$gamecode){
    $sql = "INSERT INTO buy (email, gameCode) VALUES (:email, :gameCode);";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gameCode', $gamecode, PDO::PARAM_INT);

    $stmt->execute();

}

function uriage_insert_all($dbh,$email){
    $sql = "INSERT Into uriage (email, gameCode) (select email, gameCode from basket where email = :email)";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

}

function uriage_insert_one($dbh,$email,$gamecode){
    $sql = "INSERT INTO uriage (email, gameCode) VALUES (:email, :gameCode);";
    $stmt = $dbh->prepare($sql);

    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':gameCode', $gamecode, PDO::PARAM_INT);

    $stmt->execute();
}

function select_testgoods($dbh){
    $sql = 'select * from game';
    $stmt = $dbh->prepare($sql);

    $data = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]= $row;
    }
    return $data;
}

function check_goods($dbh,$k_data){
    $sql = 'select * from game where kategoriId = :k_data';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':k_data', $k_data, PDO::PARAM_STR);
    $stmt->execute();
    $data = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[]= $row;
    }
    return $data;
}

?>