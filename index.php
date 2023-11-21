<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
   <legend>先生</legend>
     <label>名前：<input type="text" name="T_name"></label><br>
     <label>teacher ID：<input type="text" name="T_number"></label><br>
    <legend>生徒</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>class番号：<input type="text" name="number"></label><br>
     <label>SCORE：<input type="text" name="score"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
