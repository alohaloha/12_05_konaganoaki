<?php
session_start(); // セッションの開始
include_once(dirname(__FILE__) . '/../functions.php');
check_session_id(); // idチェック関数の実行
// 送信確認
// var_dump($_POST);
// var_dump($_SESSION);
// exit();
// DB接続の設定
$pdo = connect_to_pref_db();


// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['pref_code']) || $_POST['pref_code'] == '' ||
  !isset($_POST['manager']) || $_POST['manager'] == ''||
  !isset($_POST['mail']) || $_POST['mail'] == '' ||
  !isset($_POST['tel']) || $_POST['tel'] == ''||
  !isset($_POST['yuubin']) || $_POST['yuubin'] == '' ||
  !isset($_POST['address']) || $_POST['address'] == ''||
  !isset($_POST['password']) || $_POST['password'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}
// 受け取ったデータを変数に入れる
$pref_code = $_POST['pref_code'];
$manager = $_POST['manager'];
$mail = $_POST['mail'];
$tel = $_POST['tel'];
$yuubin = $_POST['yuubin'];
$address = $_POST['address'];
$password = $_POST['password'];
// ユーザ存在有無確認
$sql = 'SELECT COUNT(*) FROM pref_managers WHERE pref_code=:pref_code';
// var_dump($_SESSION);
// exit();

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':pref_code', $_SESSION['pref_code'], PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  // user_idが1件以上該当した場合はエラーを表示して元のページに戻る
  // $count = $stmt->fetchColumn();
  echo "<p>すでに代表者が登録されています。ログインしてください。</p>";
  echo '<a href="pref_login.php">login</a>';
  exit();
}




// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO PREF_managers(id, pref_code, manager, tel, yuubin, address, mail, password, created_at, updated_at) VALUES(NULL, :pref_code, :manager,  :tel, :yuubin, :address, :mail, :password, sysdate(), sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':pref_code', $_SESSION['pref_code'], PDO::PARAM_INT);
$stmt->bindValue(':manager', $manager, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':yuubin', $yuubin, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($status);
// exit();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  $regist =1;
  $sqlR = "UPDATE M_prefectures SET is_regist=:regist WHERE code=:pref_code";
  $stmtR = $pdo->prepare($sqlR);
  $stmtR->bindValue(':regist', $regist, PDO::PARAM_INT);
  $stmtR->bindValue(':pref_code', $pref_code, PDO::PARAM_INT);
  $statusR = $stmtR->execute();
  var_dump($statusR);
  exit();
  if ($statusR == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmtR->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  }
  header("Location:pref_login.php");
  exit();
}
