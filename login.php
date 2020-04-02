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
			<a href="register.php">新規会員登録</a>
			<?php 
			if($user_name!="ゲスト"){
				?><a href="order_confirm.php">購入履歴</a><?php
			} ?>
		</div>
	</header>
	
	<?php
		if(isset($_POST["login_button"])){
			if(!empty($_POST["user_name"]) && !empty($_POST["password"])){
				$u_name=$_POST["user_name"];
				$password=$_POST["password"];
				//フラグ
				$flag=false;
				//db接続
				try{
					$dbh=new PDO('mysql:host=localhost;dbname=c2019a01','c2019a01','kuma85wai');
					
					$sql="select * from user_table_1111";
					$stmt=$dbh->query($sql);
					foreach ($stmt ->fetchAll(PDO::FETCH_ASSOC) as $user){
		   				if($user["id"]==$u_name && $user["password"]==$password){
		   					$_SESSION["user_name"]=$u_name;
		   					$flag=true;
		   					break;
		   				}
					}
				}catch(PDOException $e){
					echo $e->getMessage();
					exit;
				}
				?>
				<div class="login_a">
				<?php
				if($flag==true){
					header("Location:top.php");
				}else{
					echo "<h2>ユーザーネームもしくはパスワードが違います。</h2>";
				}
				?>
				</div>
			<?php
			}else{
				?><div class="login_b"> <?php echo "<h2>ユーザーネームもしくはパスワードが未入力です。</h2>"; ?></div>
				<?php
			}
		}
		//db切断
		$dbh=null;
	?>
	
	<form action="" method="POST">
	<div class="login">
		ユーザーネーム:<input type="text" name="user_name"><br><br>
		パスワード:<input type="password" name="password" size="25"><br><br>
		<input type="submit" name="login_button" value="ログイン"><br><br>
	</div>
	</form>
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>
