<?php 
	//开启session
	session_start();
	include "../../conf/dbconfig.php";
	include "../../includes/mysql_func.php";
	include "../../includes/upload_func.php";
	include "../../includes/image_func.php";
	$user = $_SESSION['home']['username'];

	$data = upload($info,'pic','../../resorec/images/userhead');
	$pic = $data['newname'];	
	if(!empty($pic)){
		$pic = suolue($pic,200,200,'../../resorec/images/userhead/');
		$picm = suolue($pic,100,100,'../../resorec/images/userhead/');
		$pics = suolue($pic,48,48,'../../resorec/images/userhead/');
		$sql = "update ".DB_PRE."user_detail set pic='$pic',picm='$picm',pics='$pics' where uid='".$user['id']."'";	
		$row = mysql_func($sql);
	}
	
	if(!$row){
		echo "<script>alert('抱歉！写入数据库失败，请稍后再试！')</script>";
		echo "<script>window.location.href='../individual.php'<script/>";
		exit;
	}
		$sql = "select u.*,d.* from ".DB_PRE."user as u,".DB_PRE."user_detail as d where d.uid=u.id and u.username='".$user['username']."' and u.password='".$user['password']."'";
			//echo $sql;
		$row = mysql_func($sql);
		//var_dump($row);
		if(!$row){
			echo "<script>window.location.href='../individual.php'<script/>";
			exit;
		}
			//echo "执行到这粒了";
		//session的写入直接去给$_SESSION赋值
		$_SESSION['home']['username'] = $row[0];
		//告诉浏览器将保存sessionid的cookie文件保存一个小时
		setcookie(session_name(),session_id(),time()+3600,"/");
		
		echo "<script>window.location.href='../individual.php'</script>";

	exit;
?>