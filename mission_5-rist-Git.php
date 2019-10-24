<!doctype html>
 <html lang="ja">
    <head>
      <meta charset="utf-8">
      <title>mission_5-rist</title>
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

// 入力したデータの表示する //
$sql = 'SELECT * FROM tb_mission_52'; // テーブルのデータを取得する
$stmt = $pdo->query($sql); // SQLを実行して変数$stmtに格納 　　　　　　
$results = $stmt->fetchAll(); // 実行した結果のすべての行を取得する ※実行結果が複数ある場合はfetchALLを使う。
foreach ($results as $row){ // 取得した行を$rowに設定して、$rowの中身をループ処理で取り出し
  // ループ処理で取り出し$rowの中身をehoで表示する
  	 	echo $row['id'].',';
  	 	echo $row['name'].',';
      echo $row['comment'].',';
      echo $row['post_date'].',';
  	 	echo $row['password'].'<br>';
  	  echo "<hr>";
  	 }
 ?>


    </body>
  </html>
