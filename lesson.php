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
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<style>
.new-deal{width:100%;float:right;padding:15px 0;}
ul {margin:20px auto;width:40%;}
ul li {display: inline-block;list-style: none;margin:0;}
.demoFirst {position:relative;width:300px;height:200px;overflow:hidden;float:right;margin-right:20px;
background-color:rgba(26,76,110,0.5);}
.demoFirst p,.demoFirst h2 {color:#fff;padding:10px;right:-20px;top:20px;position:relative}
.demoFirst p {font-size:12px;line-height:18px;margin:0}
.demoFirst h2 {font-size:20px;line-height:24px;margin:0;}
.effect img {position:absolute;right:0;bottom:0;cursor:pointer;
width: 100%;
-webkit-transition:bottom .3s ease-in-out;
-moz-transition:bottom .3s ease-in-out;-o-transition:bottom .3s ease-in-out;
transition:bottom .3s ease-in-out;}
.effect img.top:hover {bottom:-96px;padding-top:100px;}
h2.zero,p.zero {margin:0;padding:0}


h1 {
  text-align: center;
  font-family: Tahoma, Arial, sans-serif;
  color: #06D85F;
  margin: 80px 0;
}

.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
    overflow: auto;
	z-index: 1;

}
.overlay:target {
  visibility: visible;
  opacity: 1;
    overflow: auto;
	z-index: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h3 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
  text-align:center;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}



.wrapper2 {
    position: absolute;
    top: 30%;
	right:15%;
}
span.a {
	display: inline;
	
}
</style>
<section class="new-demo">
		 <div class="container"> 
		 
<?php
$servername = "localhost";
$username = "kafua";
$password = "123456789";
$dbname = "kafua";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//encoding to support arabic should be in every page 
$sSQL= 'SET CHARACTER SET utf8'; 
mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase');

//get the course name from the lesson page
$courseName = $_GET["course"];

//show if the loged in porson is the admin	
//add new lesson
if($_SESSION['teacher'] == ""){
	
	 echo'
	  <div align="right" style="margin-right:50px;  margin-top:50px;">
	   <a href="#popup1"> <h5>إضافة درس جديد <img src="image/add.png" alt=""/></h5> </a>
	  </div>
	
	 <div id="popup1" class="overlay">
	   <div class="popup">
		<h3>إضافة درس</h3>
		<a class="close" href="">&times;</a>
		<div align="right" class="content">
			<form  method="post" action="#">

			<div>
         <label for="display-name"> ادخلي اسم الدرس
            </label>
			
            <input style="text-align: right;" type="text" 
			id="lessonName" name="lessonName" required />
                   <span></span>    
        </div>
		
	<div>
         <label for="display-name"> ادخلي رابط الدرس
                <span class="warning">*من اليوتيوب</span> 
            </label>
			
            <input style="text-align: right;" type="text" id="content" name="content" required />
                   <span></span>    
        </div>
		<br>
		<input type="submit" name="submit" value="إدخال">
		</form>
		</div>
	</div>
</div>
	
	';
	
	//popup window (form to add the new lesson)
	if(isset($_POST["submit"])){
	$lessonName = $content ="";
                $lessonName = $_POST['lessonName'];
				$content = $_POST['content'];
				$IslessonNameUsed = false;		
				
                if ($lessonName == "" || $content == "") {
                    $RegisterMessage = "Please Enter All Information";
                } else {
                    try {
						$query1 = "SELECT lessonName FROM lessons where lessonName='$lessonName' AND
						courseName='$courseName'";
						$co = mysqli_query($conn,$query1);
						$row = mysqli_fetch_array($co);
						if($row["lessonName"] == $lessonName)
                          $IslessonNameUsed = true;

                        if (!$IslessonNameUsed) {
                            $qur = "INSERT INTO `lessons` VALUES ( '','".$lessonName."',
							'".$content."','".$courseName."')";
                             
                            if (( $result = mysqli_query( $conn,$qur ) )) {
                                echo "<div class='container' style='width:500px;'>
								<div class='alert alert-success' style='text-align: center;'>
								<strong>تم!</strong> تمت الاضافة بنجاح.
								</div></div>";                  }
                         else {
							echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger ' style='text-align: center;'>
							 <strong>فشل!</strong> لم تتم الاضافة حصل عطل في الاتصال مع الخادم.
							</div></div>";
							}
							
					  }else{
							echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger ' style='text-align: center;'>
							 <strong>فشل!</strong> لقد تم إضافة هذا الدرس مسبقاً.
							</div></div>";
					  }
						
                    } catch (Exception $ex) {
							echo "<div class='messages1' style='width:500px;'>
							<div class='alert alert-danger ' style='text-align: center;'>
							 <strong>فشل!</strong> لم تتم الاضافة حصل عطل في الاتصال مع الشبكة.
							</div></div>";
                    }
                }
            }
	
	}
	
