<?php
ob_start();
include("connect.php");
session_start();

if (isset($_SESSION["username"])) {
    header("Location: Adminlogin.php"); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    
    //$password = password_verify($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST["type"];


    $sql = "SELECT * FROM adminlogin WHERE username = '$username'  AND type = '$user_type'";
    $result=mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    
    echo $sql;
    print_r($result);

    if (mysqli_num_rows($result)>0) {
        $_SESSION["username"] = $username;
        $_SESSION["type"] = $user_type;
        $hashpassword = $row["password"];
        if(!password_verify($_POST["password"],$hashpassword)){
            header("location:Adminlogin.php");
            exit();
        }
        if ($user_type == "Admin") {
            header("Location:AdminExam/Adminhomepage.php");
        } elseif ($user_type == "Exam Admin") {
            header("Location: Admin/Adminhomepage.php");
        } elseif ($user_type == "Authenticator") {
            header("Location: Authenticator/Adminhomepage.php");
        } else {
            // Handle unknown user types or future additions
            header("Location: connect.php");
        }
        exit();
    } else {
        $error_message = "Invalid username, password, or user type. Please try again.";
    }
}

// Close the databas connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: 0;
        }

        /* main class */
        .main {
            display: flex;
            width: 100%;
            height: 100vh;
            margin: auto;
            align-items: center;
            background-color: rgb(88, 172, 172);
            background-image: url();
            background-image: linear-gradient(to bottom, #dacff1, #f3f3f3, #c0c5d8);


        }

        /* login-box */
        .login-box {

            width: 65%;
            height: 500px;
            margin: auto;
            display: flex;
            background-color: rgb(200, 173, 220);
            font-family: 'Poppins', sans-serif;
            box-shadow: 4px 4px 10px rgba(114, 114, 114, 0.9);
            border-radius: 10px;
        }

        /* input-box */
        .input-box {
            width: 60%;
            height: 250px;
            margin: auto;
            align-items: center;
            background-color: #fff;
            font-family: 'Poppins', sans-serif;
           text-align: center;
           padding: 10px;
           border-radius: 10px;
        }

        /* .input-box h1*/
        .input-box h1 {
            margin-top: 10px;
            margin-left: 20px;
        }

        /* .input-box input*/
        .input-box form input ,a{
            width: 70%;
            height: 30px;
            margin-left: 20px;
            border-radius: 5px;

        }

        /* submit button */

        /* froget password */
        .input-box  a{
           text-decoration: none;
            color: black;
            font-weight: 700;
            text-align: center;

        }
    </style>
</head>
<body>
<div class="main">
        <div class="login-box">
            <!-- <h2>University Certification Issuing System</h2> -->
            <div class="input-box box1">
                <h2>Admin Login</h2>
                <?php
                if (isset($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>
                <form method="post" action="">
                    <label for="username">User Name:</label>
                    <input type="text" id="username" name="username" required><br><br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br><br>

                    <label for="type">User Type:</label>
                    <select id="type" name="type" required>
                        <option value="Admin">Admin</option>
                        <option value="Exam Admin">Exam Admin</option>
                        <option value="Authenticator">Authenticator</option>
                    </select><br><br>

                    <input style=" 
                    height: 30px;
                    background-color: rgb(64, 8, 123);
                    color: white;
                  " type="submit" name="addmin-login" value="Login"><br><br>
                </form>
                <a href="login.php">Back To Login</a>
                </div><!--login-box box1---->
                
        </div><!--login-box-->
    </div><!--main-->
</body>
</html>









