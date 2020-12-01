<?php
include('sqlconfig.php');
include('class.php');

if(isset($_GET['id'])){
	$upd =$_GET['id'];
	
}
$obj5 = new DBCon();
$obj6=new admin();
$obj6->rideapprove($upd,$obj5->conn);
header('Location:admin.php?id=1');



?>