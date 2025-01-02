<?php

if(!empty($_SESSION['login_date'])) {
    echo 'ログイン済ユーザです。';

    if(($_SESSION['login_date'] + $_SESSION['login_limit'] < time())){
        echo 'ログイン有効期限オーバーです。';
    }
}

?>