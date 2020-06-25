<?php
// 関数ファイルの読み込み
session_start(); // セッションの開始
include_once(dirname(__FILE__) . '/../functions.php');
check_session_id(); // idチェック関数の実行

// 送信データのチェック
// var_dump($_SESSION);
// exit();

$teamID = $_SESSION['team_id']; //session変数の定義

// idの受け取り
$team_id = $_GET["team_id"];

if ($team_id != $teamID) {
  echo ('このページを編集する権限はありません');
  exit();
}

$pdo = connect_to_pref_db();

$sql = '';
$sql = 'SELECT T.*,M.prefecture,TC.team_category_id,EC.entry_category_id FROM team_table AS T INNER JOIN M_prefectures AS M ON T.pref_code=M.code INNER JOIN team_category AS TC ON T.team_category=TC.team_category_id INNER JOIN entry_category AS EC ON T.entry_category=EC.entry_category_id WHERE team_id=:team_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
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
  $recordTeam = $stmt->fetch(PDO::FETCH_ASSOC);
}
// var_dump($recordTeam);
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
foreach ($result as $record) {
  if ($recordTeam['pref_code'] == $record['code']) {
    $pref_options .= "<option value='{$record['code']}' selected>{$record['code']}\t{$record['prefecture']}</option>";
  } else {
    $pref_options .= "<option value='{$record['code']}'>{$record['code']}\t{$record['prefecture']}</option>";
  }
}

unset($record);

//team_categoryからデータ抽出
$sql_team = 'SELECT * FROM `team_category` ';
$stmt_team = $pdo->prepare($sql_team);
$status_team = $stmt_team->execute();

if ($status_team == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result_team = $stmt_team->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}

$team_options = "";
foreach ($result_team as $record_team) {
  if ($recordTeam['team_category'] == $record_team['team_category_id']) {
    $team_options .= "<option value='{$record_team['team_category_id']}' selected>{$record_team['team_category']}</option>";
  } else {
    $team_options .= "<option value='{$record_team['team_category_id']}'>{$record_team['team_category']}</option>";
  }
}

unset($record_team);

//entry_categoryからデータ抽出
$sql_entry = 'SELECT * FROM `entry_category` ';
$stmt_entry = $pdo->prepare($sql_entry);
$status_entry = $stmt_entry->execute();

if ($status_entry == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result_entry = $stmt_entry->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}
$entry_options = "";
foreach ($result_entry as $record_entry) {
  if ($recordTeam['entry_category'] == $record_entry['entry_category_id']) {
    $entry_options .= "<option value='{$record_entry['entry_category_id']}' selected>{$record_entry['entry_category']}</option>";
  } else {
    $entry_options .= "<option value='{$record_entry['entry_category_id']}'>{$record_entry['entry_category']}</option>";
  }
}

unset($record_team);


?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>チーム情報（編集画面）</title>
</head>

<body>
  <form action="team_update.php" method="POST">
    <fieldset>
      <legend>
        <h3>チーム情報（編集）</h3>
      </legend>
      <a href="team_read.php" class="link">一覧画面</a>
      <div>
        <label for="pref_code">所属する都道府県</label>
        <select name="pref_code" id="pref_code">
          <option value="" disabled selected>-- 選択してください --</option>
          <?= $pref_options ?>
        </select>
      </div>
      <div>
        <label for="team_category">登録カテゴリ</label>
        <select name="team_category" id="team_category">
          <option value="" disabled selected>-- 選択してください --</option>
          <?= $team_options ?>
        </select>
      </div>
      <div>
        <label for="entry_category">大会エントリ</label>
        <select name="entry_category" id="entry_category">
          <option value="" disabled selected>-- 選択してください --</option>
          <?= $entry_options ?>
        </select>
      </div>
      <div>
        <label for="team_name">チーム名</label>
        <input type="text" name="team_name" id="team_name" value="<?= $recordTeam['team_name'] ?>">
      </div>
      <div>
        <label for="team_mail">メールアドレス</label>
        <input type="text" name="team_mail" id="team_mail" value="<?= $recordTeam['team_mail'] ?>">
      </div>
      <div>
        <label for="team_yuubin">主な活動場所</label>
        <input type="text" name="team_yuubin" id="team_yuubin" value="<?= $recordTeam['team_yuubin'] ?>">
      </div>
      <div>
        <label for="team_address">（住所）</label>
        <input type="text" name="team_address" id="team_address" class="address" value="<?= $recordTeam['team_address'] ?>">
      </div>
      <div>
        <label for="team_facility">（施設名）</label>
        <input type="text" name="team_facility" id="team_facility" value="<?= $recordTeam['team_facility'] ?>">
      </div>
      <div>
        <label for="team_manager">代表者名</label>
        <input type="text" name="team_manager" id="team_manager" value="<?= $recordTeam['team_manager'] ?>">
      </div>

      <div>
        <button>編集完了</button>
      </div>
      <input type="hidden" name="team_id" value="<?= ($recordTeam['team_id']) ?>">
    </fieldset>
  </form>

</body>

</html>