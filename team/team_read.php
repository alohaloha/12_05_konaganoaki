<?php

include_once(dirname(__FILE__) . '/../functions.php');
//DBに接続
$pdo = connect_to_pref_db();

$sql = 'SELECT prefecture,TC.team_category,EC.entry_category,team_name,team_mail
FROM M_prefectures AS M, team_table AS TT, team_category AS TC, entry_category AS EC
WHERE TT.pref_code=M.code AND TT.team_category=TC.team_category_id AND TT.entry_category=EC.entry_category_id ORDER BY TT.pref_code;';

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

  // echo '<pre>';
  // var_dump($result);
  // echo '</pre>';
  // exit();


  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["prefecture"]}</td>";
    $output .= "<td>{$record["team_category"]}</td>";
    $output .= "<td>{$record["entry_category"]}</td>";
    $output .= "<td>{$record["team_name"]}</td>";
    $output .= "<td>{$record["team_mail"]}</td>";

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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>登録チーム一覧</title>
</head>

<body>
  <fieldset>
    <legend>
      <h3>登録チーム一覧</h3>
    </legend>
    <!-- <a href="todo_input.php">入力画面</a> -->
    <table id="team_table">
      <thead>
        <tr>
          <th>都道府県</th>
          <th>登録カテゴリ</th>
          <th>大会カテゴリ</th>
          <th>チーム名</th>
          <th>連絡先</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
  <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1_DbHzdzOhrv_I8p17W7_DEnnKVdR_S_o" width="640" height="480"></iframe>
  <script>
    $(document).ready(function() {
      $('#team_table').tablesorter();
    });
  </script>
</body>

</html>