//show if the loged in porson is the teacher	
//upload task for the course
if($_SESSION['admin'] == ""){
	       
}

	
	
	//show if the loged in porson is the teacher	
    //if the teacher finish all the lesson
	if($_SESSION["admin"] == ""){
		
           $qu3 = "SELECT email FROM finishlesson WHERE email ='".$_SESSION['teacher']."' AND 
	       courseName = '$courseName'";
		   $result3 = mysqli_query($conn,$qu3);
		   $numRows = mysqli_num_rows($result3);
		   
		   
		   $qu4 = "SELECT lessonName FROM lessons WHERE courseName = '$courseName'";
		   $result4 = mysqli_query($conn,$qu4);
		   $numRows2 = mysqli_num_rows($result4);
		   
		   $qu5 = "SELECT examLink FROM courses WHERE courseName = '$courseName'";
		   $result5 = mysqli_query($conn,$qu5);
		   $row5 = $result5->fetch_assoc();

		   //if there is lesson
		   if($numRows2 > 1){
			   //upload task for the course
			   $qur4 = "SELECT 	taskUpload FROM joincourses WHERE email ='".$_SESSION['teacher']."' AND 
	       courseName = '$courseName'";
		   $result44 = mysqli_query($conn,$qur4);
		   $numRows3 = $result44->fetch_assoc();
		   
		   $qur20 = "SELECT 	taskContent FROM courses WHERE courseName = '$courseName'";
		   $result20 = mysqli_query($conn,$qur20);
		   $numRows20 = $result20->fetch_assoc();
		   
		   echo'<ul align="right" >
		   <li>
	  <div  style="margin-right: 10px;  margin-top:50px;">
	   <a href="upload/'.$numRows20["taskContent"].'"> <h5>مهمة المادة <img src="image/add.png" alt=""/></h5> </a>
	  </div>
	  </li>';
		   
		   if($numRows3["taskUpload"] == NULL || $numRows3["taskUpload"] == -1){
	 echo'
	  <li><div style="margin-right: 10px;  margin-top:50px;">
	   <a href="#popup1"> <h5>رفع المهمة <img src="image/add.png" alt=""/></h5> </a>
	  </div></li></ul>
	
	 <div id="popup1" class="overlay">
	   <div class="popup">
		<h3>رفع المهمة</h3>
		<a class="close" href="">&times;</a>
		<div align="right" class="content">
			<form  method="post" action="#" enctype="multipart/form-data">

			<div>
         <label for="display-name"> :الملف
            </label>
			
			<input type="file" name="file" align="right" required/>  
        </div>
		
		<br>
		<input type="submit" name="submit3" value="إدخال">
		</form>
		</div>
	</div>
</div>
	
	';
	
	//popup window (form to upload the task)
	if(isset($_POST["submit3"])){
		

$name= $_FILES['file']['name'];
$tmp_name= $_FILES['file']['tmp_name'];


$position= strpos($name, "."); 

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

if (isset($name)) {

$path= 'upload/';
if (!empty($name)){
 if (move_uploaded_file($tmp_name, $path.$name)) {
	$sql= "UPDATE joincourses SET taskUpload='$name' WHERE courseName='".$courseName."'";
if (( $result2 = mysqli_query( $conn,$sql ) )) {
	
                                echo "<div class='container' style='width:500px;'>
								<div class='alert alert-success'>
								<strong>تم!</strong> تمت الاضافة بنجاح.
								</div></div>"; 
			
                            }else {
							
                            echo "<div class='container' style='width:500px;'>
							<div class='alert alert-danger '>
							<strong>فشل!</strong> لم تتم الاضافة.
							</div></div>";
							
							}
}
}
}
}
		   }else{
			   echo '<li>
						<div align="right" style="margin-right:10px;  margin-top:50px;">
						 تم رفع المهمة بنجاح
					    </div>
						</li></ul>
						';
		   }
			   
			   
		   if($numRows == $numRows2){
			   echo '
			   
			   <form  method="post" action="">
			   
			   <div class="wrapper">
			   <div class="wrapper2">
			   <span class="a">
			     <button style="background: white; border: white; margin-right: 320px;" type="submit" name="submit4" >
				 <figure>
					<img src="image/exam.png" alt=""/>
					<figcaption>
					<h4> الذهاب إلى الإختبار</h4></figcaption>
	             </figure>
		    	 </button>
				</span>
				
				 <span class="a">
				  <button style="background: white; border: white;" type="submit" name="submit2">
				 <figure>
					<img src="image/chat.png" alt=""/>
					<figcaption style="margin-right: 60px;">
					<h4> الذهاب لمنتدى مناقشة المادة</h4></figcaption>
	             </figure>
		    	 </button>
                 </span>
				 </div>
               </div>

		     
			</form>';
			
		if(isset($_POST["submit4"])){
		echo'
		<script language="javascript">
          window.open("'.$row5["examLink"].'", "_blank");		  
        </script>
		';}
		
		
		if(isset($_POST["submit2"])){
		echo'
		<script language="javascript">
          window.location.href="discussionboard.php?course1='.$courseName.'";		  
        </script>
		';
		
		}   
		   }else{
			   
			   // show all the lesson for the course
$qu = "SELECT * FROM lessons WHERE courseName ='$courseName' ORDER BY lessonOrder ASC";
$res = mysqli_query($conn,$qu);


while($row1 = $res->fetch_assoc()){
	    echo'<a href="lessonContent.php?lesson='.$row1['lessonName'].'?'.$courseName.'" >
	          <div style="float:right!important;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<figure>
					<ul class="demoFirst effect">
						<li>
						   <h2 class="zero">!ابدأ الدرس</h2>
						   <p class="zero">'.$row1['lessonName'].'</p>
						</li>
						<li><img class="top" src="image/course.png" alt=""/></li>
					</ul>
					 <figcaption style="float:right!important; padding-right: 100px;">
					 '.$row1['lessonName'].'</figcaption>
	             </figure>
				</div>
			  </a>';
}
			   
		   }
		   
		   }else{
			   echo '<div class="wrapper">
			   <div class="wrapper2">
			   <h3>لا توجد دروس حالياً <span><i class="fa fa-warning" style="font-size:24px;color:red"></i></span></h3>
			   
			   </div></div>';
		   }
		   
		   
		   
		   
		   
	}
	
	
//show if the loged in porson is the admin	
    //if the teacher finish all the lesson
	if($_SESSION["teacher"] == ""){	
	
//show all the lesson for the course
$qu = "SELECT * FROM lessons WHERE courseName ='$courseName' ORDER BY lessonOrder ASC";
$res = mysqli_query($conn,$qu);


while($row1 = $res->fetch_assoc()){
	echo'<a href="lessonContent.php?lesson='.$row1['lessonName'].'?'.$courseName.'" >
	      <div style="float:right!important;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<figure>
					<ul class="demoFirst effect">
						<li>
						   <h2 class="zero">!ابدأ الدرس</h2>
						   <p class="zero">'.$row1['lessonName'].'</p>
						</li>
						<li><img class="top" src="image/course.png" alt=""/></li>
					</ul>
					 <figcaption style="float:right!important; padding-right: 100px;">
					 '.$row1['lessonName'].'</figcaption>
	             </figure>
					</div></a>';
}
	}

$conn->close();
?>

</div>
</section>


<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>
</body>
</html>
