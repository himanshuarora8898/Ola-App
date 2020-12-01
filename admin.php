<?php
require_once('class.php');
require_once('sqlconfig.php');

if(!isset($_SESSION['userdata']['username'])){
  header("Location: login.php");
}
if($_SESSION['userdata']['username']!='me_admin'){
  header("Location: login.php");
  return;
}



?>
<!DOCTYPE html>
<html>
<title>Admin Dashboard</title>
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
      <li><a href="admin.php">HOME</a></li>
    </ul>
  </div>
  </div>
<br>
  <div class="dropdown">
  <button class="dropbtn">Rides</button>
  <div class="dropdown-content w3-container">
    <ul>
      <li><a href="admin.php?id=1">Pending Rides </a></li>
      <li><a href="admin.php?id=2">Completed Rides</a></li>
      <li><a href="admin.php?id=3">Cancelled Rides </a></li>
      <li><a href="admin.php?id=4">ALL Rides </a></li>
    </ul>
  </div>
  </div>
<br>
    <div class="dropdown">
    <button class="dropbtn">User</button>
    <div class="dropdown-content w3-container">
    <ul>
      <li><a href="admin.php?id=5">Pending User request </a></li>
      <li><a href="admin.php?id=6">Approved User request</a></li>
      <li><a href="admin.php?id=7">All user </a></li>
    </ul>
  </div>
</div>
<br>
<div class="dropdown">
    <button class="dropbtn">Location</button>
    <div class="dropdown-content w3-container">
    <ul>
      <li><a href="admin.php?id=8">Location List</a></li>
      <li><a href="admin.php?id=9">Add Location</a></li>
    </ul>
  </div>
</div>
<br>  
<div class="dropdown">
    <button class="dropbtn">Accounts</button>
    <div class="dropdown-content w3-container">
    <ul>
      <li><a href="admin.php?id=10">Change Password</a></li>
    </ul>
  </div>
</div>
<br>
<div>
  <ul style="padding:0px 0px 0px 20px;">
    <li style="text-decoration: none;display: block;"><a href="admin.php?id=11" style="text-decoration: none;">Logout</a></li>
  </ul>
</div>
</div>



</div>
<div id="main">

<div class="w3-black">
  <button id="openNav" class="w3-button w3-white w3-xlarge" onclick="w3_open()">&#9776;</button>
  <center>
  <div class="w3-container">
    <img src="admin.png" alt="Admin" style="height: 100px;border-radius: 80px;">
    <h2>Admin Dashboard</h2>
  </div>
  </center>


</div>
<div class="select">
<form action="admin.php" method="POST">
<center>Filter Value:-<select name="filter" id="filter">
   <option value="Select Value">Select Value</option>
   <option value="name">Name</option>
   <option value="fare">Total-fare</option>
   <option value="date">Date</option>
 
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
  if($filter==1 || $filter=='fare'|| $filter=='date'){
    $a= "<table><tr><th>Ride_id</th><th>Ride_date</th><th>Pickup</th><th>Drop</th><th>Distance</th><th>Fare</th><th>Luggage</th></tr><tr>";
    $ab->sorting($a,$filter,$obj3->conn);
  }
  else{

  
  $a='<table><tr><th>User_id</th><th>Name</th><th>Contact</th><th>Date</th><th>username</th></tr><tr>';
  $ab->sorting($a,$filter,$obj3->conn);
  }
}


?>
</div>

 <div class="tiles">
  <center>
   <h3>Total users:</h3>
  <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetchuser($objj->conn);
?>
  </center> 
 </div>
  <div class="til">
    <center>
    <h3>Total Earning:</h3>
    <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetchearning($objj->conn);
?>
    </center>
  </div>
  <div class="tile">
    <center>
    <h3>Pending user request:</h3>
    <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetch_pending_user($objj->conn);
?>
    </center>
  </div>
  <div class="tiles">
    <center>
    <h3>Pending ride request:</h3>
    <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetch_pending_ride($objj->conn);
?>
    </center>
  </div>
  <div class="til">
    <center>
    <h3>Approved ride request:</h3>
    <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetch_approved_ride($objj->conn);
?>
    </center>
  </div>
  <div class="tile">
     <center>
    <h3>Cancelled ride request:</h3>
    <?php 
   require_once('sqlconfig.php'); 
   require_once('class.php');
   $objj= new DBCon();
   $object=new user();
   $object->fetch_cancelled_ride($objj->conn);
?>
    </center>
  </div>
<?php 



require_once('class.php');
require_once('sqlconfig.php');
$obj3= new DBCon();
$obj4=new admin();

if(isset($_GET['id'])){
$page=$_GET['id'];
if($page==1||$page==2||$page==3 ||$page==4){
  $obj4->ridereq($page,$obj3->conn);

}
if($page==5||$page==6||$page==7){
  $obj4->requests($page,$obj3->conn);

}
if($page==8||$page==9||$page==10){
  $obj4->location($page,$obj3->conn);

}
if($page==11){
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