<?php
require_once ('class.php');
require_once ('sqlconfig.php');
// session_start();
if (!isset($_SESSION['userdata']['username']))
{
    header("Location: login.php");
}
if ($_SESSION['userdata']['username'] == 'me_admin')
{
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>  

</head>
<title>User Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="admin.css">
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 ">
          <a href="cabb.php" class="navbar-brand pl-5"><span class="bg-dark text-white diff">Ced</span><span class="text-white diff">Cab</span></a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <center ><h2 id="user">Hello<?php echo "  " . $_SESSION['userdata']['username']; ?></h2></center>
          <div class="collapse navbar-collapse" id="navbar_menu">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
                <a href="cabb.php" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="cabb.php?id=1" class="nav-link">Sign out</a>
              </li>
            </ul>
          </div>     
        </nav>
      </header>
      <div class="w3-sidebar w3-black w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
 
  
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()"> &times;</button>
  <div class="dropdown">
        <button class="dropbtn">HOME</button>
  <div class="dropdown-content w3-container">
    <ul>
      <li><a href="user.php?id=7">HOME</a></li>
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

<div class="userhead">
  <button id="openNav" class="w3-button w3-white w3-xlarge" onclick="w3_open()">&#9776;</button>
  <center>
  <div class="w3-container">
    <img src="user.png" alt="Admin" style="height: 100px;border-radius: 80px;">
    <h2>User Dashboard</h2>
  </div>
  </center>
</div>
<div class="select">
<?php
if (isset($_GET['id']))
{
    $m = $_GET['id'];
    if ($m == 1 || $m == 2 || $m == 3)
    {
        $abc = '<div class="select">
<form action="" method="POST">
<center>Sort By :-<select name="filter" id="filter">
   <option value="Select Value">Select Value</option>
   <option value="7">Rides in 7 days</option>
   <option value="30">Rides in 30 days</option>
   <option value="distance">Sort by Distance </option>
   <option value="1">Sort by Fare</option></center>
 
</select>
<input type="submit" value="Sort" name="submit" class="submitt">
<br>


</form>';

        echo $abc;

    }
}
if (isset($_GET['id']))
{
    $m = $_GET['id'];

    if ($m == 1 || $m == 2 || $m == 3)
    {
        $abc = '<div class="select">
<form action="" method="POST">

<center>Filter by: :-<select name="filter" id="filter2">
   <option value="Select Value">Select Value</option>
   <option value="mini">Rides in Cedmini</option>
   <option value="micro">Rides in Cedmicro</option>
   <option value="royal">Rides in Cedroyal</option>
   <option value="suv">Rides in Cedsuv</option></center>
</select>
<input type="submit" value="Filter" name="submitt" class="submitt">
<br>


</form>';

        echo $abc;

    }
}
if (isset($_POST['submit']) || isset($_POST['submitt']))
{
    require_once ('class.php');
    require_once ('sqlconfig.php');
    $obj3 = new DBCon();
    $ab = new user();
    $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

    $a = "<table><tr><th>Ride_id</th><th>Ride_date</th><th>Pickup</th><th>Drop</th><th>Distance</th><th>Fare</th><th>Cab-Name</th><th>Luggage</th></tr><tr>";
    $ab->filterrr($a, $m, $filter, $obj3->conn);

}
?>
</div>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 7)
    {
        $ids = '<div class="usertile">
    <center>
   <a href="user.php?id=3" >Total Rides:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetchuser_rides($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 7)
    {
        $ids = '<div class="usertil">
    <center>
   <a href="">Total expenditure on rides:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetchuser_expense($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 7)
    {
        $ids = '<div class="usertile">
    <center>
   <a href ="user.php?id=1">Pending Rides:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetchuser_pending_rides($objj->conn);
        echo '</center></div>';
    }

}
?>

<?php
require_once ('class.php');
require_once ('sqlconfig.php');
$obj3 = new DBCon();
$obj4 = new user();

if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 1 || $page == 2 || $page == 3)
    {
        $obj4->userrides($page, $obj3->conn);

    }
    if ($page == 4 || $page == 5)
    {

        $obj4->userrides($page, $obj3->conn);

    }
    if ($page == 6)
    {
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
<footer >
         <div class="bg-light ">
         <div class="row">
            <div class="col-sm-4 text-center">
               <p>
                  <a href="#"><i class="fab fa-facebook text-secondary" ></i></a>
                  <a href="#"><i class="fab fa-twitter text-secondary"></i></a>
                  <a href="#"><i class="fab fa-instagram text-secondary"></i></a>
               </p>
            </div>
            <div class="col-sm-4 text-center">
                  <p id="lolo"><sub><i class="fas fa-heart" id="colh"></i></sub>crafted by <strong>page cloud</strong></p>
            </div>
            <div class="col-sm-4 mt-4 text-center">
               <ol>
                  <a href="#" class="ml-2 text-secondary">Features</a>
                  <a href="#" class="ml-2 text-secondary">Reviews</a>
                  <a href="#" class="ml-2 text-secondary">About Us</a>

               </ol>
            </div>
         </div>
         </div>      
      </footer>
</body>
</html>
