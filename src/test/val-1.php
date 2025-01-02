<?php

// http://192.168.56.118:8080/test/val-1.php

$host = '192.168.56.118'; // ホスト名（例: localhost）
$port = '3306'; // ポート番号（デフォルトは3306ですが、変更している場合はここを変更）
$dbname = 'test-db'; // データベース名
$username = 'myuser'; // ユーザー名
$password = 'mypassword'; // パスワード

?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" type="text/css" href="style-val.css">
  </head>

  <body>
    <form method="post" action="">
      <input type="text" class="input-text" name="address" placeholder="住所"></input><br>
      <input type="submit" class="input-submit" value="submit"></input>
   </form>

   <div><?php //echo "入力された住所".$_POST['address'] ?></div>

   <div>SQL文の発行</div>
   <div><?php echo "ホスト名は、".$host ?></div>
   <div><?php echo "ポート番号は、".$port ?></div>
   <div><?php echo "DB名は、".$dbname ?></div>
   <div><?php echo "ユーザ名は、".$username ?></div>
   <div><?php echo "パスワードは、".$password ?></div>

   <div>
    <?php

      try {
        // PDOでデータベースに接続
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        
        //SQL文の作成
        //$sql = "SELECT * FROM table01 where name='user01'";
        $sql = "SELECT * FROM table01";
        
        //SQLの実行
        $stmt = $pdo->query($sql);

        //実行結果をフェッチ
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // 結果を1行ずつ取得して表示
        //while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
         // 取得したデータを表示
         // foreach ($row as $column => $value) {
         // echo $column . ": " . $value . "<br>";
        //}
        
        //echo "<hr>"; // 各行の区切り
        echo "Name: " . $row['name'] . "<br>";
        
        echo "Row: ";
          print_r($row);

  }
      
    //  }
      catch (PDOException $e) {
          // エラーメッセージを表示
          echo "エラー: " . $e->getMessage();
      }
    ?>
  </div>

  </body>

</html>

