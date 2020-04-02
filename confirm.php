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
		
		//db接続
		try{
			$dbh=new PDO('mysql:host=localhost;dbname=c2019a01','c2019a01','kuma85wai',
				array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET CHARACTER SET 'utf8'")
			);
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	?>

	<header>
		<div class="site">
			<h1>TOKAI 食器</h1>
			<h2>ようこそ<?php echo $user_name; ?>さん</h2>
		</div>
	</header>
	
	<?php
		$total=0;
		$num=6;
		$price=array("dish1"=>3000,"dish2"=>3500,"fork"=>1200,"knife"=>1350,"fryingpan"=>9800,"kitchenknife"=>11200);
		$p_name=array("dish1"=>"白いお皿","dish2"=>"黒いお皿","fork"=>"フォーク","knife"=>"ナイフ","fryingpan"=>"フライパン","kitchenknife"=>"包丁");
	?>	
	<div class="total">
	<?php
	if(isset($_POST["buy_button"])){
	
		if($user_name=="ゲスト"){
			header("Location:login.php");
		}
	
		$sql="select * from user_table_1111 where id=:key_id";
		$stmt=$dbh->prepare($sql);
		$stmt->bindParam(":key_id",$user_name);
		$stmt->execute();
		foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $user){
			echo "<h2>購入者氏名:".$user["name"]."<br>配送先住所:".$user["address"]."</h2>";
		}
		
		if(isset($_POST["product_box"])){
			for($i=0;$i<$num;$i++){
				$_SESSION["product_box"][$i]=$_POST["product_box"][$i];
				$_SESSION["product_number"][$i]=$_POST["product_number"][$i];
				if(isset($_POST["product_box"][$i])){
					echo "<h2>".$p_name[$_POST["product_box"][$i]].":\\".$price[$_POST["product_box"][$i]]."&nbsp個数:".$_POST["product_number"][$i]."</h2>";
					$total+= $price[$_POST["product_box"][$i]] * $_POST["product_number"][$i];
				}
			}
		}else{
			echo "<h2>商品が選択されていません</h2><br>";
		}
		echo "<h2>合計金額:".$total."円</h2>";
		echo "<h2>決済:代金引換</h2><br>";
	}	
	
	
	$dbh=null;
	?>
	</div>
	
	<div class="btn">
	<form method="POST" action="complete.php">
		<input type="submit" value="購入を確定" name="complete_button"><br><br>
	</form>
	
	<form method="POST" action="top.php">
		<input type="submit" value="購入をキャンセル"> 
	</form>
	</div>
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>

