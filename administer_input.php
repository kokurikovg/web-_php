<?php
	//接続
	try{
		$dbh=new PDO('mysql:host=localhost;dbname=c2019a01','c2019a01','kuma85wai',
			array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'")
		);
	}catch(PDOException $e){
		echo $e->getmessage();
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tokai食器管理者ページ</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="icon" href="images/tokai.png">
</head>
<body>
	<header>
		<div class="site">
			<h1>TOKAI 食器 管理者画面</h1>
		</div>
	</header>
	
	<form action="administer.php" method="POST">
		<br><input type="submit" value="会員一覧" name="user_all_button"><br><br><hr>
		<input type="submit" value="注文履歴一覧" name="order_all_button"><br><br><hr>
		id:<input type="text" name="u_id"><br>
		<input  type="submit" name="id_search" value="idで注文履歴検索" ><br><br><hr>
		商品名:<select name="p_name">
			<option value="白いお皿">白いお皿</option>
			<option value="黒いお皿">黒いお皿</option>
			<option value="フォーク">フォーク</option>
			<option value="ナイフ">ナイフ</option>
			<option value="フライパン">フライパン</option>
			<option value="包丁">包丁</option>
		</select><br>
		<input  type="submit" name="p_search" value="商品名で注文履歴検索" ><br><br><hr>
	</form>
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>



