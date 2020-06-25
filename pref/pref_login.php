<?php

session_start();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>都道府県協会ログイン</title>
</head>
<body>
<form action="pref_login_act.php" method="POST">
    <fieldset>
        <legend><h3>ログイン画面</h3></legend>
        <div>
            <label for="mail">メール</label>
            <input type="text" name="mail" id="mail" placeholder="公式メールアドレス">
        </div>
        <div>
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" placeholder="パスワード">
        </div>
        <div>
            <button>ログイン</button>
            <a href="pref_input.php" class="link">または新規登録</a>
        </div>
    </fieldset>
</form>
</body>
</html>