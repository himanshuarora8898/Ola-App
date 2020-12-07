<?php
require_once ('class.php');
require_once ('sqlconfig.php');

if (!isset($_SESSION['userdata']['username']))
{
    header("Location: login.php");
}
if ($_SESSION['userdata']['username'] != 'me_admin')
{
    header("Location: login.php");
    return;
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
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="admin.css">
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 ">
          <a href="admin.php?id=12" class="navbar-brand pl-5"><span class="bg-dark text-white diff">Ced</span><span class="text-white diff">Cab</span></a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <center ><h2 id="user">Hello<?php echo "  " . $_SESSION['userdata']['username']; ?></h2></center>
          <div class="collapse navbar-collapse" id="navbar_menu">
            <ul class="navbar-nav ml-auto">
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
      <li><a href="admin.php?id=12">HOME</a></li>
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
<?php
if (isset($_GET['id']))
{
    $m = $_GET['id'];
    if ($m == 1 || $m == 2 || $m == 3 || $m == 4 || $m == 5 || $m == 6 || $m == 7)
    {
        if ($m == 5 || $m == 6 || $m == 7)
        {
            $abc = '<div class="select">
<form action="" method="POST">
<center>Sort By :-<select name="filter" id="filter">
<option value="Select Value">Select Value</option>
<option value="name">Filter by Name</option>

</select>
<input type="submit" value="Filter" name="submit" class="submitt">
</center>

</form>';
        }

        else
        {
            $abc = '<div class="select">
<form action="" method="POST">
<center>Sort By :-<select name="filter" id="filter">
<option value="Select Value">Select Value</option>
<option value="fare">Sort by Total-fare</option>
<option value="date">Sort by Date</option>
<option value="dist">Sort by Distance</option>

</select>
<input type="submit" value="Sort" name="submit" class="submitt">
</center>
<center>Filter By:-<select name="filter2" id="filter2">
<option value="Select Value">Select Value</option>
<option value="minii">Filter By Cedmini</option>
<option value="microo">Filter By Cedmicro</option>
<option value="royall">Filter By Cedroyal</option>
<option value="suvv">Filter By Cedsuv</option>

</select>
<input type="submit" value="Filter" name="submitt" class="submitt">
</center>
</form>';
        }

        echo $abc;

    }
}

if (isset($_POST['submit']))
{
    require_once ('class.php');
    require_once ('sqlconfig.php');
    $obj3 = new DBCon();
    $ab = new user();
    $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
    if ($filter == 1 || $filter == 'fare' || $filter == 'date' || $filter == 'dist' || $filter == 'microo' || $filter == 'minii' || $filter == 'suvv' || $filter == 'royall')
    {
        $a = "<table><tr><th>Ride_id</th><th>Ride_date</th><th>Pickup</th><th>Drop</th><th>Distance</th><th>Fare</th><th>Luggage</th><th>Cab-type</th></tr><tr>";
        $ab->filterrr($a, $m, $filter, $obj3->conn);
      
    }
    else
    {
        
        $a = '<table><tr><th>User_id</th><th>Name</th><th>Contact</th><th>Date </th><th>username</th></tr><tr>';
        $ab->filterrr($a, $m, $filter, $obj3->conn);
    }
}
if (isset($_POST['submitt']))
{
    require_once ('class.php');
    require_once ('sqlconfig.php');
    $obj3 = new DBCon();
    $ab = new user();
    $filter = isset($_POST['filter2']) ? $_POST['filter2'] : '';
    if ($filter == 1 || $filter == 'fare' || $filter == 'date' || $filter == 'dist' || $filter == 'microo' || $filter == 'minii' || $filter == 'suvv' || $filter == 'royall')
    {
        $a = "<table><tr><th>Ride_id</th><th>Ride_date</th><th>Pickup</th><th>Drop</th><th>Distance</th><th>Fare</th><th>Luggage</th><th>Cab-type</th></tr><tr>";
        $ab->filterrr($a, $m, $filter, $obj3->conn);
        
    }
    else
    {
        

        $a = '<table><tr><th>User_id</th><th>Name</th><th>Contact</th><th>Date </th><th>username</th></tr><tr>';
        $ab->filterrr($a, $m, $filter, $obj3->conn);
    }
}

?>






</div>
  
<?php
require_once ('class.php');
require_once ('sqlconfig.php');
$obj3 = new DBCon();
$obj4 = new admin();

if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 1 || $page == 2 || $page == 3 || $page == 4)
    {
        $obj4->ridereq($page, $obj3->conn);

    }
    if ($page == 5 || $page == 6 || $page == 7)
    {
        $obj4->requests($page, $obj3->conn);

    }
    if ($page == 8 || $page == 9 || $page == 10)
    {
        $obj4->location($page, $obj3->conn);

    }
    if ($page == 11)
    {
        session_destroy();
        header("Location:login.php");
    }
}
?>
</div>

<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 12)
    {
        $ids = '<div class="tiles">
    <center>
   <a href="admin.php?id=7" >Total users:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetchuser($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 12)
    {
        $ids = '<div class="til">
    <center>
   <a href="" >Total Earning:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetchearning($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 12)
    {
        $ids = '<div class="tile">
    <center>
   <a href="admin.php?id=5" >Pending user request:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetch_pending_user($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 12)
    {
        $ids = '<div class="tiles">
    <center>
   <a href="admin.php?id=1" >Pending ride request:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetch_pending_ride($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 12)
    {
        $ids = '<div class="til">
    <center>
   <a href="admin.php?id=2" >Approved ride request:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetch_approved_ride($objj->conn);
        echo '</center></div>';
    }

}
?>
<?php
if (isset($_GET['id']))
{
    $page = $_GET['id'];
    if ($page == 12)
    {
        $ids = '<div class="tile">
    <center>
   <a href="admin.php?id=3" >Cancelled ride request:</a><br>';
        echo $ids;
        require_once ('sqlconfig.php');
        require_once ('class.php');
        $objj = new DBCon();
        $object = new user();
        $object->fetch_cancelled_ride($objj->conn);
        echo '</center></div>';
    }

}
?>


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
         <div class="bg-light">
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
