<?php
session_start();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>チーム情報編集 - ログイン -</title>
</head>

<body>
  <form action="team_login_act.php" method="POST">
    <fieldset>
      <legend><h3>チームログイン画面</h3></legend>
      <div>
        <label for="team_mail">メール</label>
        <input type="text" name="team_mail" id="team_mail" placeholder="メールアドレス">
      </div>
      <div>
        <label for="team_pw">パスワード</label>
        <input type="password" name="team_pw" id="team_pw" placeholder="パスワード">
      </div>
      <div>
        <button>ログイン</button>
        <a href="team_input.php" class="link">または新規登録</a>
      </div>
    </fieldset>
  </form>
</body>

</html>