<?php

/*
error_reporting():
この関数は、どのエラーレベルのエラーを報告するかを指定します。
引数としてエラーレベルの値を受け取ります。例えば、E_ALLはすべてのエラーを報告するように指定します。
この関数を使用せずにPHPのデフォルトの設定をそのまま利用すると、すべてのエラーが報告されない場合があります。特に開発中は、すべてのエラーを確認したいので、E_ALLを使用してすべてのエラーを報告するのが一般的です。

ini_set():
この関数は、PHPの設定オプションを実行時に変更するために使用されます。
*/

error_reporting(E_ALL);
ini_set('display_errors' , 'on');


/*
PHPのスーパーグローバル配列 $_POST が空でないことをチェックする条件文です。
フォームの各入力フィールドのname属性が、$_POSTのキーとして使用されます。
*/

if(!empty($_POST)){

    define('MSG01','入力必須です');
    define('MSG02','Emailの形式で入力してください。');
    define('MSG03','パスワード(再入力)が合っていません');
    define('MSG04','半角英数字のみご利用いただけます');
    define('MSG05','6文字以上で入力してください');

    /*エラーメッセージの配列*/
    $err_msg = array();

    /* $_POSTは引数にinputタグのname属性(ここではemail)を指定することで、text内を判定できる*/
    if(empty($_POST['email'])){
        
        $err_msg['email'] = MSG01;

    }
    if(empty($_POST['pass'])){
        
        $err_msg['pass'] = MSG01;

    }
    if(empty($_POST['pass_retype'])){
        
        $err_msg['pass_retype'] = MSG01;

    }

    /* err_msgが空であれば = 入力が済んでいれば*/
    if(empty($err_msg)){

        /* フォームから入力された情報を変数に代入*/
        $email = htmlspecialchars($_POST['email']);
        $pass = $_POST['pass'];
        $pass_re = $_POST['pass_retype'];

        /*次の判定は、emailの形式チェック　一旦コピペする*/
        if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
            $err_msg['email'] = MSG02;
          }

        /* 次の判定は、パスワードとパスワード(再入力)が合致しているか判定*/
        if($pass !== $pass_re){
            $err_msg['pass'] = MSG03;
        }

        if(empty($err_msg)){

            /*次の判定は、パスワードとパスワード(再入力)が半角ではない場合　一旦コピペ*/
            if(!preg_match("/^[a-zA-Z0-9]+$/", $pass)){
                $err_msg['pass'] = MSG04;
        
              }elseif(mb_strlen($pass) < 6){
              
                //6.パスワードとパスワード再入力が6文字以上でない場合
               $err_msg['pass'] = MSG05;
              
            }

            if(empty($err_msg)){
                
                //エラーが何もなければ、DB接続の準備
                
                $dsn = 'mysql:dbname=php_lesson11;host=localhost;charset=utf8';
                $user = 'root';
                $password = '';
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //ATTR は "attribute"（属性）の略 キーとペア
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
                );
                /*
                PHP Data Objects（PDO）を使用してデータベースに接続する際のオプション設定を定義してる
                $value = $options[PDO::ATTR_ERRMODE];
                PDO:: の前に付けられるコロンは、これらが PDO クラスの定数であることを示しています

                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION:
                このオプションは、SQLの実行中にエラーが発生した場合に、例外をスローするように設定します。これにより、エラーが発生した際にすぐにその原因を知ることができます。PDO::ERRMODE_EXCEPTIONは、エラー発生時にPDOExceptionをスローします。

                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC:
                このオプションは、デフォルトのフェッチモードを連想配列形式に設定します。つまり、データベースからデータを取得するときに、デフォルトで連想配列として結果が返されます。

                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true:
                このオプションは、バッファードクエリを使用するかどうかを設定します。バッファードクエリを使用すると、一度に結果セットのすべてを取得することができ、サーバーの負荷を軽減することができます。また、これにより、SELECT文で取得した結果に対してもrowCountメソッドを使用することができます。
                */

                /*PHPのPDO（PHP Data Objects）を使ってデータベースに接続するためのものです。*/
                $dbh = new PDO($dsn,$user,$password,$options);

                /*PDOを使ってデータベースに新しいレコードを追加するためのSQL文を準備しています。*/
                $stmt = $dbh->prepare('INSERT INTO users (email,pass,login_time) VALUES (:email,:pass,:login_time)');

                /*この行は、前に準備された（prepareメソッドで作成された）SQL文を実行するためのコード*/
                $stmt->execute(array(':email' => $email, ':pass' => $pass, ':login_time' => date('Y-m-d H:i:s')));

                header('Location: mypage.php'); // 例えば、登録成功のページへ

            }

        }
        



    }


}

?>