<!doctype html>
 <html lang="ja">
    <head>
      <meta charset="utf-8">
      <title>mission_5-connect</title>
    </head>

    <body>
<?php

// データベースへ接続する
$dsn = 'でーたべーす名';
$user = 'ゆーざー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

// データベースに繋がっているか確認
if ($pdo) {
    //繋がってるときは表示しない
    //echo "データベースに繋がっています";
} else {
    echo "データベースに繋がっていません";
}

// テーブルの作成
$sql = "CREATE TABLE IF NOT EXISTS tb_mission_52" // ２回目以降にこのプログラムを呼び出した際に既に存在しているデータを作成しないことで、エラーを防ぐ //
." ("
. "id INT AUTO_INCREMENT PRIMARY KEY,"    // カラム=id　データ型=INT※整数を扱う　AUTO_INCREMENT=自動で数字を1増やす　PRIMARY KEY=主キーに設定 //
. "name char(32),"                       // id=name 　データ型=chr(32）※データが32バイト格納される //
. "comment TEXT,"
. "post_date TEXT"
.");";
$stmt = $pdo->query($sql); // クエリーを実行して変数に代入 //

/* テーブルが作成できたか確認する。※テーブルを新規作成する場合のみ実行

  $sql ='SHOW TABLES'; // データベースの作成したテーブルを表示する //
	$result = $pdo -> query($sql); // SQLを実行して変数に代入 //
	foreach ($result as $row){    // 取得したデータを出力する //
		echo $row[0]; // [0]=テーブル名 //
		echo '<br>';
	}
	  echo "<hr>";
*/
?>

<?php
// エラー出力しない場合
ini_set('display_errors', 0);
$sql = "ALTER TABLE tb_mission_52 ADD password TEXT";
$stmt = $pdo->query($sql);
?>

<?php
/*
if ($stmt) {
    echo "カラムを追加しました"."<br/>";
    $url = "https://tb-210395.tech-base.net/mission_5-form.php";
    echo "<a href= $url >投稿画面に戻る</a>";
} else {
    echo "エラーですクソコード書くな！";
}
*/

/*
//  テーブルの中身を確認　※カラムを新規作成する場合のみ実行
$sql ='SHOW CREATE TABLE tb_mission_52';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
*/


// もし、フォームにデータがあるならば・・・
if(!empty($_POST["name"]) && !empty($_POST["comment"]) && !empty($_POST["password"]) && empty($_POST["check"])){

// フォームの中身を変数に代入する
$name = $_POST["name"];
$comment = $_POST["comment"];
$day = date("Y/m/d H:i:s");
$password = $_POST["password"];

// 値を作成したテーブルにデータを入れる
$sql = $pdo -> prepare("INSERT INTO tb_mission_52 (name, comment, post_date, password) VALUES (:name, :comment, :password, :post_date)");
$sql -> bindParam(':name', $name, PDO::PARAM_STR);
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$sql -> bindParam(':post_date', $day, PDO::PARAM_STR);
$sql -> bindParam(':password', $password, PDO::PARAM_STR);
$sql -> execute();


// テーブルにデータが入ったか確認
if ($sql) {
    echo "登録が完了しました"."<br/>";
    $url = "https://tb-210395.tech-base.net/mission_5-form.php";
    echo "<a href= $url >投稿画面に戻る</a>";
} else {
    echo "エラーですクソコード書くな！";
}
}

// 投稿の削除 //
if(!empty($_POST["delete"]) && !empty($_POST["del_password"]) && empty($_POST["name"]) && empty($_POST["comment"]) && empty($_POST["edit"])){
$del_id = $_POST["delete"];
$del_pass = $_POST["del_password"];
$del_sql = 'delete from tb_mission_52 where id= :id and post_date=:del_password';
$stmt = $pdo->prepare($del_sql);
$stmt->bindParam(':id', $del_id, PDO::PARAM_INT);
$stmt->bindParam(':del_password', $del_pass, PDO::PARAM_STR);
$stmt->execute();

// テーブルからデータが削除されたか確認
if ($del_sql) {
    echo "削除が完了しました"."<br/>";
    $url = "https://tb-210395.tech-base.net/mission_5-form.php";
    echo "<a href= $url >投稿画面に戻る</a>";
} else {
    echo "エラーですクソコード書くな！";
}
}

// 投稿の編集~その2~　フォームに表示させた投稿を編集する //
if(isset($_POST["edit_no"]) && isset($_POST["password"]) && isset($_POST["check"]) && !empty($_POST["name"]) && !empty($_POST["comment"])){
	 $edi_id = $_POST["edit_no"];
   $edi_name = $_POST["name"];
   $edi_comment = $_POST["comment"];
   $edi_password = $_POST["password"];

	 $edi_sql = 'update tb_mission_52 set name=:name,comment=:comment where id=:id and post_date=:edi_pass';
	 $stmt = $pdo->prepare($edi_sql); // 入力を受ける準備。SQLにユーザーの入力を含む場合はprepareを使用する //
	 $stmt->bindParam(':name', $edi_name, PDO::PARAM_STR);
	 $stmt->bindParam(':comment', $edi_comment, PDO::PARAM_STR);
	 $stmt->bindParam(':id', $edi_id, PDO::PARAM_INT);
   $stmt->bindParam(':edi_pass', $edi_password, PDO::PARAM_STR);
	 $stmt->execute();

   // 投稿が編集されたか確認
   if ($edi_sql) {
       echo "編集が完了しました"."<br/>";
       $url = "https://tb-210395.tech-base.net/mission_5-form.php";
       echo "<a href= $url >投稿画面に戻る</a>";
   } else {
       echo "エラーですクソコード書くな！";
   }
}

 ?>
    </body>
  </html>
