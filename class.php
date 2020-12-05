<?php
require_once ('sqlconfig.php');
session_start();
class user
{
    public $username, $name, $mobile, $password, $repassword, $from, $to, $baggage, $travel, $fare, $sess;

    function signup($username, $name, $mobile, $password, $repassword, $conn)
    {

        if ($password != $repassword)
        {
            echo "<center><h2 style='color:white;font-size:20px;background-color:lightblue;'>Password doesn't match</h2></center>";
            return;
        }
        $sql1 = "SELECT * from users WHERE user_name='" . $username . "'
    OR name='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {
            echo "<center><h2 style='color:white;font-size:20px;background-color:lightblue;'>Username already present</h2></center>";

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
    function login($username, $password, $conn)
    {
        $_SESSION['conn'] = $conn;
        $sess = $_SESSION['conn'];
        $count = 0;
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
                }

                if ($row['isadmin'] == '1')
                {
                    header("Location: admin.php?id=12");
                }
                if ($row['isadmin'] == '0')
                {
                    if ($row['isblock'] == '1')
                    {
                        header("Location: user.php?id=7");
                    }
                    else
                    {
                        echo "<center><p style='color:white;font-size:20px;background-color:lightblue;' >Your Request is under process you will be able to login once admin approves</p></center>";
                    }

                }
            }
            else
            {
                echo "<center><p style='color:white;
                        background-color:lightblue;font-size:20px;' >Invalid username or password</p></center>";
            }
        }
        $conn->close();
    }

    function sorting($a, $filter, $conn)
    {
        if ($filter == 7)
        {
            $sql = "SELECT * FROM users
         ORDER BY `date_of_signup` DESC
         LIMIT 0, 7";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['date_of_signup'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 30)
        {
            $sql = "SELECT * FROM users
            ORDER BY `date_of_signup` DESC
            LIMIT 0, 30";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['date_of_signup'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 1)
        {

            $sql = "SELECT * FROM rides
         ORDER BY `total_fare` DESC ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'name')
        {
            $sql = "SELECT * FROM users WHERE `isadmin`='1'
         ORDER BY `name` DESC 
         LIMIT 0, 7";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['date_of_signup'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($filter == 'fare')
        {

            $sql = "SELECT * FROM rides
            ORDER BY `total_fare` DESC ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'date')
        {

            $sql = "SELECT * FROM rides
            ORDER BY `ride_date` DESC ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
    }

    function fetchuser($conn)
    {
        $name = $_SESSION['userdata']['username'];
        $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {

            while ($row = $result->fetch_assoc())
            {

                $abc = $row['user_id'];
            }
        }
        $sql = "SELECT COUNT(user_id) As Total from users WHERE `isadmin`='0' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo $row['Total'];
    }
    function fetchearning($conn)
    {
        $sql = "SELECT SUM(total_fare) As Total from rides";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ('₹' . $row['Total']);
    }

    function fetch_pending_user($conn)
    {
        $name = $_SESSION['userdata']['username'];
        $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {

            while ($row = $result->fetch_assoc())
            {

                $abc = $row['user_id'];
            }
        }
        $sql = "SELECT COUNT(user_id) As Total from users WHERE `isadmin`='0' AND `isblock`='0'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ($row['Total']);
    }

    function fetch_pending_ride($conn)
    {
        $sql = "SELECT COUNT(ride_id) As Total from rides WHERE `status`='1'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ($row['Total']);
    }
    function fetch_approved_ride($conn)
    {
        $sql = "SELECT COUNT(ride_id) As Total from rides WHERE `status`='2'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ($row['Total']);
    }
    function fetch_cancelled_ride($conn)
    {
        $sql = "SELECT COUNT(ride_id) As Total from rides WHERE `status`='0'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ($row['Total']);
    }
    function fetchuser_rides($conn)
    {
        $name = $_SESSION['userdata']['username'];
        $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {

            while ($row = $result->fetch_assoc())
            {

                $abc = $row['user_id'];
            }
        }
        $sql = "SELECT COUNT(ride_id) As Total from rides WHERE customer_user_id='" . $abc . "'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ($row['Total']);
    }
    function fetchuser_expense($conn)
    {
        $name = $_SESSION['userdata']['username'];
        $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {

            while ($row = $result->fetch_assoc())
            {

                $abc = $row['user_id'];
            }
        }
        $sql = "SELECT SUM(total_fare) As Total from rides WHERE customer_user_id='" . $abc . "'  ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ('₹' . $row['Total']);
    }
    function fetchuser_pending_rides($conn)
    {
        $name = $_SESSION['userdata']['username'];
        $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";
        $result = $conn->query($sql1);
        if ($result->num_rows > 0)
        {

            while ($row = $result->fetch_assoc())
            {

                $abc = $row['user_id'];
            }
        }
        $sql = "SELECT COUNT(ride_id) As Total from rides WHERE customer_user_id='" . $abc . "' AND status='1' ";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        echo ($row['Total']);
    }

    function pickup($conn)
    {
        $sql = "SELECT * from `location` WHERE `is_available`='1'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                $a = '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                echo $a;
            }

        }

    }

    function filterrr($a, $m, $filter, $conn)
    {
        $abc = '';
        $name = $_SESSION['userdata']['username'];
        $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";

        $result = $conn->query($sql1);

        if ($result->num_rows > 0)
        {

            while ($row = $result->fetch_assoc())
            {

                $abc = $row['user_id'];
            }
        }
        if ($filter == 'mini')
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `customer_user_id`='" . $abc . "' AND `cab_type`='CedMini'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "' ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "' ORDER BY total_fare DESC
LIMIT 0, 7";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>CedMini</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 'micro')
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "' 
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "' 
ORDER BY total_fare DESC
LIMIT 0, 7";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>CedMicro</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }

        if ($filter == 'suv')
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM ride WHERE `customer_user_id`='" . $abc . "' 
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "' 
ORDER BY total_fare DESC
LIMIT 0, 7";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>CedSuv</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 'royal')
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `customer_user_id`='" . $abc . "' 
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "' 
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>CedRoyal</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 7)
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 7";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 30)
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 30";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 30";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare DESC
LIMIT 0, 30";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($filter == 1)
        {
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `customer_user_id`='" . $abc . "'
ORDER BY total_fare ASC ";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare ASC ";

            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1' AND `customer_user_id`='" . $abc . "'
ORDER BY total_fare ASC ";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'name')
        {
            if ($m == 7)
            {
                $sql = "SELECT * FROM users WHERE `isadmin`='0'
ORDER BY `name` DESC
LIMIT 0, 7";
            }
            if ($m == 6)
            {
                $sql = "SELECT * FROM users WHERE `isadmin`='0' AND `isblock`='1'
ORDER BY `name` DESC
LIMIT 0, 7";
            }
            if ($m == 5)
            {
                $sql = "SELECT * FROM users WHERE `isadmin`='0' AND `isblock`='0'
ORDER BY `name` DESC
LIMIT 0, 7";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['date_of_signup'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'dist')
        {
            if ($m == 4)
            {
                $sql = "SELECT * FROM rides
ORDER BY total_distance ASC ";
            }

            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2'
ORDER BY total_distance ASC ";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1'
ORDER BY total_distance ASC ";
            }
            if ($m == 3)
            {
                $sql = "SELECT * FROM ride WHERE `status`='0'
ORDER BY total_distance ASC ";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'distance')
        {
            if ($m == 4)
            {
                $sql = "SELECT * FROM rides
ORDER BY total_distance ASC ";
            }

            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2'
ORDER BY total_distance ASC ";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1'
ORDER BY total_distance ASC ";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'fare')
        {
            if ($m == 4)
            {
                $sql = "SELECT * FROM rides
ORDER BY total_fare ASC ";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2'
ORDER BY total_fare ASC ";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1'
ORDER BY total_fare ASC ";
            }
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `status`='0'
ORDER BY total_fare ASC ";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }
        if ($filter == 'date')
        {
            if ($m == 4)
            {
                $sql = "SELECT * FROM rides
ORDER BY total_fare DESC ";
            }
            if ($m == 2)
            {
                $sql = "SELECT * FROM rides WHERE `status`='2'
ORDER BY total_fare DESC ";
            }
            if ($m == 1)
            {
                $sql = "SELECT * FROM rides WHERE `status`='1'
ORDER BY total_fare DESC ";
            }
            if ($m == 3)
            {
                $sql = "SELECT * FROM rides WHERE `status`='0'
ORDER BY total_fare DESC ";
            }

            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }

    }

    function ride_detail($sess)
    {

        $ids = '';

        if (isset($_SESSION['userdata']))
        {

            $name = $_SESSION['userdata']['username'];

            $sql1 = "SELECT * from users where `user_name`='" . $name . "'";
            $result = $sess->query($sql1);
            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {

                    $ids = $row['user_id'];
                }
            }

            if ($_SESSION['ride']['cab'] == 'CedMicro')
            {
                $_SESSION['baggage'] = 0;
            }

            $sql2 = "INSERT INTO rides ( `ride_date`, `pick`, `drop_location`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) 
            VALUES ( current_timestamp(),'" . $_SESSION['ride']['from'] . "', '" . $_SESSION['ride']['to'] . "', '" . $_SESSION['ride']['travel'] . "', '" . $_SESSION['ride']['baggage'] . "','" . $_SESSION['ride']['fare'] . "', 1, '" . $ids . "')";
            if ($sess->query($sql2) === true)
            {
                // echo "New record created successfully";
                
            }
            else
            {
                echo "Error: " . $sess->error;
            }

        }
    }
    function userrides($page, $conn)
    {

        if ($page == 1)
        {
            echo '<h3 style="color:blue;">Status-1=Pending</h3>';
            echo '<h3 style="color:blue;">Status-2=Completed</h3>';
            echo '<h3 style="color:blue;">Status-0=Cancelled</h3>';
            $ids = '';
            $name = $_SESSION['userdata']['username'];
            $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";

            $result = $conn->query($sql1);

            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {

                    $ids = $row['user_id'];
                }
            }
            $sql = "SELECT * from rides WHERE customer_user_id='" . $ids . "' AND status='1' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                echo "<center><h2>Pending user rides</h2></center><center>";
                $a = "<table><tr><th>Ride id</th><th>Ride date</th><th>Pickup Location</th><th>Drop Location</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th></tr><tr>";
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($page == 2)
        {
            echo '<h3 style="color:blue;">Status-1=Pending</h3>';
            echo '<h3 style="color:blue;">Status-2=Completed</h3>';
            echo '<h3 style="color:blue;">Status-0=Cancelled</h3>';
            $ids = '';
            $name = $_SESSION['userdata']['username'];
            $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";

            $result = $conn->query($sql1);

            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {

                    $ids = $row['user_id'];
                }
            }
            $sql = "SELECT * from rides WHERE customer_user_id='" . $ids . "' AND status='2' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                echo "<center><h2>Completed user rides</h2></center><center>";
                $a = "<table><tr><th>Ride id</th><th>Ride date</th><th>Pickup Location</th><th>Drop Location</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>Action</th></tr><tr>";
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td>';
                    $a .= '<td><a href="invoice.php?id=' . $row['ride_id'] . '">Get Invoice</a></td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($page == 3)
        {
            echo '<h3 style="color:blue;">Status-1=Pending</h3>';
            echo '<h3 style="color:blue;">Status-2=Completed</h3>';
            echo '<h3 style="color:blue;">Status-0=Cancelled</h3>';
            $ids = '';
            $name = $_SESSION['userdata']['username'];
            $sql1 = "SELECT * FROM users WHERE `user_name`='" . $name . "'";

            $result = $conn->query($sql1);

            if ($result->num_rows > 0)
            {

                while ($row = $result->fetch_assoc())
                {

                    $ids = $row['user_id'];
                }
            }
            $sql = "SELECT * from rides WHERE customer_user_id='" . $ids . "' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                echo "<center><h2>Completed user rides</h2></center><center>";
                $a = "<table><tr><th>Ride id</th><th>Ride date</th><th>Pickup Location</th><th>Drop Location</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th></tr><tr>";
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td></tr>';
                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($page == 4)
        {
            $sql = "SELECT * from users where user_name='" . $_SESSION["userdata"]["username"] . "' ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $_SESSION['userdata']['mob'] = $row['mobile'];
                    $_SESSION['userdata']['name'] = $row['name'];
                }
            }
            $mob = $_SESSION['userdata']['mob'];
            $a = '<form action="" method="POST"><div><label for ="Username"><h3>Username</h3></label><input type ="text" id="Username" class="Username" placeholder="' . $_SESSION['userdata']['username'] . '" name="username" disabled><br><label for ="name" ><h3>Name</h3></label><input onkeypress="return alphaonly(event)" type ="text" id="name"  placeholder="' . $_SESSION['userdata']['name'] . '" class="name" name="name"><br> <label for ="mobile"><h3>Mobile</h3></label><input onkeypress="return onlynum(event)" type ="text" placeholder="' . $mob . '" name="mobile" id="mobile" class="mobile"><br><input type="submit" class="btn" name="submit" value="Update Details"></div></form>';
            echo $a;
            if (isset($_POST['submit']))
            {
                $phone = isset($_POST['mobile']) ? $_POST['mobile'] : '';
                $name = isset($_POST['name']) ? $_POST['name'] : '';
                $username = isset($_POST['username']) ? $_POST['username'] : '';

                if ($_SESSION['userdata']['username'] == $username)
                {

                    $sql = "UPDATE users
                     SET  `mobile`='" . $phone . "',`name`='" . $name . "' Where `user_name`='" . $username . "'";
                    echo $sql;
                    $result = $conn->query($sql);
                }
            }
        }

        if ($page == 5)
        {
            $a = '<form action="" method="POST"><div><label for ="oldpassword"><h3>Enter old password</h3></label><input type ="text" id="oldpassword" class="oldpassword" name="oldpassword"><br><label for ="newpassword"><h3>Enter new password</h3></label><input type ="text" id="newpassword" class="newpassword" name="newpassword"><br><input type="submit" class="btn" name="submit" value="Change Password"></div></form>';
            echo $a;
            if (isset($_POST['submit']))
            {
                $old = isset($_POST['oldpassword']) ? $_POST['oldpassword'] : '';
                $new = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';
                if ($old != $new)
                {
                    $sql = "UPDATE users
                        SET  `password`='" . md5($new) . "' Where `user_name`='" . $username . "'";
                    echo $sql;
                    $result = $conn->query($sql);
                }
                else
                {
                    echo "<center><p>New password is same as old password</p></center>";
                }

            }

        }
    }

    function invoice($ids, $conn)
    {
        $sql = "SELECT *from rides where ride_id='" . $ids . "' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            echo "<center><h2>Ride Invoice</h2></center><center>";
            $a = "<table>";
            while ($row = $result->fetch_assoc())
            {
                $a .= '<tr><th>Username</th><td>' . $_SESSION['userdata']['username'] . '</td></tr>';
                $a .= '<tr><th>Ride id</th><td>' . $row['ride_id'] . '</td></tr>';
                $a .= '<tr><th>Ride date</th><td>' . $row['ride_date'] . '</td></tr>';
                $a .= '<tr><th>Pickup Location</th><td>' . $row['pick'] . '</td></tr>';
                $a .= '<tr><th>Drop Location</th><td>' . $row['drop_location'] . '</td></tr>';
                $a .= '<tr><th>Distance</th><td>' . $row['total_distance'] . '</td></tr>';
                $a .= '<tr><th>Luggage</th><td>' . $row['luggage'] . '</td></tr>';
                $a .= '<tr><th>Cab Type</th><td>' . $_SESSION['ride']['cab'] . '</td></tr>';
                $a .= '<tr><th>Total Fare</th><td>' . $row['total_fare'] . '</td></tr>';
                $a .= '<tr><th>Tax</th><td>50</td></tr>';
                $sum = $row['total_fare'] + 50;
                $a .= '<tr><th>Sub Total</th><td>' . $sum . '</td></tr>';
                $a .= '<tr><th>Action</th><td><a href="#" class="inv" onclick="javascript:window.print()">Print</a></td></tr>';
            }
            $a .= '</table>';
            echo $a;
        }

    }

}
class admin
{
    function ridereq($page, $conn)
    {
        if ($page == 1)
        {
            echo "<center><h2>Pending Ride Request</h2></center><br><center>";
            $a = "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th><th>Action</th><th>Action</th></tr><tr>";

            $sql1 = "SELECT * from rides WHERE status='1'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td>';
                    $a .= '<td>' . $row['customer_user_id'] . '</td>';

                    $a .= '<td><a style="color:green;" href="rideapprove.php?id=' . $row['ride_id'] . '">Allow</a></td>';
                    $a .= '<td><a style="color:red;" href="ridecancel.php?id=' . $row['ride_id'] . '">Cancel</a></td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($page == 2)
        {
            echo "<center><h2>Completed Ride</h2></center><br><center>";
            $a = "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th></tr><tr>";

            $sql1 = "SELECT * from rides WHERE status='2'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td>';
                    $a .= '<td>' . $row['customer_user_id'] . '</td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($page == 3)
        {
            echo "<center><h2>Cancelled Ride Request</h2></center><br><center>";
            $a = "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th></tr><tr>";

            $sql1 = "SELECT * from rides WHERE status='0'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td>';
                    $a .= '<td>' . $row['customer_user_id'] . '</td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }

        }

        if ($page == 4)
        {
            echo "<center><h2>Ride Request</h2></center><br><center>";
            $a = "<table><tr><th>Ride Id</th><th>DATE</th><th>Pick</th><th>Drop</th><th>Distance</th><th>Luggage</th><th>Total Fare</th><th>Status</th><th>User id</th></tr><tr>";

            $sql1 = "SELECT * from rides";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['ride_id'] . '</td>';
                    $a .= '<td>' . $row['ride_date'] . '</td>';
                    $a .= '<td>' . $row['pick'] . '</td>';
                    $a .= '<td>' . $row['drop_location'] . '</td>';
                    $a .= '<td>' . $row['total_distance'] . '</td>';
                    $a .= '<td>' . $row['luggage'] . '</td>';
                    $a .= '<td>' . $row['total_fare'] . '</td>';
                    $a .= '<td>' . $row['status'] . '</td>';
                    $a .= '<td>' . $row['customer_user_id'] . '</td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }

        }

    }

    function requests($page, $conn)
    {
        if ($page == 5)
        {
            echo "<center><h2> Pending User Request</h2></center><br><center>";
            $a = "<table><tr><th>Name</th><th>User-Name</th><th>User-id</th><th>Contact</th><th>Block-status</th><th>Action</th></tr><tr>";

            $sql1 = "SELECT * from `users` WHERE `isblock`='0'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td>';
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['isblock'] . '</td>';

                    $a .= '<td><a href="loginapprove.php?id=' . $row['user_id'] . '">Toggle</a></td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($page == 6)
        {
            echo "<center><h2> Approved User Request</h2></center><br><center>";
            $a = "<table><tr><th>Name</th><th>User-Name</th><th>User-id</th><th>Contact</th><th>Block-status</th><th>Action</th></tr><tr>";

            $sql1 = "SELECT * from users WHERE isblock='1'";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td>';
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['isblock'] . '</td>';

                    $a .= '<td><a href="loginapprove.php?id=' . $row['user_id'] . '">Toggle</a></td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }
        }
        if ($page == 7)
        {
            echo "<center><h2>All User</h2></center><br><center>";
            $a = "<table><tr><th>Name</th><th>User-Name</th><th>User-id</th><th>Contact</th><th>Block-status</th></tr><tr>";

            $sql1 = "SELECT * from users where isadmin=0";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['user_name'] . '</td>';
                    $a .= '<td>' . $row['user_id'] . '</td>';
                    $a .= '<td>' . $row['mobile'] . '</td>';
                    $a .= '<td>' . $row['isblock'] . '</td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }
        }

    }

    function location($page, $conn)
    {
        if ($page == 8)
        {
            echo "<center><h2>Location List</h2></center><br><center>";
            $a = "<table><tr><th>ID</th><th>Name</th><th>Distance</th><th>Available</th><th>Action</th></tr><tr>";

            $sql1 = "SELECT * from location";
            $result = $conn->query($sql1);
            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $a .= '<td>' . $row['id'] . '</td>';
                    $a .= '<td>' . $row['name'] . '</td>';
                    $a .= '<td>' . $row['distance'] . '</td>';
                    $a .= '<td>' . $row['is_available'] . '</td>';
                    $a .= '<td><a style="color:green;" href="locationdisable.php?id=' . $row['id'] . '">Change Availability</a></td></tr>';

                }
                $a .= '</table>';
                echo $a;
            }
        }

        if ($page == 9)
        {
            $a = '<form action="" method="POST"><div><label for ="Enter-Location"><h3>Location</h3></label><input onkeypress="return alphaonly(event)" type ="text" id="Enter-Location" class="Enter-Location" name="location"><br> <label for ="Enter-distance"><h3>Enter-distance</h3></label><input onkeypress="return onlynum(event)" type ="text" name="distance" id="Enter-distance" class="Enter-distance"><br><input type="submit" class="btn" name="submit" value="Add-location"></div></form>';
            echo $a;
            if (isset($_POST['submit']))
            {
                $d = $_POST['location'];
                $l = $_POST['distance'];
                $sql = "INSERT INTO `location` (`name`, `distance`, `is_available`) VALUES ('" . $d . "', '" . $l . "', 1);";
                $result = $conn->query($sql);
                echo "New Location addded successfully";

            }
        }
        if ($page == 10)
        {
            $a = '<form action="" method="POST"><div><label for ="oldpassword"><h3>Enter old password :</h3></label><input type ="text" id="oldpassword" class="oldpassword" name="oldpassword"><br><label for ="newpassword"><h3>Enter new password :</h3></label><input type ="text" id="newpassword" class="newpassword" name="newpassword"><br><input type="submit" class="btn" name="submit" value="Change Password"></div></form>';
            echo $a;
            if (isset($_POST['submit']))
            {
                $old = isset($_POST['oldpassword']) ? $_POST['oldpassword'] : '';
                $new = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';
                if ($old != $new)
                {
                    $sql = "UPDATE users
                        SET  `password`='" . md5($new) . "' Where `user_name`='" . $_SESSION['userdata']['username'] . "'";
                    echo "Password Changed..!";
                    $result = $conn->query($sql);

                }
                else
                {
                    echo "<center><p>New password is same as old password</p></center>";
                }
            }

        }

    }

    function locationdisable($upd, $conn)
    {
        $sql1 = "SELECT * from location where id='" . $upd . "'";
        $res = $conn->query($sql1);
        if ($res->num_rows > 0)
        {
            while ($row = $res->fetch_assoc())
            {
                if ($row['is_available'] == 1)
                {
                    $sql = "UPDATE location SET is_available='0' where id='" . $upd . "' ";
                    $result = $conn->query($sql);
                    header("Location:admin.php?id=8");
                }
                else
                {
                    $sql2 = "UPDATE location SET is_available='1' where id='" . $upd . "' ";
                    $result = $conn->query($sql2);
                    header("Location:admin.php?id=8");
                }
            }
        }

    }

    function approve($upd, $conn)
    {
        $sql = "SELECT * from users WHERE user_id='" . $upd . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                if ($row['isblock'] == 0)
                {
                    $sql1 = "UPDATE users SET isblock= '1'  WHERE user_id='" . $upd . "' ";
                    $result = $conn->query($sql1);
                    header("Location:admin.php?id=5");
                }
                else
                {
                    $sql1 = "UPDATE users SET isblock= '0'  WHERE user_id='" . $upd . "' ";
                    $result = $conn->query($sql1);
                    header("Location:admin.php?id=6");
                }

            }
        }

    }

    function rideapprove($upd, $conn)
    {
        $sql;
        $result;
        $sql1;
        $row;
        $sql = "SELECT * from rides WHERE ride_id='" . $upd . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                if ($row['status'] == 1)
                {
                    $sql1 = "UPDATE rides SET status= '2'  WHERE ride_id='" . $upd . "' ";
                    $result = $conn->query($sql1);
                    header("Location:admin.php?id=1");
                }

            }
        }

    }

    function ridecancel($upd, $conn)
    {
        $sql = "UPDATE rides SET status= '0'  WHERE ride_id='" . $upd . "' ";
        $result = $conn->query($sql);
        header("Location:ridereq.php");

    }

}
?>
<script>
    function alphaonly(button) { 
    console.log(button.which);
        var code = button.which;
        if ((code > 64 && code < 91) || (code < 123 && code > 96)|| (code==08)) 
            return true; 
        return false; 
    } 
    function onlynum(button){
    var code = button.which;
    if (code > 31 && (code < 48 || code > 57)) 
        return false; 
    return true; 
}
</script>
