<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Details</title>


    <link rel="stylesheet" href="style/adddetails.css?=<?php echo time(); ?> ">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>




</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM -EXAM ADMIN</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
        <ul class="nav nav-pills nav-stacked">
                <li ><a href="Adminhomepage.php">Home</a></li>
                <li class="active"><a href="addDetails.php">Add Details</a></li>
                <li><a href="mainupdate.php">Update Details</a></li>
                <li><a href="managerequest.php">Manage Request</a></li>
                <li><a href="viewsearch.php">View and Search</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->

        <?php 
            ob_start();
            include "connect.php";
            session_start();

            if (!isset($_SESSION["username"]) || $_SESSION["type"] !== "Admin") {
                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                exit();
            }


            if(isset($_POST['add'])){

                $regNo=$_POST['regNo'];
                $fullName=$_POST['fullName'];
                $faculty=$_POST['faculty'];
                $studyProgram=$_POST['studyProgram'];
                $indexNo=$_POST['indexNo'];
                $nic=$_POST['nic'];
                $address=$_POST['address'];
                $contactNo=$_POST['contactNo'];
                $email=$_POST['email'];
                $academicYear=$_POST['academicYear'];
                $studyType=$_POST['studyType']; 
                $ogpa=$_POST['ogpa'];
                $degreeClass=$_POST['degreeClass'];
                $effectiveDate=$_POST['effectiveDate'];
               // $status=$_POST['status'];

                $query=" SELECT * from student where regNo='$regNo' ";
                
                $result=mysqli_query($con,$query);
                
                if(mysqli_num_rows($result)==1){
                    echo "<script>alert('Reg No or NIC or Index No taken by someone.')</script>";
                }
                else{
                    $query="INSERT INTO student(regNo,fullName,faculty,studyProgram,indexNo,nic,address,contactNo,email,academicYear,studyType,ogpa,degreeClass,effectiveDate,status) VALUES('$regNo','$fullName','$faculty','$studyProgram','$indexNo','$nic','$address','$contactNo','$email','$academicYear','$studyType','$ogpa','$degreeClass','$effectiveDate','N')";
                    mysqli_query($con,$query);
                    //echo $query;
                    //exit;
                    header("location:addDetails.php");
                }
                

            }


                if (isset($_POST['upload'])) {
                    $targetDirectory = "uploads/"; // Directory where you want to save uploaded files
                    $targetFile = $targetDirectory . basename($_FILES['excel_file']['name']);
                    $uploadOk = 1;
                    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                    // Check if the file is an Excel file (xlsx or xls)
                    if ($fileType != "xlsx" && $fileType != "xls") {
                        echo "Only Excel files (xlsx, xls) are allowed.";
                        $uploadOk = 0;
                    }

                    // Check if the file already exists
                    if (file_exists($targetFile)) {
                        echo "File already exists.";
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "File was not uploaded.";
                    } else {
                        // Move the uploaded file to the target directory
                        if (move_uploaded_file($_FILES['excel_file']['tmp_name'], $targetFile)) {
                            echo "The file " . htmlspecialchars(basename($_FILES['excel_file']['name'])) . " has been uploaded.";

                            $excelFile = $targetFile;

                            $excelData = []; 
                            foreach ($excelData as $row) {
                                $regNo = mysqli_real_escape_string($con, $row[0]);
                                $fullName = mysqli_real_escape_string($con, $row[1]);
                                $faculty = mysqli_real_escape_string($con, $row[2]);

                                $sql = "INSERT INTO student (regNo,fullName,faculty,studyProgram,indexNo,nic,address,contactNo,email,academicYear,studyType,ogpa,degreeClass,effectiveDate,status) VALUES('$regNo','$fullName','$faculty','$studyProgram','$indexNo','$nic','$address','$contactNo','$email','$academicYear','$studyType','$ogpa','$degreeClass','$effectiveDate','N')";
                                if (mysqli_query($con, $sql)) {
                                    echo "Data inserted successfully.";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($con);
                                }
                            }

                            mysqli_close($con);
                        } else {
                            echo "Error uploading the file.";
                        }
                    }
                }

            
            ?>
        
        <div class="mainbox">
        <h2>Add Student Details</h2>
            
            <div class="studentformmain">
                <div class="studentform">
                    <form action="" method="post">
                        <div class="studentinput">
                            <p>Registration Number</p>
                            <input type="" name="regNo" placeholder="2020/XXX/000">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Full Name</p>
                            <input type="text" name="fullName">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Faculty</p>
                            <input type="text" name="faculty">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Study Program</p>
                            <input type="text" name="studyProgram">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Index No</p>
                            <input type="text" name="indexNo">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>NIC Number</p>
                            <input type="text" name="nic">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Address</p>
                            <input type="text" name="address">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Contact No</p>
                            <input type="text" name="contactNo">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Email</p>
                            <input type="text" name="email">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Academic Year</p>
                            <input type="text" name="academicYear">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>OGPA</p>
                            <input type="text" name="ogpa">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Degree Class</p>
                            <select name="degreeClass" id="">
                                <option value="first">First Class</option>
                                <option value="second upper">Second Class Upper</option>
                                <option value="second lower">Second Class Lower</option>
                                <option value="No Class">No Class</option>
                            </select>
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Effective Date</p>
                            <input type="date" name="effectiveDate">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Medium</p>
                            <select name="st-inputdata-medium" id="">
                                <option value="English">English</option>
                                <option value="sinhala">Sinhala</option>
                                <option value="tamil">Tamil</option>
                            </select>
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Study Type</p>
                            <select name="studyType" id="">
                                <option value="3 Years">General</option>
                                <option value="4 Years">Honors</option>

                            </select>
                        </div><!--studentinput-->
                        
                        <input type="submit" name="add" value="ADD">


                    </form>
                    
                </div><!--studentform-->
                <div class="studentxlfile">
                    <h3>You can upoload your XL files here!</h3>
                    <div class="mb">

                    </div>
                </div><!--studentxlfile-->
            </div><!--studentformmain-->

        </div><!--mainbox-->
        
        <form class="" action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="excel" required value="">
                        <button type="submit" name="import">Import</button>
                    </form>


                <?php
                include "connect.php";
                if(isset($_POST["import"])){
                    $fileName = $_FILES["excel"]["name"];
                    $fileExtension = explode('.', $fileName);
                    $fileExtension = strtolower(end($fileExtension));
                    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

                    $targetDirectory = "uploads/" . $newFileName;
                    move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

                    error_reporting(0);
                    ini_set('display_errors', 0);

                    require 'excelReader/excel_reader2.php';
                    require 'excelReader/SpreadsheetReader.php';

                    $reader = new SpreadsheetReader($targetDirectory);
                    foreach($reader as $key => $row){

                        $regNo=$row[0];
                        $fullName=$row[1];
                        $faculty=$row[2];
                        $studyProgram=$row[3];
                        $indexNo=$row[4];
                        $nic=$row[5];
                        $address=$row[6];
                        $contactNo=$row[7];
                        $email=$row[8];
                        $academicYear=$row[9];
                        $studyType=$row[10]; 
                        $ogpa=$row[11];
                        $degreeClass=$row[12];
                        $effectiveDate=$row[13];

                        if(mysqli_query($con, "INSERT INTO student (regNo,fullName,faculty,studyProgram,indexNo,nic,address,contactNo,email,academicYear,studyType,ogpa,degreeClass,effectiveDate,status,filename) VALUES('$regNo','$fullName','$faculty','$studyProgram','$indexNo','$nic','$address','$contactNo','$email','$academicYear','$studyType','$ogpa','$degreeClass','$effectiveDate','N','')")){
                                echo
                                "<script>
                                alert('Succesfully Imported');
                                document.location.href = '';
                                </script>
                                ";
                            }
                            else{
                                echo
                                "
                                <script>
                                alert('failed Imported');
                                document.location.href = '';
                                </script>
                                ";
                            }
                }
            }
		?>

               





    </div><!--maincontent-->

</body>

</html>
