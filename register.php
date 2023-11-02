<?php

include 'connect.php';
if(isset($_POST['register']))
{
    $username = $_POST['username'];
    //$email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //$role = $_POST['role'];
    //$query = "SELECT *FROM users WHERE username = '$username' ";
    $query = "INSERT INTO login(username, password) values('$username',  '$password')";
    mysqli_query($con,$query);

    header("location:register.php");
    
}
?>

<html>
    <head>
        <title>User Registration</title>
    </head>

    <body>
    <h2>Sign Up</h2>
    <form action="" method="post">

    <label>Username:</label>
    <input type="text" name="username" required ><br><br>

    <label>Password:</label>
    <input type="password" name="password" required ><br><br>

    <!-- <label>Role:</label>
    <input type="text" name="role" required ><br><br>
    </select><br><br> -->

    <input type="submit" name="register" value="Register">

    <p>If you have a account? <a href="loginform.php">login</a></p>



    </form>
    </body>
</html>
