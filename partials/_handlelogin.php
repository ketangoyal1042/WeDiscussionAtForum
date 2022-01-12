<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'log-in') 
{
     include '_dbconnect.php';
     $isloggedin = 'false';
     $email_id = $_POST["InputEmail"];
     $U_password = $_POST["InputPassword"];

     $sql= "SELECT * FROM `users` where user_email = '$email_id' and user_password = '$U_password'";
     $result = mysqli_query($con,$sql);
$Existnum = mysqli_num_rows($result);

if ($Existnum==1) {
    $isloggedin = 'true';
    $row = mysqli_fetch_assoc($result);
    $username = $row['user_name'];
    session_start();
    $_SESSION['isloggedin1'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['sno'] = $row['s_no'];

header("location:/ONLINEFORUM/index.php?loginsuccess=$isloggedin");

    exit();
}
header("location:/ONLINEFORUM/index.php?loginsuccess=$isloggedin&show='User Does not Exist or Incorrect Password'");
}

?>