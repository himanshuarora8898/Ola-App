<?php
include('sqlconfig.php');
include('class.php');
$obj = new DBCon();
$obj2=new user();
if (isset($_POST['submit']))
    {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $obj2->login($username ,$password ,$obj->conn);

}
?>
<html>
<head>
    <title>
        Login
    </title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <center>
    <div id="wrapper">
        <div id="login-form">
            <h2>Login</h2>
            <form action="" method="POST">
                <p>
                    <label for="username">Username: <input type="text"
                     name="username" required></label>
                </p>
                <p>
                    <label for="password">Password: <input type="password"
                     name="password" required></label>
                </p>
                <p>
                    <input id="login" type="submit" name="submit" value="Login">
                </p>
            </form>
            <h3>OR</h3>
            <p><a href="signup.php" id="sign">Sign Up</a></p>
        </div>
    </div>
    </center>
</body>
</html>
