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
			<a href="login.php">ログイン</a>
		</div>
	</header>
	
	<?php
		$register_button=$_POST["register_button"];
		$add_id=$_POST["user_name"];
		$add_password=$_POST["password"];
		$add_name=$_POST["name"];
		$add_adress=$_POST["address"];
		
		//db接続
		try{
			$dbh=new PDO('mysql:host=localhost;dbname=c2019a01','c2019a01','kuma85wai',
				array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'")
			);
		}catch(PDOException $e){
			echo $e->getmessage();
			exit;
		}
		
		if(isset($register_button)){		//会員登録ボタンがクリックされたら
			$sql="insert into user_table_1111 (id,password,name,address) value (:add_id,:add_password,:add_name,:add_address)";
			$stmt=$dbh->prepare($sql);
			
			$stmt->bindParam(":add_id",$add_id);
			$stmt->bindParam(":add_password",$add_password);
			$stmt->bindParam(":add_name",$add_name);
			$stmt->bindParam(":add_address",$add_adress);
			
			$stmt->execute();
			
			?>
			<div class="complete">
			<?php
			echo "<h2>会員登録が完了しました</h2><br><br>";
			?>
			</div>
			<?php
		}
	?>
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>
