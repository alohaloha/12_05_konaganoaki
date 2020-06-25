<?php

// 送信データのチェック
var_dump($_POST);


// 関数ファイルの読み込み
include_once(dirname(__FILE__) . '/../functions.php');

// 送信データ受け取り
$pref_code = $_POST['pref_code'];
$team_category = $_POST['team_category'];
$entry_category = $_POST['entry_category'];
$team_name = $_POST['team_name'];
$team_mail = $_POST['team_mail'];
$team_yuubin = $_POST['team_yuubin'];
$team_address = $_POST['team_address'];
$team_facility = $_POST['team_facility'];
$team_manager = $_POST['team_manager'];
$team_id = $_POST['team_id'];

// DB接続
$pdo = connect_to_pref_db();

// UPDATE文を作成&実行
$sql = "UPDATE team_table SET pref_code=:pref_code, team_category=:team_category, entry_category=:entry_category,team_name=:team_name, team_mail=:team_mail,team_yuubin=:team_yuubin, team_address=:team_address, team_facility=:team_facility,team_manager=:team_manager,updated_at=sysdate() WHERE team_id=:team_id";

// var_dump($sql);

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':pref_code', $pref_code, PDO::PARAM_INT);
$stmt->bindValue(':team_category', $team_category, PDO::PARAM_INT);
$stmt->bindValue(':entry_category', $entry_category, PDO::PARAM_INT);
$stmt->bindValue(':team_name', $team_name, PDO::PARAM_STR);
$stmt->bindValue(':team_mail', $team_mail, PDO::PARAM_STR);
$stmt->bindValue(':team_yuubin', $team_yuubin, PDO::PARAM_STR);
$stmt->bindValue(':team_address', $team_address, PDO::PARAM_STR);
$stmt->bindValue(':team_facility', $team_facility, PDO::PARAM_STR);
$stmt->bindValue(':team_manager', $team_manager, PDO::PARAM_STR);
$stmt->bindValue(':team_id', $team_id, PDO::PARAM_INT);
$status = $stmt->execute();
echo $stmt->rowCount();
// var_dump($status);
// exit();
// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:team_logout.php");
  exit();
}
