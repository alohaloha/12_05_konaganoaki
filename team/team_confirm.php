<?php
session_start();
if (isset($_SESSION['team_name'])) {
  // echo "<pre>";
  // var_dump($_SESSION);
  // echo "</pre>";
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
  
}

$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(48));
$token = htmlspecialchars($_SESSION['token'], ENT_QUOTES);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>確認画面 - お問合せ</title>
</head>

<body>
  <form action="team_send.php" method="post">
    <legend><h3>チーム登録内容確認</h3></legend>
    <input type="hidden" name="token" value="<?= $token ?>">
    <table>
      <tr>
        <td>都道府県</td>
        <td><?= $pref_code ?></td>
      </tr>
      <tr>
        <td>登録カテゴリ</td>
        <td><?= $team_category ?></td>
      </tr>
      <tr>
        <td>大会カテゴリ</td>
        <td><?= $entry_category ?></td>
      </tr>
      <tr>
        <td>チーム名</td>
        <td><?= $team_name ?></td>
      </tr>
      <tr>
        <td>メールアドレス</td>
        <td><?= $team_mail ?></td>
      </tr>
      <tr>
        <td>主な活動場所（郵便番号）</td>
        <td><?= $team_yuubin ?></td>
      </tr>
      <tr>
        <td>主な活動場所（住所）</td>
        <td><?= $team_address ?></td>
      </tr>
      <tr>
        <td>主な活動場所（施設名）</td>
        <td><?= $team_facility ?></td>
      </tr>
      <tr>
        <td>パスワード</td>
        <td><?= $team_pw ?></td>
      </tr>
      <tr>
        <td>代表者氏名</td>
        <td><?= $team_manager ?></td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="submit" value="送信する">
        </td>
      </tr>
    </table>
  </form>
  <p><a href="team_input.php?action=edit">入力画面に戻る</a></p>
</body>

</html>