<?php

// 送信データのチェック

// 関数ファイルの読み込み
include_once(dirname(__FILE__) . '/../functions.php');

// 送信データ受け取り
$pref_code = $_POST['pref_code'];
$manager = $_POST['manager'];
$mail = $_POST['mail'];
$tel = $_POST['tel'];
$yuubin = $_POST['yuubin'];
$address = $_POST['address'];
$id = $_POST['id'];
// var_dump($_POST);

// DB接続
$pdo = connect_to_pref_db();

// UPDATE文を作成&実行
$sql = "UPDATE pref_managers SET pref_code=:pref_code, manager=:manager, mail=:mail, tel=:tel,yuubin=:yuubin, address=:address, updated_at=sysdate() WHERE id=:id";

// var_dump($sql);

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':pref_code', $pref_code, PDO::PARAM_STR);
$stmt->bindValue(':manager', $manager, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':yuubin', $yuubin, PDO::PARAM_STR);
$stmt->bindValue(':address', $address, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
  header("Location:pref_readM.php");
  exit();
}
