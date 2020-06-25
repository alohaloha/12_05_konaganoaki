<?php
session_start(); // セッションの開始
include_once(dirname(__FILE__) . '/../functions.php');
check_session_id(); // idチェック関数の実行
// var_dump($_SESSION);

// idの受け取り
$id = $_GET["id"];

// DB接続
$pdo = connect_to_pref_db();

// データ取得SQL作成
$sql = '';

// SQL準備&実行
$sql = 'SELECT * FROM PREF_managers AS P INNER JOIN M_prefectures AS M ON P.pref_code=M.code WHERE id=:id';
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
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title><?= $record['prefecture'] ?>詳細</title>
</head>

<body>
  <fieldset>
    <legend><h3><?= $record['prefecture'] ?>詳細</h3></legend>
    <a href="pref_readM.php" class="link">一覧へ戻る</a>
    <a href="pref_edit.php?id=<?= $record['id'] ?>" class="link">編集する</a>
    <table class="detail">
      <thead>
        <tr>
          <th>項目</th>
          <th>情報</th>
        </tr>
        <tr>
          <td>都道府県</td>
          <td><?= $record['prefecture'] ?></td>
        </tr>
        <tr>
          <td>代表者</td>
          <td><?= $record['manager'] ?></td>
        </tr>
        <tr>
          <td>メールアドレス</td>
          <td><a href="mailto:<?= $record['mail'] ?>"><?= $record['mail'] ?></a></td>

        </tr>
        <tr>
          <td>電話番号</td>
          <td><?= $record['tel'] ?></td>
        </tr>
        <tr>
          <td>郵便番号</td>
          <td><?= $record['yuubin'] ?></td>
        </tr>
        <tr>
          <td>住所</td>
          <td><?= $record['address'] ?></td>
        </tr>
      </thead>
    </table>
    <input type="hidden" value="<?= $record['id'] ?>">
  </fieldset>
</body>

</html>