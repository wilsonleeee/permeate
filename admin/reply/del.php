<?php
	header("content-type:text/html;charset=utf-8");
	include "../public/demon.php";
	include "../../conf/dbconfig.php";
	include "../../includes/mysql_func.php";
	include "../../includes/del_func.php";
	if(empty($_SERVER['HTTP_REFERER'])){
		exit('非法请求！');
	}
	
	$id =@ $_REQUEST['id'];
	$zd = @$_REQUEST['zd'];
	$table = @$_REQUEST['table'];
	$cz = @$_GET['cz'];
	
	if(!empty($id)){
		if(!empty($cz)){
			echo "<script>window.location.href='recover.php?id=".$id."&cz=".$cz."'</script>";
			echo "<script>alert('我执行了这里')</script>";
			exit;
		}
		
		if(!empty($id)&&!empty($zd)&&!empty($table)){
			$row = del($id,$zd,$table);
		}
		
		if(!$row){
		echo "<script>alert('删除用户失败，请稍后再试!')</script>";
		echo "<script>window.location.href='../index.php?m=reply&a=list'</script>";
		exit;
		}
		echo "<script>window.location.href='../index.php?m=reply&a=list'</script>";
		exit;
	}

?>