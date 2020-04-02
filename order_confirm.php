<?php

	session_start();	//セッションの開始

	//接続
	try{
		$dbh=new PDO('mysql:host=localhost;dbname=c2019a01','c2019a01','kuma85wai',
			array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'")
		);
	}catch(PDOException $e){
		echo $e->getmessage();
		exit;
	}
	
	$user_name="ゲスト";
	if(!empty($_SESSION["user_name"])){
		$user_name=$_SESSION["user_name"];
	}
	
	if($user_name=="ゲスト"){
		header("Location:login.php");
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tokai食器</title>
	<link rel="stylesheet" href="styles.css">
	<link rel="icon" href="images/tokai.png">
</head>
<body>
	<header>
		<div class="site">
			<h1>TOKAI 食器</h1>
		</div>
		<div class="nav">
			<a href="top.php">商品一覧</a>
			<a href="login.php">ログイン</a>
			<a href="register.php">新規会員登録</a>
		</div>
	</header>
	
	<div class="u_order">
		<h2><?php echo $user_name; ?>さんの注文履歴一覧</h2>
	</div>
	
	<?php
		$sql = "select * from order_table_1111 where u_name=:key_id";
		
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(":key_id",$user_name);
		$stmt->execute();
		
		foreach ( $stmt ->fetchAll(PDO::FETCH_ASSOC) as $order){
	   		?><div class="u_order all"><?php echo "	注文番号番号:".$order['o_number'].  "	購入品:" .$order['p_name']."	個数:" .$order['p_num']."	日付:" .$order['dt']."<br>"; ?></div>
	   		<?php
		}
		
		
		echo "<br><br>";
		
		$dbh=null;
	?>
	
	<footer>c 2020 TOKAI-shokki.</footer>
	
</body>
</html>


