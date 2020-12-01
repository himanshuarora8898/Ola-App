<?php
include('admin.php');
require_once('sqlconfig.php'); 
require_once('class.php');
$obj3 = new DBCon();
$obj4=new admin();
$obj4->ridereq($obj3->conn);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>

</body>
</html>
