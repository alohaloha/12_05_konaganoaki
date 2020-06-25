<?php
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
session_start();

$errors = array();
if (isset($_POST['submit'])) {

	$pref_code = $_POST['pref_code'];
	$team_category = $_POST['team_category'];
	$entry_category = $_POST['entry_category'];
	$team_name = $_POST['team_name'];
	$team_mail = $_POST['team_mail'];
	$team_yuubin = $_POST['team_yuubin'];
	$team_address = $_POST['team_address'];
	$team_facility = $_POST['team_facility'];
	$team_pw = $_POST['team_pw'];
	$team_manager = $_POST['team_manager'];
	$pref_code = htmlspecialchars($pref_code, ENT_QUOTES);
	$team_category = htmlspecialchars($team_category, ENT_QUOTES);
	$entry_category = htmlspecialchars($entry_category, ENT_QUOTES);
	$team_name = htmlspecialchars($team_name, ENT_QUOTES);
	$team_mail = htmlspecialchars($team_mail, ENT_QUOTES);
	$team_yuubin = htmlspecialchars($team_yuubin, ENT_QUOTES);
	$team_address = htmlspecialchars($team_address, ENT_QUOTES);
	$team_facility = htmlspecialchars($team_facility, ENT_QUOTES);
	$team_pw = htmlspecialchars($team_pw, ENT_QUOTES);
	$team_manager = htmlspecialchars($team_manager, ENT_QUOTES);
	//入力不足の内容表示
	if ($pref_code === "") {
		$errors['pref_code'] = "所属する都道府県が選択されていません。";
	}
	if ($team_category === "") {
		$errors['team_category'] = "登録カテゴリが選択されていません。";
	}
	if ($entry_category === "") {
		$errors['entry_category'] = "大会エントリが選択されていません。";
	}
	if ($team_name === "") {
		$errors['team_name'] = "チーム名が入力されていません。";
	}
	if ($team_mail === "") {
		$errors['team_mail'] = "メールアドレスが入力されていません。";
	}
	if ($team_yuubin === "") {
		$errors['team_yuubin'] = "郵便番号が入力されていません。";
	}
	if ($team_address === "") {
		$errors['team_address'] = "住所が入力されていません。";
	}
	if ($team_facility === "") {
		$errors['team_facility'] = "主に活動する施設名が入力されていません。";
	}
	if ($team_pw === "") {
		$errors['team_pw'] = "パスワードが入力されていません。";
	}
	if ($team_manager === "") {
		$errors['team_manager'] = "代表者名が入力されていません。";
	}

	//エラーが０になったら確認画面へ
	if (count($errors) === 0) {
		$_SESSION = array();
		$_SESSION['pref_code'] = $pref_code;
		$_SESSION['team_category'] = $team_category;
		$_SESSION['entry_category'] = $entry_category;
		$_SESSION['team_name'] = $team_name;
		$_SESSION['team_mail'] = $team_mail;
		$_SESSION['team_yuubin'] = $team_yuubin;
		$_SESSION['team_address'] = $team_address;
		$_SESSION['team_facility'] = $team_facility;
		$_SESSION['team_pw'] = $team_pw;
		$_SESSION['team_manager'] = $team_manager;

		header('Location:team_confirm.php');

		exit();
	}
}

