<?php
// var_dump($_POST);
// exit();
session_start();
// 外部ファイル読み込み
include_once(dirname(__FILE__) . '/../functions.php');
// DB接続します
$pdo = connect_to_pref_db();

// データ受け取り
$team_mail = $_POST['team_mail'];
$team_pw = $_POST['team_pw'];
// データ取得SQL作成&実行
$sql = 'SELECT * FROM team_table WHERE team_mail=:team_mail AND team_pw=:team_pw';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':team_mail', $team_mail, PDO::PARAM_STR);
$stmt->bindValue(':team_pw', $team_pw, PDO::PARAM_STR);
$status = $stmt->execute();
// SQL実行時にエラーがある場合はエラーを表示して終了
if ($status == false) {
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // うまくいったらデータ（1レコード）を取得
  $val = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($val);
  // exit();
  // ユーザ情報が取得できない場合はメッセージを表示
  if (!$val) {
    echo "<p>ログイン情報に誤りがあります．</p>";
    echo '<a href="team_login.php" class="link">login</a>';
    exit();
  } else {
    // ログインできたら情報をsession領域に保存して一覧ページへ移動
    $_SESSION = array();  //セッション変数を空にする
    $_SESSION['session_id'] = session_id();
    // $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["team_id"] = $val["team_id"];
    $_SESSION['team_mail'] = $val['team_mail'];
    header("Location:team_edit.php?team_id={$val['team_id']}");
    exit();
  }
}
