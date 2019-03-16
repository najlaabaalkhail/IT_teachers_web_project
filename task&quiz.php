<?php 
session_start();  
if (($_SESSION['admin'] == "") ) {
  header("Location: index.php");
}
require_once('headerA.php');	
?>
<style>


.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
	
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
.inputfile + label {
	text-decoration: underline;
    font-weight: 700;
    color: #600B9C;
    display: inline-block;
}

.inputfile:focus + label,
.inputfile + label:hover {
    background-color: #ffc7d1;
}
.inputfile + label {
	cursor: pointer; /* "hand" cursor */
}
.inputfile:focus + label {
	outline: 1px dotted #000;
	outline: -webkit-focus-ring-color auto 5px;
}
.inputfile + label * {
	pointer-events: none;
}

.messages1 {
    position: absolute;
    top: 90%;
	right:30%;
	bottom: 10%;
	
}
</style>

<body>


<?php
$servername = "localhost";
$username = "kafua";
$password = "123456789";
$dbname = "kafua";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sSQL= 'SET CHARACTER SET utf8'; 
mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase');

$qu= "SELECT courseName FROM courses";
$res = mysqli_query($conn,$qu);

echo '<div class="container">
    <table class="table table-striped custab">';
while($row1 = $res->fetch_assoc()){
	
echo '     

 <tr>

            <form method="post" action="#" enctype="multipart/form-data">
				<td><input class="myButton" style="margin-right:5px;" type="submit" name="submitQuiz" value="رفع">
				<input style="margin:0px;text-align:right;"type="text" name="addQuiz" placeholder="إضافة رابط الاختبار"/></td>
                <td><input class="myButton" style="margin-right:5px;" type="submit" name="taskUpload" value="رفع">
				<input type="file" name="file" id="'.$row1['courseName'].'" class="inputfile" align="right">
				<label for="'.$row1['courseName'].'">اختر ملف المهمة</label></td>
				<th style="text-align:right;">'.$row1['courseName'].'</th>
				<input type="hidden" name="courseName" value="'.$row1['courseName'].'"/> 
				</form>
				</tr>';

}
echo '    </table>
</div>';
//upload task file in admin account
if(isset($_POST["taskUpload"])){
$name= $_FILES['file']['name'];
$tmp_name= $_FILES['file']['tmp_name'];


$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

if (isset($name)) {

$path= 'upload/';
if (!empty($name)){
 if (move_uploaded_file($tmp_name, $path.$name)) {
	$sql= "UPDATE courses SET taskContent='$name' WHERE courseName='".$_POST["courseName"]."'";
if ((mysqli_query( $conn,$sql ) )) {
	
                                
								"<div class='messages1' style='width:500px;'>
								<div class='alert alert-success'>
								<strong>تم!</strong> تمت الاضافة بنجاح.
								</div></div>"; 
			
                            }else {
							
                            echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger '>
							<strong>فشل!</strong> لم تتم الاضافة.
							</div></div>";
							
							}
}
}
}
}
if(isset($_POST["submitQuiz"])){	
	$qur = "UPDATE courses SET examLink = '".$_POST["addQuiz"]."' WHERE courseName= '".$_POST["courseName"]."'";
if (mysqli_query( $conn,$qur )) {
	
                                
								"<div class='messages1'style='width:500px;'>
								<div class='alert alert-success'>
								<strong>تم!</strong> تمت الاضافة بنجاح.
								</div></div>"; 
			
                            }else {
							
                            echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger '>
							<strong>فشل!</strong> لم تتم الاضافة.
							</div></div>";
							
							}	
}


	  	  
	 /** 	
  

			  echo $qur;
	  $result1 = $conn->query($qur);**/ 



$conn->close();
?>
</body>

</html>