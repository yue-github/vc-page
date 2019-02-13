<?php 

	// foreach($_POST as $key=>$value){
	// 	echo $value;
	// 	echo "<br>";
	// }
	class Mysql{
		private $pdo=null;
		function __construct($open){
			$dsn="mysql:dbhost=localhost;dbname=vc;charset=utf8";
			$dbuname="root";
			$dbpwd="";
			$this->pdo=new PDO($dsn,$dbuname,$dbpwd);
			// if(!$open)$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ATTR_ERRMODE);
		}
		function insert(){
			$name=$_POST['name'];
			$email=$_POST['email'];
			$textarea=$_POST['textarea'];
			date_default_timezone_set("PRC");
			$date=date('Y-m-d H:i:s',time());
			$pdoStatement=$this->pdo->prepare("insert into vc_concact(name,email,textarea,date) values('$name','$email','$textarea','$date')");
			$pdoStatement->execute();
		}
		// 查询数据库用户留言情况
		function select(){
			$pdoStatement=$this->pdo->prepare("select name,email from vc_concact where id=(select max(id) from vc_concact)");
			$pdoStatement->execute();
			$rows = $pdoStatement->fetchAll();
			echo json_encode($rows);
		 //    $pdoStatement=$this->pdo->query("select id name from vc_concact where id=(select max(id) from vc_concact)");
			// $rows=$pdoStatement->fetchAll();
			// echo json_encode($rows);

		}
	}
	$mysql=new Mysql(true);
	$mysql->insert();
	// $mysql->select();
	echo "<script>alert('您的留言提交成功，请耐心等待回复')</script>";
	include_once "index.html";
 ?>