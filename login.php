<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "connect.php";
session_start();
  if(isset($_POST["login"])){
    
    $username  = $_POST["username"];
    

    $query = "SELECT * FROM login where username = '$username' ";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);
    
    $hashpassword = $row["password"];
    $_SESSION["username"] = $username;
    
    if(!password_verify($_POST["password"],$hashpassword)){
        header("location:login.php");
    }
    else{
       header("location:User/UserDashboard.php");
    }
    
  }



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OCDS | Login</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
  </head>
  <body>
    <div class="bg-img"></div>
    <div class="login-card grid-col" id="card">
      <div class="col certificate-col">
        <h2 class="col-title">Certificate Verification System</h2>
        <div class="icon-bg">
          <i class="fa-solid fa-certificate"></i>
        </div>
        <h5>Verify the certificate here</h5>
       
         <a href="verifiedCertificate.php"><button class="btn fill-btn submit-btn" type="submit" value="Verify" >Verify</button></a> 

      </div>
      <div class="line"></div>
      <div class="col login-col">
        <h2 class="col-title">University Certification System</h2>
        <div class="icon-bg">
          <i class="fa-solid fa-user"></i>
        </div>
        <h5>Sign-in to your Account</h5>
        <form class="form" action="" method="post">
          <div class="text-input">
            <i class="fa-solid fa-user"></i>
            <div class="line"></div>
            <input
              type="text"
              name="username"
              id="username"
              placeholder="UserName" />
          </div>
          <div class="text-input">
            <i class="fa-solid fa-key"></i>
            <div class="line"></div>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password" />
          </div>
          <input
            class="btn fill-btn submit-btn"
            type="submit"
            name ="login"
            value="Sign-In" />
        </form>
        <a class="forgot-pw-link" href="">Forgot Password?</a>
      </div>
    </div>
    <a href="Adminlogin.php" class="btn fill-btn admin-btn">Admin-Login</a>
  </body>
</html>
