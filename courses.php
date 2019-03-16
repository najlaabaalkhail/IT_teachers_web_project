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

<!------ Include the above in your HEAD tag ---------->

<style>
.new-deal{width:100%;float:right;padding:15px 0;}
ul {margin:20px auto;width:40%;}
ul li {display: inline-block;list-style: none;margin:0;}
.demoFirst {position:relative;width:300px;height:200px;overflow:hidden;float:right;margin-right:20px;background-color:rgba(26,76,110,0.5);}
.demoFirst p,.demoFirst h2 {color:#fff;padding:10px;right:-20px;top:20px;position:relative}
.demoFirst p {font-size:12px;line-height:18px;margin:0}
.demoFirst h2 {font-size:20px;line-height:24px;margin:0;}
.effect img {position:absolute;right:0;bottom:0;cursor:pointer;width: 100%;-webkit-transition:bottom .3s ease-in-out;-moz-transition:bottom .3s ease-in-out;-o-transition:bottom .3s ease-in-out;transition:bottom .3s ease-in-out;}
.effect img.top:hover {bottom:-96px;padding-top:100px;}
h2.zero,p.zero {margin:0;padding:0}



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

.wrapper {
    text-align: center;
	
}

.wrapper2 {
    position: absolute;
    top: 50%;
	right:50%;
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
$sSQL= 'SET CHARACTER SET utf8'; 
mysqli_query($conn,$sSQL) 
or die ('Can\'t charset in DataBase');


if($_SESSION['admin'] == ""){
$qu= "SELECT courseName FROM joincourses WHERE email='".$_SESSION['teacher']."'";
$res = mysqli_query($conn,$qu);
while($row2 = $res->fetch_assoc()){
	echo'<a href="lesson.php?course='.$row2['courseName'].'" ><div style="float:right!important;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<figure>
					<ul class="demoFirst effect">
						<li>
						   <h2 class="zero">!ابدأ الدرس</h2>
						   <p class="zero">'.$row2['courseName'].'</p>
						</li>
						<li><img class="top" src="image/book.jpg" alt=""/></li>
					</ul>
					 <figcaption style="float:right!important; padding-right: 100px;">'.$row2['courseName'].'</figcaption>
	             </figure>
					</div></a>';
	
}
}
	//show if the loged in porson is the admin	
//add new course
if($_SESSION['teacher'] == ""){	
	 echo'
	  <div align="right" style="margin-right:50px;  margin-top:50px;">
	   <a href="#popup1"> <h5>إضافة مادة جديدة <img src="image/add.png" alt=""/></h5> </a>
	  </div>
	
	 <div id="popup1" class="overlay">
	   <div class="popup">
		<h3>إضافة مادة</h3>
		<a class="close" href="">&times;</a>
		<div align="right" class="content">
<form method="post" action="#">

    
    :اسم المادة العلمية <br> 
    <input style="text-align: right;" type="text" name="courseName">
<br>
<br>
<button class="myButton" type="submit" name="hwSubmit" class="btn btn-default sm">إضافة</button>
</form>
		</div>
	</div>
</div>
	
	';
//popup window (form to add the new lesson)
	if(isset($_POST["hwSubmit"])){

	$courseName = "";
                $courseName = $_POST['courseName'];
				$IscourseNameUsed = false;		
				
                if ($courseName == "") {
                    $RegisterMessage = "Please Enter All Information";
                } else {
                    try {
						$query1 = "SELECT courseName FROM courses where courseName='$courseName' AND
						courseName='$courseName'";
						$co = mysqli_query($conn,$query1);
						$row = mysqli_fetch_array($co);
						if($row["courseName"] == $courseName)
                          $IscourseNameUsed = true;

                        if (!$IscourseNameUsed) {
                            $qur = "INSERT INTO `courses` VALUES ('".$courseName."',
							'','')";
                             
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
							<strong>فشل!</strong> لقد تم إضافة هذه المادة مسبقاً.
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
	

$qu= "SELECT courseName FROM courses";
$res = mysqli_query($conn,$qu);
while($row1 = $res->fetch_assoc()){
	echo'<a href="lesson.php?course='.$row1['courseName'].'" ><div style="float:right!important;" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<figure>
					<ul class="demoFirst effect">
						<li>
						   <h2 class="zero">!ابدأ الدرس</h2>
						   <p class="zero">'.$row1['courseName'].'</p>
						</li>
						<li><img class="top" src="image/book.jpg" alt=""/></li>
					</ul>
					 <figcaption style="float:right!important; padding-right: 100px;">'.$row1['courseName'].'</figcaption>
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