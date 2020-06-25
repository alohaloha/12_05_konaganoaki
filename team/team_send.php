<?php
session_start();

if (isset($_POST['token'], $_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {
  unset($_SESSION['token']);
  $pref_code = $_SESSION['pref_code'];
  $team_category = $_SESSION['team_category'];
  $entry_category = $_SESSION['entry_category'];
  $team_name = $_SESSION['team_name'];
  $team_mail = $_SESSION['team_mail'];
  $team_yuubin = $_SESSION['team_yuubin'];
  $team_address = $_SESSION['team_address'];
  $team_facility = $_SESSION['team_facility'];
  $team_pw = $_SESSION['team_pw'];
  $team_manager = $_SESSION['team_manager'];

  include_once(dirname(__FILE__) . '/../functions.php');
  $pdo = connect_to_pref_db();

$sql = 'INSERT INTO `team_table`(`team_id`, `pref_code`, `team_category`, `entry_category`, `team_name`, `team_mail`, `team_yuubin`, `team_address`, `team_facility`, `team_pw`, `team_manager`, `created_at`, `updated_at`) VALUES(NULL,:pref_code,:team_category,:entry_category,:team_name,:team_mail,:team_yuubin,:team_address,:team_facility,:team_pw,:team_manager,sysdate(),sysdate())';

  $stmt = $pdo->prepare($sql); //prepareメソッド   sql文を準備する 後のexecuteメソッドで実行される
  //正しく準備されるとPDOStatementオブジェクトがメモリに生成され$stmt変数が参照する

  $stmt->bindValue(':pref_code', $pref_code, PDO::PARAM_INT);
  $stmt->bindValue(':team_category', $team_category, PDO::PARAM_INT);
  $stmt->bindValue(':entry_category', $entry_category, PDO::PARAM_INT);
  $stmt->bindValue(':team_name', $team_name, PDO::PARAM_STR);
  $stmt->bindValue(':team_mail', $team_mail, PDO::PARAM_STR);
  $stmt->bindValue(':team_yuubin', $team_yuubin, PDO::PARAM_STR);
  $stmt->bindValue(':team_address', $team_address, PDO::PARAM_STR);
  $stmt->bindValue(':team_facility', $team_facility, PDO::PARAM_STR);
  $stmt->bindValue(':team_pw', $team_pw, PDO::PARAM_STR);
  $stmt->bindValue(':team_manager', $team_manager, PDO::PARAM_STR);

  $status = $stmt->execute(); //準備したsqlが実行される
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
    $pdo = null; //データベースと切断

    //sessionの破棄とそれに関連するcookieファイルも削除
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
    session_destroy();

  // echo "きちんとしたアクセスです。";

    header("Location:../index.html");
    exit();
  }

} else {
  header('Location:team_input.php');
  exit();
}


?>