<?php
session_start(); // セッションの開始
include_once(dirname(__FILE__) . '/../functions.php');
check_session_id(); // idチェック関数の実行

// var_dump($_SESSION);
// exit();
$pdo = connect_to_pref_db();

$prefecture = $_SESSION['prefecture'];
$pref_code = $_SESSION['pref_code'];
$mail = $_SESSION['mail'];


//都道府県マスタからデータ抽出
$sql_pref = 'SELECT code,prefecture FROM M_prefectures WHERE is_regist=0';

$stmt_pref = $pdo->prepare($sql_pref);
$status_pref = $stmt_pref->execute();

if ($status_pref == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt_pref->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt_pref->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}

$pref_options = "";
foreach ($result as $record) {
  if ($pref_code == $record['code']) {
    $pref_options .= "<option value='{$record['code']}' selected>{$record['code']}\t{$record['prefecture']}</option>";
  } else {
    $pref_options .= "<option value='{$record['code']}'>{$record['code']}\t{$record['prefecture']}</option>";
  }
}

unset($record);


?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>都道府県協会登録ページ</title>
</head>

<body>
  <form action="pref_create.php" method="POST">
    <fieldset>
      <legend><h3>都道府県協会情報（登録）</h3></legend>
      <a href="pref_readM.php" class="link">一覧画面</a>
      <div>
        <label for="pref_code">都道府県</label>
        <select name="pref_code" id="pref_code">
          <option value="" disabled selected>-- 選択してください --</option>
          <?= $pref_options ?>
        </select>
      </div>
      <div>
        <label for="manager">代表者名</label>
        <input type="text" name="manager" id="manager">
      </div>
      <div>
        <label for="mail">メールアドレス</label>
        <input type="text" name="mail" id="mail" value="<?= $mail ?>">
      </div>
      <div>
        <label for="tel">電話番号</label>
        <input type="text" name="tel" id="tel">
      </div>
      <div>
        <label for="yuubin">郵便番号</label>
        <input type="text" name="yuubin" id="yuubin">
      </div>
      <div>
        <label for="address">住所</label>
        <input type="text" name="address" id="address" class="address">
      </div>
      <div>
        <label for="password">パスワード</label>
        <input type="text" name="password" id="password" class="password">
      </div>
      <div>
        <button>代表者登録</button>
        <a href="pref_login.php">またはログイン</a>
      </div>
    </fieldset>
  </form>

</body>

</html>