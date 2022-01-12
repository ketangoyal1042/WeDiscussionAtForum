<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'sign-up') 
{
     include '_dbconnect.php';
$showAlert=false;
$name = $_POST["user_name"];
$email_id = $_POST["user_email"];
$U_password = $_POST["user_pass"];
$U_password_confirm = $_POST["user_passcon"];

$Existquer = "SELECT * FROM `users` where user_email = '$email_id'";
$result = mysqli_query($con,$Existquer);
$Existnum = mysqli_num_rows($result);

if($Existnum > 0)
{
  $showError = "User Already Exist";

}
else
{
    if($U_password==$U_password_confirm)
    {
        $sql ="INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$name', '$email_id', '$U_password')";
        $result = mysqli_query($con,$sql);
        if ($result) 
        {
            $showAlert=true;
            header("location:/ONLINEFORUM/index.php?signupsuccess=true");
            exit();
        }
    }
    else {
        $showError = "Password does not match";
        

    }
}

header("location:/ONLINEFORUM/index.php?signupsuccess=false&show='$showError'");

}

?>