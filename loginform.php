<?php
include 'connect.php';
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT *FROM adminlogin WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        print_r($row);
        
        if(password_verify($password, $row['password']))
        {

            // $_SESSION['username'] = $row['username'];
            // $_SESSION['role'] = $row['role'];

            // if($_SESSION['role'] == 'admin')
            // {
                header("Location: dash.php");

            // }else{

            //     header("Location: user_dashboard.php");

            // }
        }
        else{

            echo "Wrong login Details";
        }
    }
}
?>

<html>

<head>
    <title>Login</title>
</head>

<body>

<form action="" method="post">
     <label>Username:</label>
    <input type="text" name="username" required ><br><br>

    <label>Password:</label>
    <input type="password" name="password" required ><br><br>

    <input type="submit" name="login" value="Login">


</form>

</body>
</html>