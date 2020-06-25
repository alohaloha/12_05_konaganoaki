<?php
include_once(dirname(__FILE__) . '/../functions.php');
session_start();
check_session_id();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>都道府県協会専用MENU</title>
</head>
<body>
    <a href="pref_readM.php" class="link long">都道府県協会連絡先一覧</a>
    <!-- <a href="#" class="link long">後援依頼申請フォーム</a>
    <a href="#" class="link long">審判派遣依頼フォーム</a> -->
</body>
</html>