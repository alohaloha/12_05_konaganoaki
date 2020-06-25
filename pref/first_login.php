<?php
include_once(dirname(__FILE__) . '/../functions.php');
//DBに接続
$pdo = connect_to_pref_db();

//都道府県マスタからデータ抽出
$sql_pref = 'SELECT code,prefecture FROM M_prefectures WHERE is_regist=0';

$stmt_pref = $pdo->prepare($sql_pref);
$status_pref = $stmt_pref->execute();

if ($status_pref == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt_pref->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}
// echo '<pre>';
// var_dump($result);
// exit();
// echo '</pre>';

$options = "";
foreach ($result as $record) {
    $options .= "<option value='{$record['code']}'>{$record['code']}\t{$record['prefecture']}</option>";
}

unset($record);





?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>都道府県協会ログイン</title>
</head>

<body>
    <form action="first_login_act.php" method="POST" name="first_login" method="POST">
        <fieldset>
            <legend>
                <h3>初回ログイン画面</h3>
            </legend>
            <div>
                <label for="pref_code">都道府県</label>
                <select name="pref_code" id="pref_code">
                    <option value="" hidden>-- 選択してください --</option>
                    <?= $options ?>
                </select>
            </div>
            <div>
                <label for="initial_password">初期パスワード</label>
                <input type="text" name="initial_pw" id="initial_pw" placeholder="初期パスワード">
            </div>
            <div class="btn_wrapper">
                <button id="first_submit">初回ログイン</button>
                <a href="pref_login.php" class="link long">代表者登録がお済みの方はこちら</a>
            </div>
        </fieldset>
    </form>
</body>

</html>