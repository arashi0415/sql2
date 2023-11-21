<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONNECTION'.$e->getMessage());
}

//２．データ登録SQL作成
$sql="SELECT  * FROM gs_an_table ";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";//HTMLの文字を作成して入れる用
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_Error:".$error[2]);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
$json = json_encode($values,JSON_UNESCAPED_UNICODE);
$sql2 = "SELECT * FROM gs_an_table_student";
$stmt2 = $pdo->prepare($sql2);
$status2 = $stmt2->execute();

// ３．データ表示
$view2 = ""; // HTMLの文字を作成して入れる用
if ($status2 == false) {
    // execute（SQL実行時にエラーがある場合）
    $error2 = $stmt2->errorInfo();
    exit("SQL_Error:" . $error2[2]);
}

// 全データ取得
$values2 = $stmt2->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json2 = json_encode($values2);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div class="container jumbotron">
      <table>
        <h3>テーブル名:gs_an_table</h3>
        T_number
        T_name
        <?php foreach($values as $v){?>
          <tr>
            <td><?=$v["T_number"]?>:</td>
            <td><?=$v["T_name"] ?></td>
          </tr>
        <?php }?>
      </table>
    </div>
</div>
<div>
    <div class="container jumbotron">
      <table>
      <h3>テーブル名:gs_an_table_student </h3>
      number:name:score
        <?php foreach($values2 as $v){?>
          <tr>
            <td><?=$v["number"]?>  :</td>
            <td><?=$v["name"] ?>   :</td>
            <td><?=$v["score"] ?></td>
          </tr>
        <?php }?>
      </table>
    </div>
</div>
<h2 style="text-align: center;"> SELECT 列名 FROM テーブル名 (*は全部)</h2>
<h3>WHERE句（列の値に対して行でとる）</h3>
<h3>Q,SELECT name FROM gs_an_teble_student WHERE score < 50 は？  </h3>
<h3 id="A1"></h3>
<!-- Main[End] -->


<script>
  //JSON受け取り

const json1 ='<?= $json ?> ';
const jDate=JSON.parse(json1);
const b ='<?= $json2 ?> ';
const jDate2=JSON.parse(b);
console.log(jDate2)


let kotae =document.querySelector('#A1');
kotae.innerHTML=jDate2

// 特定のインデックスにあるデータを取り出して表示


</script>
</body>
</html>
