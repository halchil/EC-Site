<?php include 'logic.php'; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ホームページのタイトル</title>
    <style>
        body{
            margin: 0 auto;
            padding: 150px;
            width: 25%;
            background: #fbfbfa;
        }
        h1{ color: #545454; font-size: 20px;}
        form{
            overflow: hidden;
        }
        input[type="text"]{
            color: #545454;
            height: 60px;
            width: 100%;
            padding: 5px 10px;
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
      input[type="password"]{
            color: #545454;
            height: 60px;
            width: 100%;
            padding: 5px 10px;
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"]{
            border: none;
            padding: 15px 30px;
            margin-bottom: 15px;
            background: #3d3938;
            color: white;
            float: right;
        }
        input[type="submit"]:hover{
            background: #111;
            cursor: pointer;
        }
        a{
            color: #545454;
            display: block;
        }
        a:hover{
            text-decoration: none;
        }
      .err_msg{
        color: #ff4d4b;
      }
    </style>
  </head>
  <body>

        <h1>ユーザー登録</h1>
            <form method="post"> <!-- 今回は自分自身に送信。これだとindex.phpが読み込まれまだ上から処理される　$_POSTに入る　ここにaction=mypage.phpなど入れるとそこにpost送信するように設定できる-->
               <span class="err_msg"><?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?></span>
                <input type="text" name="email" placeholder="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>"> <!--value属性を使ってリロードしても前回入力された情報を引きつぐ-->

        <span class="err_msg"><?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?></span>
                <input type="password" name="pass" placeholder="パスワード" value="<?php if(!empty($_POST['pass'])) echo $_POST['pass'];?>">

        <span class="err_msg"><?php if(!empty($err_msg['pass_retype'])) echo $err_msg['pass_retype']; ?></span>
                <input type="password" name="pass_retype" placeholder="パスワード（再入力）" value="<?php if(!empty($_POST['pass_retype'])) echo $_POST['pass_retype'];?>">

                <input type="submit" value="送信">
            </form>
            <a href="mypage.php">マイページへ</a>
            <!-- フォームの送信メソッドが "post" であるため、送信されるデータは $_POST スーパーグローバル配列に格納されます。
            method="post"：データは $_POST 配列に格納されます。
    method="get"：データは $_GET 配列に格納されます。-->
    
  </body>
</html>

<!--
http://localhost/lesson/lesson11/
-->