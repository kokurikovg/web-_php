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
			<a href="login.php">ログイン</a>
			<a href="register.php">新規会員登録</a>
			<?php 
			if($user_name!="ゲスト"){
				?><a href="order_confirm.php">購入履歴</a><?php
			} ?>
		</div>
	</header>
	
	<form method="POST" action="confirm.php">
	<div class="products">
		<div class="product p1">
			<img src="images/dish1.jpg" alt="皿1"><br>
			<input type="checkbox" name="product_box[0]" value="dish1">白いお皿&nbsp;
			個数:<input type="text" name="product_number[0]"  size="5" maxlength="3">&nbsp;
			値段:\3000
		</div>
		<div class="product p2">
			<img src="images/dish2.jpg" alt="皿2"><br>
			<input type="checkbox" name="product_box[1]" value="dish2">黒いお皿&nbsp;
			個数:<input type="text" name="product_number[1]"  size="5" maxlength="3">&nbsp;
			値段:\3500
		</div>
		<div class="product p2">
			<img src="images/fork.jpg" alt="フォーク"><br>
			<input type="checkbox" name="product_box[2]" value="fork">フォーク&nbsp;
			個数:<input type="text" name="product_number[2]"  size="5" maxlength="3">&nbsp;
			値段:\1200
		</div>
		<div class="product p2">
			<img src="images/knife.jpg" alt="ナイフ"><br>
			<input type="checkbox" name="product_box[3]" value="knife">ナイフ&nbsp;
			個数:<input type="text" name="product_number[3]"  size="5" maxlength="3">&nbsp;
			値段:\1350
		</div>
		<div class="product p2">
			<img src="images/fryingpan.jpg" alt="フライパン"><br>
			<input type="checkbox" name="product_box[4]" value="fryingpan">フライパン&nbsp;
			個数:<input type="text" name="product_number[4]"  size="5" maxlength="3">&nbsp;
			値段:\9800
		</div>
		<div class="product p2">
			<img src="images/k_knife.jpg" alt="包丁"><br>
			<input type="checkbox" name="product_box[5]" value="kitchenknife">包丁&nbsp;
			個数:<input type="text" name="product_number[5]"  size="5" maxlength="3">&nbsp;
			値段:\11200
		</div>
	</div>
	
	<div class="p_button">
		<input type="submit" value="購入する" name="buy_button"> 
	</div>
	</form>
	
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>
