<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
//1. POSTデータ取得
$T_number  = $_POST["T_number"];
$T_name   = $_POST["T_name"];

$number   = $_POST["number"];
$name = $_POST["name"];
$score =$_POST["score"];
//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root',''); //MAMPはrootを入力
} catch (PDOException $e) {
  exit('DB_CONNECTION:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql="SELECT *  FROM gs_an_table WHERE  T_name =:T_name AND T_number=:T_number ";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':T_number', $T_number,PDO::PARAM_INT );  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':T_name', $T_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();//実行　exe

$val = $stmt->fetch();

if ($val) {
  header("Location: select.php");
  exit;
} else {
  
  echo "認証失敗";
}

//３．データ登録SQL作成
$sql_2="INSERT INTO gs_an_table_student
(number,name,score,indate)
VALUES
(:number,:name,:score,sysdate());";
$stmt_2 = $pdo->prepare($sql_2);
$stmt_2->bindValue(':number', $number, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_2->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_2->bindValue(':score', $score, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status_2 = $stmt_2->execute();//実行　exe

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_Error:".$error[2]);
}else{
  //５．index.phpへリダイレクト

header("Locatio: index.php");
exit;
}
?>
