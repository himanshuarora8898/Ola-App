<?php
include ('sqlconfig.php');
include ('class.php');

$obj = new DBCon();
$obj2 = new user();
if (isset($_POST['submit']))
{
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $mobile = isset($_POST['phone']) ? $_POST['phone'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';
    $obj2->signup($username, $name, $mobile, $password, $repassword, $obj->conn);
}
?>
<html>
<head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>
        Register
    </title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <script type="text/javascript">
        function onlynum(button){
    var code = button.which;
    if (code > 31 && (code < 48 || code > 57)) 
        return false; 
    return true; 
}
function alphaonly(button) { 
  console.log(button.which);
        var code = button.which;
        if ((code > 64 && code < 91) || (code < 123 && code > 96)|| (code==08)) 
            return true; 
        return false; 
    } 

function alphaonlyuser(button) { 
  console.log(button.which);
        var code = button.which;
        if (code==32)
            return false; 
        return true; 
    }     

    </script>
</head>
<body>
    <header> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a href="#" class="navbar-brand pl-5"><span class="bg-dark text-white diff">Ced</span><span class="text-white diff">Cab</span></a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar_menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar_menu">
            <ul class="navbar-nav ml-auto">
              
              <li class="nav-item">
                <a href="index.php" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="login.php" class="nav-link">Login</a>
              </li>
            </ul>
          </div>     
        </nav>
      </header> 
    <center>
    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <form action="signup.php" method="POST">
                <p>
                    <label for="username" onkeypress="return alphaonlyuser(event)">Username: <input type="text"
                     name="username" required></label>
                </p>
                <p>
                    <label for="name" onkeypress="return alphaonly(event)">Name: <input type="text"
                     name="name" required></label>
                </p>
                <p>
                   <label for="phone" onkeypress="return onlynum(event)">Mobile:<input type="tel" id="phone" name="phone" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password"
                     name="password" required></label>
                </p>
                <p>
                    <label for="password2">Re-Password: <input type="password"
                     name="repassword" required></label>
                </p>
                <p>
                    <input type="submit" name="submit" id="sign" value="Sign Up">
                </p>
            </form>
            
        </div>
    </div>
    </center>
    <footer>
         <div>
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
