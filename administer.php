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
	
	<?php
		
	
	
		if(isset($_POST["user_all_button"])){
			echo "<h3><br>会員一覧</h3>";
			$sql = "select * from user_table_1111";
			$stmt = $dbh->query($sql);
			foreach ( $stmt ->fetchAll(PDO::FETCH_ASSOC) as $user){
		   		echo "会員番号:".$user['u_number']. "	id:"  .$user['id']. "	氏名:" .$user['name']."<br>";
			}
		}elseif(isset($_POST["order_all_button"])){
			echo "<h3><br>注文履歴一覧</h3>";
			$sql = "select * from order_table_1111";
			$stmt = $dbh->query($sql);
			foreach ( $stmt ->fetchAll(PDO::FETCH_ASSOC) as $order){
		   		echo "注文番号番号:".$order['o_number']. "	ユーザーネーム:"  .$order['u_name']. "	購入品:" .$order['p_name']."	個数:" .$order['p_num']."	日付:" .$order['dt']."<br>";
			}
		}elseif(isset($_POST["id_search"])){
			if($_POST["u_id"]==null){
				echo "<h3><br>idを入力してください</h3>";
			}else{
				echo "<h3><br>".$_POST["u_id"]."さんの注文履歴一覧</h3>";
				$sql = "select * from order_table_1111 where u_name=:key_id";
				
				$stmt = $dbh->prepare($sql);
				$stmt->bindParam(":key_id",$_POST["u_id"]);
				$stmt->execute();
				
				foreach ( $stmt ->fetchAll(PDO::FETCH_ASSOC) as $order){
			   		echo "注文番号番号:".$order['o_number'].  "	購入品:" .$order['p_name']."	個数:" .$order['p_num']."	日付:" .$order['dt']."<br>";
				}
			}
		}elseif(isset($_POST["p_search"])){
			echo "<h3><br>".$_POST["p_name"]."の注文履歴一覧</h3>";
			$sql = "select * from order_table_1111 where p_name =:key_p_name";
			
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(":key_p_name",$_POST["p_name"]);
			$stmt->execute();
			
			foreach ( $stmt ->fetchAll(PDO::FETCH_ASSOC) as $order){
		   		echo "注文番号番号:".$order['o_number']. "	ユーザーネーム:"  .$order['u_name'].   "	購入品:" .$order['p_name']."	個数:" .$order['p_num']."	日付:" .$order['dt']."<br>";
			}
		}
		
		
		
		echo "<br><br>";
		
		$dbh=null;
	?>
	
	<form action="administer_input.php" method="POST">
		<input type="submit" value="管理者画面トップへ">
	</form>
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>


