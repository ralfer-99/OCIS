<?php

ob_start();
session_start();
include "connect.php";

$regNo = $_SESSION['username'];

$query = "SELECT * from student WHERE regNo = '$regNo'";
$res = mysqli_query($con, $query);
$obj = mysqli_fetch_assoc($res);

if(isset($_POST['regno'])){
  $sql="SELECT * FROM problems WHERE regNo = '$regNo'";
  $result = mysqli_query($con, $sql);
  echo "$sql";
  print_r($result);

  if(mysqli_num_rows($result) ==1){
    echo"<script>alert(You can't request file a inquiry)</script>";
     //header("location:Request.php");
  }
  
  else{
   header("location:Request.php");
   //echo"<script>alert(You can't request file a inquiry)</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
</head>
<body>

<h1>Student Dashboard</h1>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
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
        <a class="btn fill-btn" href="logout.php">Logout</a>
      </div>
    </nav>
    <div class="container">
      <div class="card profile-card">
        <div class="grid-col-3">
          <div class="profile">
            <!-- if theres no profile picture generate this -->
            <div class="icon-bg profile-bg">
              <i class="fa-solid fa-user"></i>
            </div>
     
            
            <!-- otherwise generate this -->
            <!-- <img src="#" alt="Profile Picture" class="profile-picture" /> -->
            <!-- end if -->
            <h4><?php echo $obj['fullName']?></h4>
            <p><?php echo $obj['regNo']?></p>
          </div>

          <div class="line"></div>
          <div class="profile-details">
            <div class="detail-row-grid">
              <h5>NIC:</h5>
              <p><?php echo $obj['nic']?></p>
            </div>

            <div class="detail-row-grid">
              <h5>E-mail:</h5>
              <p><?php echo $obj['email']?></p>
            </div>
            <div class="detail-row-grid">
              <h5>Mobile Number:</h5>
              <p><?php echo $obj['contactNo']?></p>
            </div>
            <div class="detail-row-grid">
              <h5>Address:</h5>
              <p><?php echo $obj['address']?></p>
            </div>
            <div class="detail-row-grid">
              <h5>Degree Program:</h5>
              <p><?php echo $obj['studyProgram']?></p>
            </div>
            <div class="detail-row-grid">
              <h5>Study Type:</h5>
              <p><?php echo $obj['studyType']?></p>
            </div>
            <!-- <div class="detail-row-grid">
              <h5>Course Duration:</h5>
              <p><?php echo $obj['courseDuration']?></p>
            </div> -->
            <div class="detail-row-grid">
              <h5>Date of Admission:</h5>
              <p><?php echo $obj['effectiveDate']?></p>
            </div>
          </div>
        </div>
      </div>

      <div class="card request-sec">
        <h3 class="topic">Certificate Request Progress</h3>
        <?php 
        $query1 = "SELECT * FROM student where regNo='$regNo' ";

    $result1 = mysqli_query($con, $query1);

    $row = mysqli_fetch_assoc($result1)?>
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            
            <tr>
            <tr>
              
            <td><?php echo $row['effectiveDate']; ?></td>
            <td>Request for the Certificate</td>
            <td>
                <?php 
                if ($row['status'] == 'R') {
                    // Display a button with a link to "download_certificate.html"
                  echo "Requested";
                  //echo '<button class="btn fill-btn"><a href="download_certificate.html">Download Certificate</a></button>';
                } elseif ($row['status'] == 'V') {
                    echo "Verified";
                } elseif($row['status'] == 'I') {
                  ?>
                    <button class="btn fill-btn"><a href="download_certificate.php">Click here</a></button>

                <?php

                }
                ?>
            </td>
            </tr>
           
          </tbody>
        </table>
      </div>
    
      <div class="btn-row-dashboard">
		<a class="btn outline-btn" href="Complaints.php">File any inquiries</a>
		<button class="btn fill-btn"   onclick="req('<?php $regNo ?>')" name="regno">Request Certificate</button>
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

<script>
  function req(reg){
    var frm =document.createElement("form");
    frm.action= "";
    frm.method="post";
    var inp =document.createElement("input");
    inp.name = "regno";
    inp.value =reg;
    frm.appendChild(inp);
    document.body.appendChild(frm);
    frm.submit();
  }
</script>

</body>
</html>
