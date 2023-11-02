<?php

ob_start();
session_start();
include "connect.php";


if (isset($_POST["complaints"])) 
{
    $Reg_no = $_POST["regNo"];
    $Full_Name = $_POST["name"];
    $contact = $_POST['contact'];
    $Description = $_POST["description"];
    
    

    $query = "INSERT INTO complaints(fullName, description, regNo) values('$Full_Name', '$Description', '$Reg_no')"; //regNo,fulName,type,description values
    $result = mysqli_query($con, $query);


   
   

}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Complaint form</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
  </head>
  <body id="Dashboard">
    <nav class="nav-bar">
      <div class="nav-links">
        <h1 class="logo">UCIS</h1>
        <a class="btn fill-btn" href="login.php">Logout</a>
      </div>
    </nav>
    <div class="container">
      <div class="card complaint-card">
        <h3 class="topic">Fill the Form</h3>
        <form class="form" action="" method="post">
          <div>
          <div class="form-row">
              <!-- <label for="reg-no">Registration No: </label> -->
              <input type="text" class="input" id="reg-no" name="regNo" value="<?php echo $regNo; ?>" hidden/>
            </div>
            <div class="form-row">
              <label for="name">Name: </label>
              <input type="text" class="input" id="name" name="name" />
            </div>
            <div class="form-row">
              <label for="contact">Contact No: </label>
              <input type="tel" class="input" id="contact" name="contact" />
            </div>
            
            <div class="form-row">
              <label for="description">Your complaint: </label>
              <textarea
                id="complaint"
                class="input"
                name="description"
                rows="4"
                cols="50"></textarea>
            </div>
          </div>
          <div class="btn-row">
            <a href="UserDashboard.php" class="btn outline-btn">Back</a>
            <input class="btn fill-btn"  name="complaints" type="submit" value="Submit" />
          </div>
        </form>
      </div>
    </div>
    <div class="footer">
      <p class="copyright">
        COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL
        RIGHTS RESERVED.
      </p>
    </div>
  </body>
</html>
