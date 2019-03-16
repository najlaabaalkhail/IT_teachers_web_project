<?php 

session_start();  
if (($_SESSION['admin'] == "") && ($_SESSION['teacher'] == "" )) {
  header("Location: index.php");
}
if($_SESSION['admin'] == ""){
require_once('headerT.php');	
}else if($_SESSION['teacher'] == ""){
require_once('headerA.php');	
}

$servername = "localhost";
$username = "kafua";
$password = "123456789";
$dbname = "kafua";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sSQL= 'SET CHARACTER SET utf8'; 
mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase');


$fullName = $_GET["lesson"];
$arr = explode("?", $fullName, 2);
$lessonName = $arr[0];
$courseName = $arr[1];

$qu2 = "SELECT material FROM extramaterial WHERE lessonName ='$lessonName' AND courseName ='$courseName'";
$res2 = mysqli_query($conn,$qu2);
echo '
<div class="row">
<div class="col-md-4 col-sm-4 col-lg-4">
<div style= "margin-top:100px;  margin-left:100px;" align="right"><h4>:روابط إضافية</h4></div>';
if($_SESSION['teacher'] == ""){
echo'
<div style= "margin-left:100px;" align="right">
<form  method="post" action="">

			<div>
         <label for="display-name"> ادخلي الرابط
            </label>
			
            <input style="text-align: right;" type="text" id="material" name="material" required />
                   <span></span>    
        </div>
		<input class="myButton" type="submit" name="submit" value="إضافة">
		</form>
		</div>';
}

if(isset($_POST["submit"])){
		
		        $material = $_POST['material'];
				$IsmaterialUsed = false;		
				
                if ($material == "" ) {
                    $RegisterMessage = "Please Enter All Information";
                } else {
                    try {
						$query1 = "SELECT material FROM extramaterial where lessonName='$lessonName' 
						AND courseName='$courseName' AND material = '$material'";
						$co = mysqli_query($conn,$query1);
						$row = mysqli_fetch_array($co);
						if($row["material"] == $material)
                          $IsmaterialUsed = true;

                        if (!$IsmaterialUsed) {
                            $qur = "INSERT INTO `extramaterial` VALUES ( '".$material."',
							'".$lessonName."','".$courseName."')";
                             
                            if (( $result = mysqli_query( $conn,$qur ) )) {
                                echo "<div class='container' style='width:500px;'>
								<div class='alert alert-success'>
								<strong>تم!</strong> تمت الاضافة بنجاح.
								</div></div>"; 
                            }
                         else {
                            echo "<div class='container' style='width:500px;'>
							<div class='alert alert-danger '>
							<strong>فشل!</strong> لم تتم الاضافة.
							</div></div>";
							}
							
					  }else{
						 echo "<div class='container' style='width:500px;'>
							<div class='alert alert-danger '>
							<strong>فشل!</strong> لقد تم إضافة هذا الدرس مسبقاً.
							</div></div>"; 
					  }
						
                    } catch (Exception $ex) {
                        echo "<div class='container' style='width:500px;'>
							<div class='alert alert-danger '>
							<strong>فشل!</strong> لم تتم الاضافة.
							</div></div>";
                    }
                }
            }
		
		


echo'<div align="right"  >';

while($row2 = $res2->fetch_assoc()){
	$arr = explode(".", $row2['material'], 3);
    $name = $arr[1];
	echo '<a href="'.$row2["material"].'">'.$name.'</a>';
	echo '<br>';
	
}
echo '</div> </div>';


$qu = "SELECT * FROM lessons WHERE lessonName ='$lessonName' AND courseName ='$courseName'";
$res = mysqli_query($conn,$qu);
while($row1 = $res->fetch_assoc()){
	
echo '
<br>
<br>
<br>
<div class="col-md-8 col-sm-8 col-lg-8">

<div align="right" style= "margin-right:60px" class="row">

   <iframe width="560" height="315" src="'.$row1['content'].'" frameborder="0" allow="autoplay;
   encrypted-media" allowfullscreen>
   </iframe>
  
</div>

<div align="right" style= "margin-right:60px" class="row">

    <h4> '.$row1['lessonName'].' - '.$row1['courseName'].'</h4>  
  
   </div>
      </div>

';
}
echo '</div>';


//show if the loged in porson is the teacher	
//finish the lesson button
if($_SESSION['admin'] == ""){
	$button = "";
	$qu = "SELECT * FROM finishlesson WHERE email ='".$_SESSION['teacher']."' AND 
	       courseName = '$courseName' AND lessonName = '$lessonName'";
		   
    $result = mysqli_query($conn,$qu);
	$numRows = mysqli_num_rows($result);
	
    if($numRows > 0)
		$button = "disabled";
		
		
	echo '<div class="row">
           <div align="center">
		    <form  method="post" action="">
		     <input class="myButton"  type="submit" id="dis" name="submit2" 
			 value="تم الإنتهاء من الدرس" '.$button.'
			 />
			</form>
		   </div>
		   <div>';
		   
	if(isset($_POST["submit2"])){
		$qu = "INSERT INTO finishlesson VALUES 
		( '".$courseName."','".$lessonName."','".$_SESSION['teacher']."')";
        $result = mysqli_query($conn,$qu);
		echo'
		<script language="javascript">
          document.getElementById("dis").disabled = true;
          window.location.href="lesson.php?course='.$courseName.'";		  
        </script>
		';
		
	}
	
	
}

	



$conn->close();
?>

</body>
</html>