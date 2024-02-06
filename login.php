<?php 
include("db.php"); 
error_reporting(0);

$conn = mysqli_connect("localhost", "root", "", "placement");

 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];
    
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $usertype = mysqli_real_escape_string($conn, $usertype);

    $query = "SELECT * FROM signup WHERE email='$email' AND password='$password' AND usertype='$usertype'";
    $result = mysqli_query($conn, $query);

    if ( mysqli_num_rows($result) > 0 )
    {
        echo "login successful";
        if($usertype === 'Student')
        {   
            header("Location: studenthome.html");
            echo "Student login successfull";
        }
        else if($usertype === "Faculty")
        {
            header("Location: home.html");
            echo "Faculty login successfull";
        }
        else
        {
            echo "Invalid usertype";
        }
    }
    else
    {
        echo "Invalid email or password";
    }
    
}
  mysqli_close($conn);
?>