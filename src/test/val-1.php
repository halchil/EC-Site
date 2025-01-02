<?php

// http://192.168.56.118:8080/test/val-1.php

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

   <div><?php echo "入力された住所".$_POST['address'] ?></div>

  </body>

</html>

