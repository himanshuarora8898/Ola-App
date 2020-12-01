<?php

require_once('sqlconfig.php');
session_start();
class user
{
    public $username,$name,$mobile,$password,$repassword,$from,$to,$baggage,$travel,$fare,$sess;

    function signup($username,$name,$mobile,$password,$repassword,$conn)
    {
        if ($password != $repassword)
        {
            echo "<center><h2 style='color:white;'>Password doesn't match</h2></center>";
            return;
        }
        $sql1 = "SELECT * from users WHERE user_name='" . $username . "'
    OR name='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {
           echo "<center><h2 style='color:white;'>Username already present</h2></center>";

        }
        else
        {
            $sql = "INSERT INTO users (user_name,name, date_of_signup,mobile,isblock, password, isadmin   ) 
        VALUES('$username' ,'$name',current_timestamp(),'$mobile',0, MD5('$password'), 0)";
            if ($conn->query($sql) === true)
            {
                header("Location: login.php");
            }
            else
            {
                echo "DB Error";
            }

            $conn->close();
        }

    }
    function sorting($a,$filter,$conn){
        if($filter==7){
         $sql="SELECT * FROM users
         ORDER BY `date_of_signup` DESC
         LIMIT 0, 7";
         $result=$conn->query($sql);
         if ($result->num_rows > 0) {
            
             while ($row= $result->fetch_assoc()) {
                 $a.='<td>'.$row['user_id'].'</td>';
                 $a.='<td>'.$row['name'].'</td>';
                 $a.='<td>'.$row['mobile'].'</td>';
                 $a.='<td>'.$row['date_of_signup'].'</td>';
                 $a.='<td>'.$row['user_name'].'</td></tr>';
             }
             $a.='</table>';
             echo $a;
         }
        }
        if($filter==30){
            $sql="SELECT * FROM users
            ORDER BY `date_of_signup` DESC
            LIMIT 0, 30";
            $result=$conn->query($sql);
            if ($result->num_rows > 0) {
               
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['user_id'].'</td>';
                    $a.='<td>'.$row['name'].'</td>';
                    $a.='<td>'.$row['mobile'].'</td>';
                    $a.='<td>'.$row['date_of_signup'].'</td>';
                    $a.='<td>'.$row['user_name'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }
           }
        if($filter==1){
     
         $sql="SELECT * FROM rides
         ORDER BY `total_fare` DESC ";
         $result=$conn->query($sql);
         if ($result->num_rows > 0) {
            
             while ($row= $result->fetch_assoc()) {
                 $a.='<td>'.$row['ride_id'].'</td>';
                 $a.='<td>'.$row['ride_date'].'</td>';
                 $a.='<td>'.$row['pick'].'</td>';
                 $a.='<td>'.$row['drop_location'].'</td>';
                 $a.='<td>'.$row['total_distance'].'</td>';
                 $a.='<td>'.$row['total_fare'].'</td>';
                 $a.='<td>'.$row['luggage'].'</td></tr>';
             }
             $a.='</table>';
             echo $a;
         }
     
        }
        if($filter=='name'){
         $sql="SELECT * FROM users WHERE `isadmin`='1'
         ORDER BY `name` DESC 
         LIMIT 0, 7";
         $result=$conn->query($sql);
         if ($result->num_rows > 0) {
            
             while ($row= $result->fetch_assoc()) {
                 $a.='<td>'.$row['user_id'].'</td>';
                 $a.='<td>'.$row['name'].'</td>';
                 $a.='<td>'.$row['mobile'].'</td>';
                 $a.='<td>'.$row['date_of_signup'].'</td>';
                 $a.='<td>'.$row['user_name'].'</td></tr>';
             }
             $a.='</table>';
             echo $a;
         }
     
        }
     
        if($filter=='fare'){
     
            $sql="SELECT * FROM rides
            ORDER BY `total_fare` DESC ";
            $result=$conn->query($sql);
            if ($result->num_rows > 0) {
               
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }
        
           }
           if($filter=='date'){
     
            $sql="SELECT * FROM rides
            ORDER BY `ride_date` DESC ";
            $result=$conn->query($sql);
            if ($result->num_rows > 0) {
               
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }
        
           }
    }   

    function fetchuser($conn){
         $name=$_SESSION['userdata']['username'];
         $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
         $result=$conn->query($sql1);
         if ($result->num_rows > 0) {
       
            while ($row= $result->fetch_assoc()) {
    
              $abc=$row['user_id'];
            }
        }
        $sql="SELECT COUNT(user_id) As Total from users WHERE `isadmin`='0' "; 
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo $row['Total'];
    }
    function fetchearning($conn){
        $sql="SELECT SUM(total_fare) As Total from rides"; 
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ('₹'.$row['Total']);
    }

    function fetch_pending_user($conn){
         $name=$_SESSION['userdata']['username'];
         $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
         $result=$conn->query($sql1);
         if ($result->num_rows > 0) {
       
            while ($row= $result->fetch_assoc()) {
    
              $abc=$row['user_id'];
            }
        }
        $sql="SELECT COUNT(user_id) As Total from users WHERE `isadmin`='0' AND `isblock`='0'  ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ($row['Total']);
    }

    function fetch_pending_ride($conn){
        $sql="SELECT COUNT(ride_id) As Total from rides WHERE `status`='1'  ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ($row['Total']);
    }
    function fetch_approved_ride($conn){
        $sql="SELECT COUNT(ride_id) As Total from rides WHERE `status`='2'  ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ($row['Total']);
    }
    function fetch_cancelled_ride($conn){
        $sql="SELECT COUNT(ride_id) As Total from rides WHERE `status`='0'  ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ($row['Total']);
    }
    function fetchuser_rides($conn){
        $name=$_SESSION['userdata']['username'];
         $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
         $result=$conn->query($sql1);
         if ($result->num_rows > 0) {
       
            while ($row= $result->fetch_assoc()) {
    
              $abc=$row['user_id'];
            }
        }
        $sql="SELECT COUNT(ride_id) As Total from rides WHERE customer_user_id='".$abc."'  ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ($row['Total']);
    }
    function fetchuser_expense($conn){
       $name=$_SESSION['userdata']['username'];
         $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
         $result=$conn->query($sql1);
         if ($result->num_rows > 0) {
       
            while ($row= $result->fetch_assoc()) {
    
              $abc=$row['user_id'];
            }
        }
        $sql="SELECT SUM(total_fare) As Total from rides WHERE customer_user_id='".$abc."'  ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ('₹'.$row['Total']);
    }
    function fetchuser_pending_rides($conn){
        $name=$_SESSION['userdata']['username'];
         $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
         $result=$conn->query($sql1);
         if ($result->num_rows > 0) {
       
            while ($row= $result->fetch_assoc()) {
    
              $abc=$row['user_id'];
            }
        }
        $sql="SELECT COUNT(ride_id) As Total from rides WHERE customer_user_id='".$abc."' AND status='1' ";
        $result=$conn->query($sql);
        $row= $result->fetch_assoc();
         echo ($row['Total']);
    }

    function pickup($conn){
           $sql="SELECT * from `location` WHERE `is_available`='1'";
              $result=$conn->query($sql);
              if ($result->num_rows > 0) {
              while ($row= $result->fetch_assoc()) {
              $a='<option value="'.$row['name'].'">'.$row['name'].'</option>';
              echo $a;
              }
             
            }

    }





    function login($username ,$password,$conn)
    {
        $_SESSION['conn']=$conn;
        $sess=$_SESSION['conn'];
        $count=0;
            if ($count == 0)
            {
            $sql = "SELECT * FROM users WHERE 
            user_name='$username' and password= MD5('$password')";
                $result = $conn->query($sql);

                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $_SESSION['userdata'] = array(
                            'username' => $row['user_name'],
                            'user_id' => $row['user_id']
                        );
                        if ($row['isadmin'] == '1')
                        {
                            header("Location: admin.php");
                        }
                        if ($row['isadmin'] == '0')
                        {
                            if ($row['isblock'] == '1')
                            {
                                header("Location: user.php");
                            }
                            else
                            {
                                echo "<p>Your Request is under process you will be able to login once admin approves</p>";
                            }

                        }

                    }

                }
            }
    
                else
                {
                    echo "<div>Invalid Login details</div>";
                }
                $conn->close();
    }

    function ride_detail($sess)
    {
    
        $ids='';
        

        if(isset($_SESSION['userdata']))
        {
           
            $name=$_SESSION['userdata']['username'];
           
            $sql1 ="SELECT * from users where `user_name`='".$name."'";
            $result =$sess->query($sql1);
            if ($result->num_rows > 0) {
                   
                    while ($row= $result->fetch_assoc()) {

                      $ids=$row['user_id'];
                    }
            }
              
            if($_SESSION['ride']['cab']=='CedMicro'){
                $_SESSION['baggage']=0;
             }
                
            $sql2="INSERT INTO rides ( `ride_date`, `pick`, `drop_location`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) 
            VALUES ( current_timestamp(),'".$_SESSION['ride']['from']."', '".$_SESSION['ride']['to']."', '".$_SESSION['ride']['travel']."', '".$_SESSION['ride']['baggage']."','".$_SESSION['ride']['fare']."', 1, '".$ids."')";
            if ($sess->query($sql2) === TRUE) 
            {
              // echo "New record created successfully";
            } 
            else 
            {
              echo "Error: " .$sess->error;
            }




            }    
    }
    function userrides($page, $conn)
    {
        if($page==1){
            $ids='';
            $name=$_SESSION['userdata']['username'];
            $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
            
            $result=$conn->query($sql1);
            
            if ($result->num_rows > 0) {
               
                while ($row= $result->fetch_assoc()) {

                  $ids=$row['user_id'];
                }
            }
            $sql="SELECT * from rides WHERE customer_user_id='".$ids."' AND status='1' ";
            $result=$conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<center><h2>Pending user rides</h2></center><center>";
                $a= "<table><tr><th>Ride id</th><th>Ride date</th><th>Pickup Location</th><th>Drop Location</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th></tr><tr>";
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }

        }


        if($page==2){
            $ids='';
            $name=$_SESSION['userdata']['username'];
            $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
            
            $result=$conn->query($sql1);
            
            if ($result->num_rows > 0) {
               
                while ($row= $result->fetch_assoc()) {

                  $ids=$row['user_id'];
                }
            }
            $sql="SELECT * from rides WHERE customer_user_id='".$ids."' AND status='2' ";
            $result=$conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<center><h2>Completed user rides</h2></center><center>";
                $a= "<table><tr><th>Ride id</th><th>Ride date</th><th>Pickup Location</th><th>Drop Location</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th></tr><tr>";
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }

        }


        if($page==3)
        {
            $ids='';
            $name=$_SESSION['userdata']['username'];
            $sql1="SELECT * FROM users WHERE `user_name`='".$name."'";
            
            $result=$conn->query($sql1);
            
            if ($result->num_rows > 0) {
               
                while ($row= $result->fetch_assoc()) {

                  $ids=$row['user_id'];
                }
            }
            $sql="SELECT * from rides WHERE customer_user_id='".$ids."' ";
            $result=$conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<center><h2>Completed user rides</h2></center><center>";
                $a= "<table><tr><th>Ride id</th><th>Ride date</th><th>Pickup Location</th><th>Drop Location</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th></tr><tr>";
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }

        }
   
            if($page==4){
                $a='<form action="" method="POST"><div><label for ="Username"><h3>Username</h3></label><input type ="text" id="Username" class="Username" name="username"><label for ="name"><h3>Name</h3></label><input type ="text" id="name" class="name" name="name"> <label for ="mobile"><h3>Mobile</h3></label><input type ="text" name="mobile" id="mobile" class="mobile"><br><input type="submit" class="btn" name="submit" value="Update Details"></div></form>';
                echo $a;
                if(isset($_POST['submit'])){
                    $phone=isset($_POST['mobile'])?$_POST['mobile']:'';
                    $name=isset($_POST['name'])?$_POST['name']:'';
                    $username=isset($_POST['username'])?$_POST['username']:'';
                
                    if($_SESSION['userdata']['username']==$username){
                        
                    $sql="UPDATE users
                     SET  `mobile`='".$phone."',`name`='".$name."' Where `user_name`='".$username."'";
                     echo $sql;
                     $result=$conn->query($sql);
                    }
                }    
            }

            if($page==5){
                $a='<form action="" method="POST"><div><label for ="oldpassword"><h3>Enter old password</h3></label><input type ="text" id="oldpassword" class="oldpassword" name="oldpassword"><label for ="newpassword"><h3>Enter new password</h3></label><input type ="text" id="newpassword" class="newpassword" name="newpassword"><br><input type="submit" class="btn" name="submit" value="Change Password"></div></form>';
                echo $a;
                if(isset($_POST['submit'])){
                    $old=isset($_POST['oldpassword'])?$_POST['oldpassword']:'';
                    $new=isset($_POST['newpassword'])?$_POST['newpassword']:'';    
                    $sql="UPDATE users
                    SET  `password`='".md5($new)."' Where `user_name`='".$username."'";
                    echo $sql;
                    $result=$conn->query($sql);
                   
                }  

            }
    }
}
class admin{
    function ridereq($page,$conn)
    {
        if($page==1){
            echo "<center><h2>Pending Ride Request</h2></center><br><center>";
            $a= "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th><th>Action</th><th>Action</th></tr><tr>";

            $sql1="SELECT * from rides WHERE status='1'";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td>';
                    $a.='<td>'.$row['customer_user_id'].'</td>';
               
                    $a.='<td><a href="rideapprove.php?id='.$row['ride_id'].'">Allow</a></td>';
                    $a.='<td><a href="ridecancel.php?id='.$row['ride_id'].'">Cancel</a></td></tr>';
                    



                }
                $a.='</table>';
                echo $a;
            }

        }

        if($page==2){
            echo "<center><h2>Completed Ride</h2></center><br><center>";
            $a= "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th><th>Action</th></tr><tr>";

            $sql1="SELECT * from rides WHERE status='2'";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td>';
                    $a.='<td>'.$row['customer_user_id'].'</td>';
               
                    $a.='<td><a href="rideapprove.php?id='.$row['ride_id'].'">Disallow</a></td></tr>';
                    


                }
                $a.='</table>';
                echo $a;
            }

        }

        if($page==3){
            echo "<center><h2>Cancelled Ride Request</h2></center><br><center>";
            $a= "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th></tr><tr>";

            $sql1="SELECT * from rides WHERE status='0'";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td>';
                    $a.='<td>'.$row['customer_user_id'].'</td></tr>';
               
                  
                    


                }
                $a.='</table>';
                echo $a;
            }

        }

        if($page==4){
            echo "<center><h2>Ride Request</h2></center><br><center>";
            $a= "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th></tr><tr>";

            $sql1="SELECT * from rides";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['ride_id'].'</td>';
                    $a.='<td>'.$row['ride_date'].'</td>';
                    $a.='<td>'.$row['pick'].'</td>';
                    $a.='<td>'.$row['drop_location'].'</td>';
                    $a.='<td>'.$row['total_distance'].'</td>';
                    $a.='<td>'.$row['luggage'].'</td>';
                    $a.='<td>'.$row['total_fare'].'</td>';
                    $a.='<td>'.$row['status'].'</td>';
                    $a.='<td>'.$row['customer_user_id'].'</td></tr>';
               
                  
                    


                }
                $a.='</table>';
                echo $a;
            }

        }







        
    }


    function requests($page,$conn)
    {
        if($page==5){
            echo "<center><h2> Pending User Request</h2></center><br><center>";
            $a= "<table><tr><th>Name</th><th>User-Name</th><th>User-id</th><th>Contact</th><th>Block-status</th><th>Action</th></tr><tr>";

            $sql1="SELECT * from `users` WHERE `isblock`='0'";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['name'].'</td>';
                    $a.='<td>'.$row['user_name'].'</td>';
                    $a.='<td>'.$row['user_id'].'</td>';
                    $a.='<td>'.$row['mobile'].'</td>';
                    $a.='<td>'.$row['isblock'].'</td>';
               
                    $a.='<td><a href="loginapprove.php?id='.$row['user_id'].'">Toggle</a></td></tr>';
                    


                }
                $a.='</table>';
                echo $a;
            }  
        }
        if($page==6){
            echo "<center><h2> Approved User Request</h2></center><br><center>";
            $a= "<table><tr><th>Name</th><th>User-Name</th><th>User-id</th><th>Contact</th><th>Block-status</th><th>Action</th></tr><tr>";

            $sql1="SELECT * from users WHERE isblock='1'";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['name'].'</td>';
                    $a.='<td>'.$row['user_name'].'</td>';
                    $a.='<td>'.$row['user_id'].'</td>';
                    $a.='<td>'.$row['mobile'].'</td>';
                    $a.='<td>'.$row['isblock'].'</td>';
               
                    $a.='<td><a href="loginapprove.php?id='.$row['user_id'].'">Toggle</a></td></tr>';
                    


                }
                $a.='</table>';
                echo $a;
            }  
        }
        if($page==7){
            echo "<center><h2>All User</h2></center><br><center>";
            $a= "<table><tr><th>Name</th><th>User-Name</th><th>User-id</th><th>Contact</th><th>Block-status</th></tr><tr>";

            $sql1="SELECT * from users where isadmin=0";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['name'].'</td>';
                    $a.='<td>'.$row['user_name'].'</td>';
                    $a.='<td>'.$row['user_id'].'</td>';
                    $a.='<td>'.$row['mobile'].'</td>';
                    $a.='<td>'.$row['isblock'].'</td></tr>';
               
                    
                    


                }
                $a.='</table>';
                echo $a;
            }  
        }








    }


    function location($page,$conn)
    {
        if($page==8){
            echo "<center><h2>Location List</h2></center><br><center>";
            $a= "<table><tr><th>ID</th><th>Name</th><th>Distance</th><th>Available</th></tr><tr>";

            $sql1="SELECT * from location ";
            $result=$conn->query($sql1);
            if ($result->num_rows > 0) {
                while ($row= $result->fetch_assoc()) {
                    $a.='<td>'.$row['id'].'</td>';
                    $a.='<td>'.$row['name'].'</td>';
                    $a.='<td>'.$row['distance'].'</td>';
                    $a.='<td>'.$row['is_available'].'</td></tr>';
                }
                $a.='</table>';
                echo $a;
            }  
        }
        
        if($page==9){
            $a='<form action="" method="POST"><div><label for ="Enter-Location"><h3>Location</h3></label><input type ="text" id="Enter-Location" class="Enter-Location" name="location"> <label for ="Enter-distance"><h3>Enter-distance</h3></label><input type ="text" name="distance" id="Enter-distance" class="Enter-distance"><br><input type="submit" class="btn" name="submit" value="Add-location"></div></form>';
            echo $a;
            if(isset($_POST['submit'])){
                $d= $_POST['location'];
                $l=$_POST['distance'];
                $sql="INSERT INTO `location` (`name`, `distance`, `is_available`) VALUES ('".$d."', '".$l."', 1);";
                $result=$conn->query($sql);
                echo "New Location addded successfully";

            } 
        }
        if($page==10){
                $a='<form action="" method="POST"><div><label for ="oldpassword"><h3>Enter old password</h3></label><input type ="text" id="oldpassword" class="oldpassword" name="oldpassword"><label for ="newpassword"><h3>Enter new password</h3></label><input type ="text" id="newpassword" class="newpassword" name="newpassword"><br><input type="submit" class="btn" name="submit" value="Change Password"></div></form>';
                echo $a;
                if(isset($_POST['submit'])){
                    $old=isset($_POST['oldpassword'])?$_POST['oldpassword']:'';
                    $new=isset($_POST['newpassword'])?$_POST['newpassword']:'';    
                    $sql="UPDATE users
                    SET  `password`='".md5($new)."' Where `user_name`='".$_SESSION['userdata']['username']."'";
                    echo "Password Changed..!";
                    $result=$conn->query($sql);
                   
                }  

            }




    }




    function approve($upd,$conn)
    {
    $sql="SELECT * from users WHERE user_id='".$upd."'";
    $result=$conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row= $result->fetch_assoc()) {
    if($row['isblock']==0){
    $sql1="UPDATE users SET isblock= '1'  WHERE user_id='".$upd."' ";
    $result=$conn->query($sql1);
    header("Location:request.php");
    }
    else{
    $sql1="UPDATE users SET isblock= '0'  WHERE user_id='".$upd."' ";
    $result=$conn->query($sql1);
    header("Location:request.php");
    }

    }
    }        


    }



    function rideapprove($upd,$conn)
    {
        $sql;
        $result;
        $sql1;
        $row;
        $sql="SELECT * from rides WHERE ride_id='".$upd."'";
        $result=$conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row= $result->fetch_assoc()) {
        if($row['status']==1){
        $sql1="UPDATE rides SET status= '2'  WHERE ride_id='".$upd."' ";
        $result=$conn->query($sql1);
        header("Location:admin.php?id=1");
        }
        if($row['status']==2){
        $sql1="UPDATE rides SET status= '1'  WHERE ride_id='".$upd."' ";
        $result=$conn->query($sql1);
        header("Location:admin.php?id=2");
        }


        }
        }        


    }

    function ridecancel($upd,$conn)
    {
        $sql="UPDATE rides SET status= '0'  WHERE ride_id='".$upd."' ";
        $result=$conn->query($sql);
        header("Location:ridereq.php");


    }


}
?>