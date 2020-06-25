<?php
session_start();
include_once(dirname(__FILE__) . '/../functions.php');

//一般公開分のページなのでcheck_session_idは不要
// check_session_id(); // idチェック関数の実行
$pdo = connect_to_pref_db();
// var_dump($_SESSION);
// exit();
// //session 変数を定義
// $ID = $_SESSION['id'];
// $PREF_CODE = $_SESSION['pref_code'];
// $MAIL = $_SESSION['mail'];

// データ取得SQL作成
// $sql = 'SELECT id, pref_code, manager, mail FROM pref_managers';
$sql = 'SELECT P.*,M.prefecture FROM PREF_managers AS P
INNER JOIN M_prefectures AS M ON P.pref_code=M.code
WHERE P.is_deleted=0 ORDER BY pref_code;';
// var_dump($sql);
// exit();
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["prefecture"]}</td>";
    $output .= "<td>{$record["manager"]}</td>";
    $output .= "<td>{$record["mail"]}</td>";
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>都道府県協会一覧</title>
</head>

<body>
  <fieldset>
    <legend>
      <h3>都道府県協会一覧</h3>
    </legend>
    <!-- <a href="todo_input.php">入力画面</a> -->
    <table>
      <thead>
        <tr>
          <th>都道府県名</th>
          <th>代表者名</th>
          <th>メールアドレス</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>