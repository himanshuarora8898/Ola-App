<?php
require_once('class.php');
require_once('sqlconfig.php');
// session_start();
if(!isset($_SESSION['userdata']['username'])){
  header("Location: login.php");
}
if($_SESSION['userdata']['username']=='me_admin'){
  header("Location: login.php");
}




?>
<!DOCTYPE html>
<html>
<title>User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="admin.css">
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()"> &times;</button>

  <div class="dropdown">
        <button class="dropbtn">HOME</button>
  <div class="dropdown-content w3-container">
    <ul>
      <li><a href="user.php">HOME</a></li>
    </ul>
  </div>
  </div>
<br>
    <div class="dropdown">
          <button class="dropbtn">Book</button>
    <div class="dropdown-content w3-container">
    <ul>
      <li><a href="cabb.php">Book New Ride</a></li>
    </ul>
  </div>
</div>
<br>
<div class="dropdown">
    <button class="dropbtn">Rides</button>
    <div class="dropdown-content w3-container">
    <ul>
      <li><a href="user.php?id=1">Pending Rides</a></li>
      <li><a href="user.php?id=2">Completed Rides</a></li>
      <li><a href="user.php?id=3">All Rides</a></li>

    </ul>
  </div>
</div>
<br>
<div class="dropdown">
    <button class="dropbtn">Accounts</button>
    <div class="dropdown-content w3-container">
    <ul>
      <li><a href="user.php?id=4">Update Information</a></li>
      <li><a href="user.php?id=5">Change Password</a></li>
    </ul>
  </div>
</div>

<div>
  <ul style="padding:0px 0px 0px 20px;">
    <li style="text-decoration: none;display: block;"><a href="user.php?id=6" style="text-decoration: none;">Logout</a></li>
  </ul>
</div>
</div>

<div id="main">

<div class="w3-amber">
  <button id="openNav" class="w3-button w3-white w3-xlarge" onclick="w3_open()">&#9776;</button>
  <center>
  <div class="w3-container">
    <img src="user.png" alt="Admin" style="height: 100px;border-radius: 80px;">
    <h2>User Dashboard</h2>
  </div>
  </center>
</div>
<div class="select">
<form action="user.php" method="POST">
<center>Filter Value:-<select name="filter" id="filter">
   <option value="Select Value">Select Value</option>
   <option value="7">7 days</option>
   <option value="30">30 days</option>
   <option value="1">Fare</option>
 
</select>
<input type="submit" value="submit" name="submit" class="submit">
</center>
</form>
<?php
if (isset($_POST['submit'])) {
  require_once('class.php');
  require_once('sqlconfig.php');
   $obj3= new DBCon();
   $ab=new user();
  $filter=isset($_POST['filter'])?$_POST['filter']:'';
  if($filter==1){
    $a= "<table><tr><th>Ride_id</th><th>Ride_date</th><th>Pickup</th><th>Drop</th><th>Distance</th><th>Fare</th><th>Luggage</th></tr><tr>";
    $ab->sorting($a,$filter,$obj3->conn);
  }
  else{

  
  $a='<table><tr><th>User_id</th><th>Name</th><th>Contact</th><th>Date </th><th>username</th></tr><tr>';
  $ab->sorting($a,$filter,$obj3->conn);
  }
}


?>

</div>
<div class="usertile">
  <center>
  <h3>Total Rides:</h3>
  <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetchuser_rides($objj->conn);
?>
  </center>
</div>
<div class="usertil">
  <center>
  <h3>Total expenditure on rides:</h3>
  <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetchuser_expense($objj->conn);
?>
  </center>
</div>
<div class="usertile">
  <center>
  <h3>Pending Rides:</h3>
   <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetchuser_pending_rides($objj->conn);
?>
  </center>
</div>
<?php 



require_once('class.php');
require_once('sqlconfig.php');
$obj3= new DBCon();
$obj4=new user();

if(isset($_GET['id'])){
$page=$_GET['id'];
if($page==1||$page==2||$page==3){
  $obj4->userrides($page,$obj3->conn);

}
if($page==4||$page==5){

  $obj4->userrides($page,$obj3->conn);

}
if($page==6){
session_destroy();
header("Location:login.php");
}
}
?>

</div>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

</body>
</html>