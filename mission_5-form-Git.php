<!doctype html>
 <html lang="ja">
    <head>
      <meta charset="utf-8">
      <title>mission_5-form</title>
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

      // 投稿の編集~その1~　編集する番号をフォームに表示させる //
      if(isset($_POST["edit"]) && isset($_POST["edi_password"]) && empty($_POST["name"]) && empty($_POST["comment"]) && empty($_POST["delete"])) {
        $edi_id = $_POST["edit"];
        $edi_pass = $_POST["edi_password"];
        $edi_sql = 'SELECT * FROM tb_mission_52 where id = :id and post_date=:edi_pass';
        $stmt = $pdo->prepare($edi_sql);
        $stmt->bindParam(':id', $edi_id, PDO::PARAM_INT);
        $stmt->bindParam(':edi_pass', $edi_pass, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as $row){
          $edi_no = $row['id'];
          $edi_name = $row['name'];
          $edi_comment = $row['comment'];
          $edi_pass = $row['post_date'];
      }
      }
       ?>

      <form action="mission_5-connect.php" method="post">

        <input type="hidden" value="<?php
                                      $_POST["edit"]
                                              ?>">

        <input type="hidden" name="edit_no" value="<?php
                                            if($_POST["edit"]){
                                              echo $edi_no;
                                            }
                                            ?>"
                                            placeholder="編集番号">

       <input type="text" name="name" value="<?php
                                             if($_POST["edit"]){
                                               echo $edi_name;
                                             }
                                             ?>"
                                             placeholder="名前"></br>

       <input type="text" name="comment" size="50" value="<?php
                                             if($_POST["edit"]){
                                               echo $edi_comment;
                                             }
                                             ?>"
                                           placeholder="コメント"></br>
       <input type="password" name="password" value="<?php
                                              if($_POST["edit"]){
                                                echo $edi_pass;
                                              }
                                              ?>"
                                           placeholder="パスワード">
       <input type="submit" name="post" value="送信">
       <input type="checkbox" name="check" value="編集">編集<br />
       　　　　　　　　　　　　　　　　　　　　　　　　　　　　　<br />

        <input type="text" name="delete" placeholder="削除番号"><br />
        <input type="password" name="del_password" placeholder="パスワード">
        <input type="submit" value="削除"><br />
       </form>

       <form action="mission_5-form.php" method="post">
        <input type="text" name="edit" placeholder="編集番号"><br />
        <input type="password" name="edi_password" placeholder="パスワード">
        <input type="submit" value="編集">  　　　　　　　　　　　　　　　　　　　　　　　　

      </form>


    </body>
  </html>
