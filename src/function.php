<?php
$debug_flg = true;

// Debug領域
// echo $_POST['email']."<br>";
// echo $_POST['pass']."<br>";;
// echo (!empty($_POST['pass_save'])) ? true : false;

// セッションの準備
// session_save_path("/var/tmp");
ini_set('session.gc_maxfiletime',60*60*24*30);
ini_set('session.cookie_maxfiletime',60*60*24*30);
// session_start();
// session_regenerate_id();

// ログイン認証
require('auth.php');
// セッション時間チェック

// ログイン処理

if(!empty($_POST)){

    //変数にユーザ情報を代入
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_save = (!empty($_POST['pass_save'])) ? true : false;

    try{
        // echo "try"."<br>";
        // $dsn = 'mysql:dbname=mydatabase;host=192.168.56.118;port=3306;charset=utf8';
        $dsn = 'mysql:dbname=mydatabase;host=mysql-server;charset=utf8';
        

        $host = 'mysql-server'; //コンテナ名でも問題ない
        $port = '3306'; 
        $dbname = 'mydatabase'; 
        $user = 'myuser'; 
        $db_password = 'mypassword'; 

        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
        );
            
        $dbh = new PDO($dsn,$user,$db_password,$options);

        $sql = 'SELECT pass,id FROM users WHERE email = :email';

        //$data = array(':email' => $email);
        
        //クエリ実行

        $stmt = $dbh->prepare($sql);

        $stmt->execute(array(':email' => $email));

        $result = $stmt->fetch();

        // Debug
        
        if(!empty($result['pass'])){
            // echo "DB  パスワード:".$result['pass']."<br>";
            // echo "入力パスワード:".$result['pass']."<br>";
        } else{
            // 該当のユーザがいないエラーメッセージを出力
        }

        // パスワードチェック
        //password_verifyは、DBのパスワードがハッシュ化されていないと比較できないため、ここでハッシュ化する。
        $hashed_db_Password = password_hash($result['pass'], PASSWORD_DEFAULT);

        if(!empty($result) && password_verify($pass, $hashed_db_Password)){
            //echo "パスワードがマッチしました。";

            // ログイン有効期限の設定を行う

            //マイページへ遷移
            header('Location: mypage.php');
            
            //exit();
        }

    
    }

    catch (PDOException $e) {
        // エラーメッセージを表示
        echo "エラー: " . $e->getMessage();
    }
}


?>
