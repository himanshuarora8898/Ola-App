<?php 
include('sqlconfig.php');
include('class.php');

$obj = new DBCon();
$obj2=new user();
if (isset($_POST['submit'])) {
    $username = isset($_POST['username'])?$_POST['username']:'';
    $name = isset($_POST['name'])?$_POST['name']:'';
    $mobile = isset($_POST['phone'])?$_POST['phone']:'';
    $password = isset($_POST['password'])?$_POST['password']:'';
    $repassword = isset($_POST['repassword'])?$_POST['repassword']:'';
    $obj2->signup($username ,$name, $mobile, $password, $repassword, $obj->conn);
}   
?>
<html>
<head>
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


    </script>
</head>
<body>
    <div id="errors">
      
    </div>
    <center>
    <div id="wrapper">
        <div id="signup-form">
            <h2>Sign Up</h2>
            <form action="signup.php" method="POST">
                <p>
                    <label for="username">Username: <input type="text"
                     name="username" required></label>
                </p>
                <p>
                    <label for="name">Name: <input type="text"
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
            <h3>Already a user?<span><a href="login.php" id="log">Login</a></span></h3>
        </div>
    </div>
    </center>
</body>
</html>