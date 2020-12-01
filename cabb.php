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
   <head>
      <title>Cab Fare</title>
      <!-- Required meta tags always come first -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <!-- jQuery first, then Bootstrap JS. -->
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="cab.css">
      <script src="cab.js"></script>
        <script src="jquery.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Display&display=swap" rel="stylesheet">
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>  
   </head>
   <body>
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light p-3 ">
          <a href="#" class="navbar-brand pl-5"><span class="bg-dark text-white diff">Ced</span><span class="text-white diff">Cab</span></a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar_menu">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="#" class="nav-link">About Us</a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">Contact Us</a>
              </li>
              <li class="nav-item">
                <a href="cabb.php?id=1" class="nav-link">Sign out</a>
              </li>
            </ul>
          </div>     
        </nav>
      </header>
      <div>
      	<?php
      	require_once('class.php');
        require_once('sqlconfig.php');
        $ids="";
      	if(isset($_GET['id'])){
      		$ids=$_GET['id'];
      		if($ids==1){
      		session_destroy();
			header("Location:login.php");
      	}
      	}
      	
      	?>
      </div>


      <div class="img">
         <div class=" text-center text-fluid">
            <h1 ><span class=" top">Book a taxi in your destination in your town</span></h1>
            <h4 ><span class="top">Choose from a range of categories and prices</span></h4>
         </div>
         <div class="row">
            <div class="col-lg-6 col-xs-10 m-5 text-center bg-white" id="mar">
               <div class="head">
                  <p><span id="diff">City Taxi</span></p>
               </div>
               <div class="head1 text-center text-dark">
                  <h4>Your everyday travel partner</h4>
                  <p>AC cabs for point to point travel</p>
               </div>
               <form class="col-xs-10">
                  <div class="input-group mb-2">
                     <label class="input-group-text text_size" for="inputGroupSelect01">PICKUP</label>
                     <select class="custom-select pickup" id="pickup" onchange="disable()" required>
                        <option selected>Current-location</option>
                        <?php 
                          $obj = new DBCon();
                          $obj5 = new user();
                          $obj5->pickup($obj->conn);
                        
                        ?>
                     </select>
                  </div>
                  <p class="pickerror text-left text-danger"></p>
                  <div class="input-group mb-2">
                     <label class="input-group-text text_size" for="inputGroupSelect01">DROP</label>
                     <select class="custom-select drop" id="drop" onchange="dis()" required>
                        <option selected>Enter Drop for ride estimate</option>
                       <option selected>Current-location</option>
                       <?php 
                          $obj = new DBCon();
                          $obj5 = new user();
                          $obj5->pickup($obj->conn);
                        
                        ?>
                     </select>
                  </div>
                  <p class="droperror text-left text-danger"></p>
                  <div class="input-group mb-2">
                     <label class="input-group-text text_size" for="inputGroupSelect01">CAB TYPE</label>
                     <select class="custom-select pick" id="cabtype" required onchange="cab()">
                        <option selected value="Select-Cab-Type">Select-Cab-Type</option>
                        <option value="CedMicro">CedMicro</option>
                        <option value="CedMini">CedMini</option>
                        <option value="Cedsuv">CedSuv</option>
                        <option value="Cedroyal">CedRoyal</option>
                     </select>
                  </div>
                  <p class="caberror text-left text-danger"></p>
                  <div class="input-group mb-2">
                     <span class="input-group-text text_size" id="basic-addon1">Luggage</span>
                     <input type="text" class="form-control" onkeypress="return onlynumber(event)" id="luggage" placeholder="Enter Weight In KG" aria-label="Username" aria-describedby="basic-addon1">
                  </div>
                  <div class="input-group mb-2">
                     <div class="input-group-prepend"></div>
                     <input type="button" class="form-control" id="btn" value="Calculate-Fare" onclick="calculate()" aria-label="Username" aria-describedby="basic-addon1">   
                  </div>
                  <div class="bookcab">
                    <input type="button" class="form-control" id="book" style="display: none;" value="Book Now" onclick="ride_detail()" aria-label="Username" aria-describedby="basic-addon1">
                  </div>
                  <div class="distance text-left"></div>
                  <div class="fare text-left"></div>
               </form>
            </div>
            <div class="col-lg-6"></div>
         </div>
      </div>

      <footer class="m-5">
         <div class="mt-5">
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
                  <a href="#" class="ml-2 text-secondary">Sign Up</a>

               </ol>
            </div>
         </div>
         </div>      
      </footer>
   </body>
</html>