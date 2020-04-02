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
		$num=6;
		$price=array("dish1"=>3000,"dish2"=>3500,"fork"=>1200,"knife"=>1350,"fryingpan"=>9800,"kitchenknife"=>11200);
		$p_name=array("dish1"=>"白いお皿","dish2"=>"黒いお皿","fork"=>"フォーク","knife"=>"ナイフ","fryingpan"=>"フライパン","kitchenknife"=>"包丁");
		
		if(isset($_POST["complete_button"])){
		$date=date("Y-m-d");
		for($i=0;$i<$num;$i++){
			if(isset($_SESSION["product_box"][$i])){
				$sql="insert into order_table_1111 (u_name,p_name,p_num,dt) value (:add_uname,:add_pname,:add_pnum,:add_dt) ";
				$stmt=$dbh->prepare($sql);
				$stmt->bindParam(":add_uname",$user_name);
				$stmt->bindParam(":add_pname",$p_name[$_SESSION["product_box"][$i]]);
				$stmt->bindParam(":add_pnum",$_SESSION["product_number"][$i]);
				$stmt->bindParam(":add_dt",$date);
				
				
				$stmt->execute();
				$_SESSION["product_box"][$i]=null;
				$_SESSION["product_number"][$i]=null;
			}
		}
	}
		
	?>
	
	<div class="btn">
		<h2>ご購入ありがとうございます</h2>
		<h2></h2>
	<form method="POST" action="top.php">
		<input type="submit" value="商品一覧へ"> 
	</form>
	</div>
	
	<footer>© 2020 TOKAI-shokki.</footer>
	
</body>
</html>


