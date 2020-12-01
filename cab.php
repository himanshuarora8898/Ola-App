<?php

require_once('sqlconfig.php');
require_once('class.php');
$distance = array("Charbagh"=>"0","Indira Nagar"=>"10","BBD"=>"30","Barabanki"=>"60","Faizabad"=>"100","Basti"=>"150","Gorakhpur"=>"210","Allahabad"=>"340","Kanpur"=>"180");
$baggage =$_POST['baggage'];
$from = $_POST['from'];
$to = $_POST['to'];
$from2 = $distance[$from];
$to2 = $distance[$to];

$travel  = abs($from2 - $to2);
echo $travel;
$fare=0;
$baggage=0;
$_SESSION['ride']['from']= $from;
$_SESSION['ride']['to'] =$to;
$_SESSION['ride']['baggage']=$_POST['baggage'];
$_SESSION['ride']['travel']=$travel;
$_SESSION['ride']['cab']=$_POST['cab'];
if($_POST['cab']!='Cedsuv' && $_POST['baggage']!=""){
	if($_POST['baggage']<=10 && $_POST['baggage']>0 ){
		$baggage+=50;
	}
	elseif ($_POST['baggage']>10 && $_POST['baggage']<=20 ) {
		$baggage+=100;
	}
	else{
		$baggage+=200;
	}
}
elseif($_POST['cab']=='Cedsuv'){
	if($_POST['baggage']<=10 && $_POST['baggage']>0){
		$baggage+=100;
	}
	elseif ($_POST['baggage']>10 && $_POST['baggage']<=20 ) {
		$baggage+=200;
	}
	else{
		$baggage+=400;
	}

}
if($_POST['cab']=="CedMicro"){
	$fixed = 50;
	if($travel <=10){
		$fare = $fixed+($travel*13.50);
	}
	elseif ($travel >10 && $travel<=60) {
		$fare = $fixed+(10*13.50)+($travel-10)*12;
	}
	elseif ($travel>60 && $travel<=160) {
		$fare = $fixed+(10*13.50)+(50*12)+($travel-60)*10.20;
	}
	else{
		$fare = $fixed+(10*13.50)+(50*12)+(100*10.20)+($travel-160)*8.50;
	}
	echo(',');
	echo $fare;
}
if($_POST['cab']=="CedMini"){
	$fixed = 150;
	if($travel <=10 ){
		$fare = $baggage+$fixed+($travel*14.50);
	}
	elseif ($travel >10 && $travel<=60) {
		$fare =$baggage+$fixed+(10*14.50)+($travel-10)*13;
	}
	elseif ($travel>60 && $travel<=160) {
		$fare = $baggage+$fixed+(10*14.50)+(50*13)+($travel-60)*11.20;
	}
	else{
		$fare = $baggage+$fixed+(10*14.50)+(50*13)+(100*11.20)+($travel-160)*9.50;
	}
	echo(',');
	echo $fare;
}
if($_POST['cab']=="Cedroyal"){
	$fixed = 200;
	if($travel <=10){
		$fare =$baggage+$fixed+($travel*15.50);
	}
	elseif ($travel >10 && $travel<=60) {
		$fare =$baggage+$fixed+(10*15.50)+($travel-10)*14;
	}
	elseif ($travel>60 && $travel<=160) {
		$fare = $baggage+$fixed+(10*15.50)+(50*14)+($travel-60)*12.20;
	}
	else{
		$fare = $baggage+$fixed+(10*15.50)+(50*14)+(100*12.20)+($travel-160)*10.50;
	}
	echo(',');
	echo $fare;
}
if($_POST['cab']=="Cedsuv"){
	$fixed = 250;
	if($travel <=10){
		$fare = $baggage+$fixed+($travel*16.50);
	}
	elseif ($travel >10 && $travel<=60) {
		$fare =$baggage+$fixed+(10*16.50)+($travel-10)*15;
	}
	elseif ($travel>60 && $travel<=160) {
		$fare = $baggage+$fixed+(10*16.50)+(50*15)+($travel-60)*13.20;
	}
	else{
		$fare = $baggage+$fixed+(10*16.50)+(50*15)+(100*13.20)+($travel-160)*11.50;
	}
	echo(',');
	echo($fare);
	}
	$_SESSION['ride']['fare']=$fare;
	require_once('sqlconfig.php');
	require_once('class.php');
	$obj= new DBCon();
	$obj2=new user();
	$obj2->ride_detail($obj->conn);
?>
