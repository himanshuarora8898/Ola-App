<?php

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
   <script src="https://kit.fontawesome.com/a076d05399.js"></script>  

	<title></title>
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
               <h3>CEDCAB</h3>
               <p>3/460, Opp to Nehru Enclave,</p>
               <p>Vishwas Khand,</p>
               <p>Lucknow.</p>
              </li>
            </ul>
          </div>     
        </nav>
      </header>
      <?php
		include('sqlconfig.php');
		include('class.php');

		if(isset($_GET['id'])){
			$ids =$_GET['id'];
			
		}
		$obj5 = new DBCon();
		$obj6=new user();
		$obj6->invoice($ids,$obj5->conn);


       ?>
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
                  <a href="#" class="ml-2 text-secondary">About Us</a>

               </ol>
            </div>
         </div>
         </div>      
      </footer>
</body>
</html>

<style>
table{
	border:2px solid black;
	width: 40%;
}	
th{
	background-color: lightblue;
	padding: 10px;
	border:2px solid black;


}	
td{
	border:2px solid black;
	padding: 10px;
}	
#logo{
	font-size: 1.5em;
}
#ced{
	color: white;
	background-color: rgb(23, 19, 15);
}
#user{
	    margin-left: 430px;
}
.diff{
	font-size: 1.5em;
	background-color: chartreuse;
}
i{
	font-size: 40px;
	padding: 10px;
}

#colh{
	color:chartreuse;
}
</style>