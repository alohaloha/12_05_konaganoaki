<?php
// var_dump($_POST);
// exit();
session_start();
// 外部ファイル読み込み
include_once(dirname(__FILE__) . '/../functions.php');
// DB接続します
$pdo = connect_to_pref_db();

// データ受け取り
$mail = $_POST['mail'];
$password = $_POST['password'];
// データ取得SQL作成&実行
$sql = 'SELECT * FROM PREF_managers WHERE mail=:mail AND password=:password';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
// SQL実行時にエラーがある場合はエラーを表示して終了
if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  
    // データの出力用変数（初期値は空文字）を設定
    // var_dump($result);
    // exit();
}
// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($val);
// exit();
// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
    echo "<p>ログイン情報に誤りがあります．</p>";
    echo '<a href="pref_login.php" class="link">login</a>';
    exit();
} else {
    // ログインできたら情報をsession領域に保存して一覧ページへ移動
    $_SESSION = array();  //セッション変数を空にする
    $_SESSION['session_id'] = session_id();
    // $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["id"] = $val["id"];
    $_SESSION['pref_code'] = $val['pref_code'];
    $_SESSION['mail'] = $val['mail'];
    header("Location:pref_menu.php");
    exit();
}
