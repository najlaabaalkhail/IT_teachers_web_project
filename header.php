<!DOCTYPE html>
<?php

	ob_start();
	session_start();
	
	if(isset($_SESSION['teacher']) != ""){
		header("Location: teacherhomepage.php");
	}
	else if(isset($_SESSION['admin']) != ""){
		header("Location: adminPage.php");
	}
	
	
$servername = "localhost";
$username = "kafua";
$password = "123456789";
$dbname = "kafua";
$errMSG="";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);	
} 


$sSQL= 'SET CHARACTER SET utf8'; 
mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase');
	
	
	$error = false;
	
	if( isset($_POST['submit']) ) {	
	
		

		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		
		if(empty($email)){
			$error = true;
			echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger ' style='text-align: center;'>
							 الرجاء اخال البريد الإلكتروني.
							</div></div>";
		}
		
		if(empty($password)){
			$error = true;
			echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger ' style='text-align: center;'>
							 الرجاء اخال كلمة المرور.
							</div></div>";
							
		}
	
		if (!$error) {
			
			
		    if($_POST['type']=== 'admin'){
			$qu="SELECT password FROM admain WHERE email='$email'";
			$resu=mysqli_query($conn,$qu);
			$r=mysqli_fetch_array($resu);
			$co = mysqli_num_rows($resu);
			if( $co == 1 && $r['password']==$password ) {
				$_SESSION['admin'] = $email;
				$_SESSION['teacher'] = NULL;
				header("Location: teacherList.php");
			} else {
				
				echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger ' style='text-align: center;'>
							<strong>فشل!</strong> تأكد من إدخال البيانات الصحيحة.
							</div></div>";
			}
			} 
			
			if($_POST['type']=== 'teacher'){
			$q="SELECT password FROM teacher WHERE email='$email'";
			$res=mysqli_query($conn,$q);
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); 			
			if( $count == 1 && $row['password'] == $password ) {
				$query="SELECT * FROM joincourses WHERE email='$email'";
			    $res1=mysqli_query($conn,$query);
			 
				while($row1=mysqli_fetch_array($res1)){
					
					if ( ($row1["courseMark"] > -1) & ($row1["taskMark"] > -1) & ($row1["commentDone"] == 1) ){
						echo '1';
						if($row1["courseMark"] < 60){
							$q4 = "UPDATE joincourses SET courseMark=-1, taskMark=-1,
							commentDone=0 WHERE courseName='".$row1["courseName"]."' AND email='$email'";
							mysqli_query($conn,$q4);
						}else if($row1["courseMark"] >= 60){
							$q2= "INSERT INTO finishcourses (email, courseName, courseMark, taskMark, certificate)
                            VALUES ('$email', '".$row1["courseName"]."', '".$row1["courseMark"]."', '".$row1["taskMark"]."', NULL)";
							mysqli_query($conn,$q2);
							
							$q3= "DELETE FROM finishlesson WHERE courseName='".$row1["courseName"]."' AND email='$email'";
							mysqli_query($conn,$q3);
							
							$q = "DELETE FROM joincourses WHERE courseName='".$row1["courseName"]."' AND email='$email'"; 
							mysqli_query($conn,$q); 
						}
						
					}
					
				}
			    
				
				$_SESSION['teacher'] = $email;
				$_SESSION['admin'] = NULL;
				header("Location: teacherProfile.php");
			} else {
				
				echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger' style='text-align: center;'>
							<strong>فشل!</strong> تأكد من إدخال البيانات الصحيحة.
							</div></div>";
							
			}
			}
		}
		
	}
?>
<html lang="ar" align="right">
<link rel="stylesheet" type="text/css" href="bootstrap-css2.css">
<link rel="stylesheet" type="text/css" href="bootstrap-css.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="commentStyle.css">
<link rel="stylesheet" type="text/css" href="commentBox.css">

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script

<!---->
<style>

.myButton {
	
	background-color:#476e9e;
	-moz-border-radius:10px;
	-webkit-border-radius:10px;
	border-radius:10px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	padding:7px 12px;
	text-decoration:none;
	text-shadow:0px 1px 0px #283966;
}
.myButton:hover {
	background-color:#7892c2;
}
.myButton:active {
	position:relative;
	top:1px;
}

.messages1 {
    position: absolute;
    top: 90%;
	right:30%;
	bottom: 10%
	
}

</style>

<!------ Include the above in your HEAD tag ---------->




<nav class="navbar navbar-inverse navbar-static-top marginBottom-0" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <a class="navbar-brand navbar-right" href="#" target="_blank">NewWindow</a>
            </div>
            

            <div class="collapse navbar-collapse" id="navbar-collapse-1">
				<ul style="margin-right:20px;width:40%;" class="nav navbar-nav navbar-right">
					<li><a  href="contactUs.php">تواصل معنا</a></li>
					<li><a  href="condtion.php">الشروط</a></li>
                    <li><a  href="objectives.php">أهدافنا</a></li>
					<li><a  href="kafua.php">عن كفء</a></li>
					<li><a  href="index.php">الصفحة الرئيسية</a></li>

					
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>