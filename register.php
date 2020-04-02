<?php
	session_start();	//セッションの開始

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tokai 食器</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="icon" href="images/tokai.png">
</head>
<body>
	<?php
		$user_name="ゲスト";
		if(!empty($_SESSION["user_name"])){
			$user_name=$_SESSION["user_name"];
		}
	?>

	<header>
		<div class="site">
			<h1>TOKAI 食器</h1>
			<h2>ようこそ<?php echo $user_name; ?>さん</h2>
		</div>
		<div class="nav">
			<a href="top.php">商品一覧</a>
			<?php 
			if($user_name!="ゲスト"){
				?><a href="order_confirm.php">購入履歴</a><?php
			} ?>
			<a href="order_confirm.php">購入履歴</a>
		</div>
	</header>
	
	<form method="POST" action="register_complete.php">
	<div class="login">
		ユーザーネーム:<input type="text" name="user_name"><br><br>
		パスワード:<input type="password" name="password"><br><br>
		氏名:<input type="text" name="name" ><br><br>
		住所:<input type="text" name="address" size="50"><br><br>
		<input type="submit" name="register_button" value="会員登録"><br><br>
	</form>
	
	<form method="" action="top.php">
		<input type="submit" name="register_cancel" value="キャンセル"><br><br>
	</form>
	</div>
	
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>

