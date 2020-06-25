<?php
// 送信データのチェック
// var_dump($_GET);
// exit();

// 関数ファイルの読み込み
session_start(); // セッションの開始
include_once(dirname(__FILE__) . '/../functions.php');
check_session_id(); // idチェック関数の実行

$ID = $_SESSION['id'];//session変数の定義

// idの受け取り
$id = $_GET["id"];

if($id != $ID){
  echo('このページを編集する権限はありません');
  exit();
}


// DB接続
$pdo = connect_to_pref_db();

// データ取得SQL作成
$sql = '';

// SQL準備&実行
$sql = 'SELECT P.*,M.prefecture FROM PREF_managers AS P INNER JOIN M_prefectures AS M ON P.pref_code=M.code WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}
// var_dump($record);
// exit();

//都道府県マスタからデータ抽出
$sql_pref = 'SELECT code,prefecture FROM M_prefectures ';

$stmt_pref = $pdo->prepare($sql_pref);
$status_pref = $stmt_pref->execute();

if ($status_pref == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt_pref->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}

$pref_options = "";
foreach ($result as $recordPref) {
  if ($record['pref_code'] == $recordPref['code']) {
    $pref_options .= "<option value='{$recordPref['code']}' selected>{$recordPref['code']}\t{$recordPref['prefecture']}</option>";
  } else {
    $pref_options .= "<option value='{$recordPref['code']}'>{$recordPref['code']}\t{$recordPref['prefecture']}</option>";
  }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>DB連携型todoリスト（編集画面）</title>
</head>

<body>
  <form action="pref_update.php" method="POST">
    <fieldset>
      <legend><h3>都道府県協会情報（編集）</h3></legend>
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
        <input type="text" name="manager" id="manager" value="<?= $record['manager'] ?>">
      </div>
      <div>
        <label for="mail">メールアドレス</label>
        <input type="text" name="mail" id="mail" value="<?= $record['mail'] ?>">
      </div>
      <div>
        <label for="tel">電話番号</label>
        <input type="text" name="tel" id="tel" value="<?= $record['tel'] ?>">
      </div>
      <div>
        <label for="yuubin">郵便番号</label>
        <input type="text" name="yuubin" id="yuubin" value="<?= $record['yuubin'] ?>">
      </div>
      <div>
        <label for="address">住所</label>
        <input type="text" name="address" id="address" class="address" value="<?= $record['address'] ?>">
      </div>
      <div>
        <button>編集完了</button>
      </div>
      <input type="hidden" name="id" value="<?= ($record['id']) ?>">
    </fieldset>
  </form>

</body>

</html>