if (isset($_GET['action']) && $_GET['action'] === 'edit') {
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

// echo "<pre>";
// var_dump($errors);
// echo "</pre>";

include_once(dirname(__FILE__) . '/../functions.php');
//DBに接続
$pdo = connect_to_pref_db();

//都道府県マスタからデータ抽出
$sql_pref = 'SELECT code,prefecture FROM M_prefectures ';

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

$pref_options = "";
foreach ($result as $record) {
	if (isset($pref_code) && $pref_code == $record['code']) {
		$pref_options .= "<option value='{$record['code']}' selected>{$record['code']}\t{$record['prefecture']}</option>";
	} else {
		$pref_options .= "<option value='{$record['code']}'>{$record['code']}\t{$record['prefecture']}</option>";
	}
}

unset($record);

//team_categoryからデータ抽出
$sql_team = 'SELECT * FROM `team_category` ';
$stmt_team = $pdo->prepare($sql_team);
$status_team = $stmt_team->execute();

if ($status_team == false) {
	// SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	// 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
	// fetchAll()関数でSQLで取得したレコードを配列で取得できる
	$result_team = $stmt_team->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}

$team_options = "";
foreach ($result_team as $record_team) {
	if (isset($team_category) && $team_category == $record_team['team_category_id']) {
		$team_options .= "<option value='{$record_team['team_category_id']}' selected>{$record_team['team_category']}</option>";
	} else {
		$team_options .= "<option value='{$record_team['team_category_id']}'>{$record_team['team_category']}</option>";
	}
}

unset($record_team);

//entry_categoryからデータ抽出
$sql_entry = 'SELECT * FROM `entry_category` ';
$stmt_entry = $pdo->prepare($sql_entry);
$status_entry = $stmt_entry->execute();

if ($status_entry == false) {
	// SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	// 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
	// fetchAll()関数でSQLで取得したレコードを配列で取得できる
	$result_entry = $stmt_entry->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
}
$entry_options = "";
foreach ($result_entry as $record_entry) {
	if (isset($entry_category) && $entry_category == $record_entry['entry_category_id']) {
		$entry_options .= "<option value='{$record_entry['entry_category_id']}' selected>{$record_entry['entry_category']}</option>";
	} else {
		$entry_options .= "<option value='{$record_entry['entry_category_id']}'>{$record_entry['entry_category']}</option>";
	}
}

unset($record_team);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
	<title>チーム登録FORM</title>
</head>

<body>
	<?php
	echo "<ul>";
	foreach ($errors as $value) {
		echo "<li>";
		echo $value;
		echo "</li>";
	}
	echo "</ul>";
	?>

	<form action="team_input.php" method="POST" name="team_input">
		<fieldset>
			<legend>
				<h3>チーム登録FORM</h3>
			</legend>
			<a href="team_read.php" class="link">一覧画面</a>

			<div>
				<label for="pref_code">所属する都道府県</label>
				<select name="pref_code" id="pref_code">
					<option value="" disabled selected>-- 選択してください --</option>
					<?= $pref_options ?>
				</select>
			</div>
			<div>
				<label for="team_category">登録カテゴリ</label>
				<select name="team_category" id="team_category">
					<option value="" disabled selected>-- 選択してください --</option>
					<?= $team_options ?>
				</select>
			</div>
			<div>
				<label for="entry_category">大会エントリ</label>
				<select name="entry_category" id="entry_category">
					<option value="" disabled selected>-- 選択してください --</option>
					<?= $entry_options ?>
				</select>
			</div>
			<div>
				<label for="team_name">チーム名</label>
				<input type="text" name="team_name" id="team_name" value="<?php if (isset($team_name)) {
																																		echo $team_name;
																																	} ?>" placeholder="正式名称を入力してください">
			</div>
			<div>
				<label for="team_mail">メールアドレス</label>
				<input type="text" name="team_mail" id="team_mail" value="<?php if (isset($team_mail)) {
																																		echo $team_mail;
																																	} ?>" placeholder="外部に公開されます">
			</div>
			<div>
				<label for="team_yuubin">主な活動場所</label>
				<input type="text" name="team_yuubin" id="team_yuubin" value="<?php if (isset($team_yuubin)) {
																																				echo $team_yuubin;
																																			} ?>" placeholder="郵便番号">
			</div>
			<div>
				<label for="team_address">（住所）</label>
				<input type="text" name="team_address" id="team_address" class="address" value="<?php if (isset($team_address)) {
																																													echo $team_address;
																																												} ?>" placeholder="主な活動場所（住所）">
			</div>
			<div>
				<label for="team_facility">（施設）</label>
				<input type="text" name="team_facility" id="team_facility" class="address" value="<?php if (isset($team_facility)) {
																																														echo $team_facility;
																																													} ?>" placeholder="主な活動場所（施設名）">
			</div>
			<div>
				<label for="team_pw">パスワード</label>
				<input type="password" name="team_pw" id="team_pw" class="team_pw" placeholder="パスワード">
			</div>

			<div>
				<label for="team_manager">代表者名</label>
				<input type="text" name="team_manager" id="team_manager" value="<?php if (isset($team_manager)) {
																																					echo $team_manager;
																																				} ?>" placeholder="代表者氏名">
			</div>
			<div>
			<input type="submit" value="チーム登録" name="submit">
			<a href="team_login.php">またはログイン</a>
			</div>
		</fieldset>
	</form>
</body>

</html>