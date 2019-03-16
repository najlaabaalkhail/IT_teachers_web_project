<?php 

session_start();  
if ($_SESSION['teacher'] == "") {
  header("Location: index.php");
}
?>

<?php require_once('headerT.php');?>

<style>
#note {
    position: absolute;
    z-index: 101;
    top: 0;
    left: 0;
    right: 0;
    background: #fde073;
    text-align: center;
    line-height: 2.5;
    overflow: hidden; 
    -webkit-box-shadow: 0 0 5px black;
    -moz-box-shadow:    0 0 5px black;
    box-shadow:         0 0 5px black;
}
@-webkit-keyframes slideDown {
    0%, 100% { -webkit-transform: translateY(-50px); }
    10%, 90% { -webkit-transform: translateY(0px); }
}
@-moz-keyframes slideDown {
    0%, 100% { -moz-transform: translateY(-50px); }
    10%, 90% { -moz-transform: translateY(0px); }
}
.cssanimations.csstransforms #note {
    -webkit-transform: translateY(-50px);
    -webkit-animation: slideDown 2.5s 1.0s 1 ease forwards;
    -moz-transform:    translateY(-50px);
    -moz-animation:    slideDown 2.5s 1.0s 1 ease forwards;
}
.cssanimations.csstransforms #close {
  display: none;
}
</style> 



   
	<br>
   
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

                $query1="SELECT * FROM joincourses WHERE email='".$_SESSION['teacher']."'";
			    $res1=mysqli_query($conn,$query1);
			 
				while($row1=mysqli_fetch_array($res1)){
					
					if ( ($row1["courseMark"] > -1) & ($row1["taskMark"] > -1) & ($row1["taskUpload"] > -1) & ($row1["commentDone"] == 1) ){
						
						if($row1["courseMark"] < 60){
							$q4 = "UPDATE joincourses SET courseMark=-1, taskMark=-1, commentDone=0, taskUpload=-1
							WHERE courseName='".$row1["courseName"]."' AND email='".$_SESSION['teacher']."'";
							mysqli_query($conn,$q4);
						}else if($row1["courseMark"] >= 60){
							$q2= "INSERT INTO finishcourses (email, courseName, courseMark, taskMark, certificate)
                            VALUES ('".$_SESSION['teacher']."', '".$row1["courseName"]."', '".$row1["courseMark"]."', '".$row1["taskMark"]."', NULL)";
							mysqli_query($conn,$q2);
							
							$q3= "DELETE FROM finishlesson WHERE courseName='".$row1["courseName"]."' AND email='".$_SESSION['teacher']."'";
							mysqli_query($conn,$q3);
							
							
							$q = "DELETE FROM joincourses WHERE courseName='".$row1["courseName"]."' 
							AND email='".$_SESSION['teacher']."'"; 
							mysqli_query($conn,$q); 
						}
						
					}
					
				}
  
  if(isset($_POST["submit"])){
	  
	  $firstName = $midName = $lastName = $password = $phone = $qualification = $yearsOfService = "";
	  $school = $level =$office ="";
	  
	            $firstName = $_POST['firstName'];
				$midName = $_POST['midName'];
				$lastName = $_POST['lastName'];
                $password = $_POST['password'];
                $phone = $_POST['phone'];
                $qualification = $_POST['qualification'];
                $yearsOfService = $_POST['yearsOfService'];
				$school = $_POST['school'];
				$level = $_POST['level'];
				$office = $_POST['office'];
	
	
	  
	  $qur = "UPDATE teacher SET firstName = '$firstName', midName = '$midName', lastName = '$lastName' ,password= '$password' 
	          ,level = '$level' ,school = '$school' ,office = '$office' , qualification = '$qualification' , phone = '$phone' 
              WHERE email='".$_SESSION['teacher']."' ";
			  
			  $result1 = $conn->query($qur);
			  echo '<script type="text/javascript">',
     'myFunction();',
     '</script>'
;
  }




$sql = "SELECT * FROM teacher WHERE email='".$_SESSION['teacher']."' ";
$result = $conn->query($sql);
// output data of the row
 $row = $result->fetch_assoc();


      echo'  
	  
	  <div align="right" style="margin:50px; padding-right:60px" class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#Profile" data-toggle="tab">المعلومات الشخصية</a></li>
      <li><a href="#courses" data-toggle="tab">الدورات السابقة</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="Profile">

	  <form method="post" action="#" id="tab">
	  


        <div class="col-md-6 col-sm-6 col-lg-6"> <br>
		    <label>الهاتف</label>
            <input type="text" name="phone" value="'.$row["phone"].'" class="input-xlarge">
			<label>سنوات الخدمة</label>
            <input type="text" name="yearsOfService" style="text-align: right;" value="'.$row["yearsOfService"].'" class="input-xlarge">	
	        <label>المؤهل</label>	
			<input type="text" name="qualification" style="text-align: right;" value="'.$row["qualification"].'" class="input-xlarge">
			<label>المكتب</label>
            <input type="text" name="office" style="text-align: right;" value="'.$row["office"].'" class="input-xlarge">
			<label>المدرسة</label>
            <input type="text" name="school" style="text-align: right;" value="'.$row["school"].'" class="input-xlarge">
			<label>المرحلة</label>
            <input type="text" name="level" style="text-align: right;" value="'.$row["level"].'" class="input-xlarge">

	    </div>
		<div class="col-md-6 col-sm-6 col-lg-6"> <br>
			<label>الإيميل</label>
            <label> '.$row["email"] .'</label>
			<label>الاسم الأول</label>
            <input type="text" name="firstName" style="text-align: right;" value="'.$row["firstName"].'" class="input-xlarge">
            <label>اسم الأب</label>
            <input type="text" name="midName" style="text-align: right;" value="'.$row["midName"] .'" class="input-xlarge">
            <label>الاسم الاخير</label>
            <input type="text" name="lastName" style="text-align: right;" value="'.$row["lastName"].'" class="input-xlarge">
			<label>كلمة المرور</label>
            <input type="password" name="password" maxlength="15" minlength="8" value="'.$row["password"].'" class="input-xlarge">
          	<div>
			<br> 
        	    <button type="submit" onclick="myfun" name="submit" class="btn btn-primary">تحديث البيانات</button>
				
        	</div>
			<p id="demo"></p>
			</div> 
        </form>
		 </div>
		 
		 <div class="tab-pane fade" id="courses">
    	<form id="tab2">
		
		';
		
		
		echo '
		<div align="right" style="color:red;">
		في حال عدم ظهور المادة العلمية هذا يعني أن درجة النجاح لم تتحقق *
		</div>
		<br>
		 <table align="center" class="table-responsive col-md-12 col-sm-12 col-lg-12 table table-striped">
  <thead >
  <tr>
<th style="text-align:right">الشهادة</th>
<th style="text-align:right">درجة المهمة</th>
<th style="text-align:right">درجة الإختبار</th>
<th style="text-align:right">الدورات السابقة</th>
  </tr>
 </thead>
  <tbody>
  
		';
		
		$sql2 = "SELECT * FROM finishcourses WHERE email='".$_SESSION["teacher"]."'" ;
        $result2 = mysqli_query($conn,$sql2);
		 
while($row2=mysqli_fetch_array($result2)){
echo ' <tr>
		<td style="text-align:right"><a href="upload/'.$row2["certificate"].'">'.$row2["certificate"].'</a></td>		
		<td style="text-align:right">'.$row2["taskMark"].'</td>	
		<td style="text-align:right">'.$row2["courseMark"].'</td>	
		<td style="text-align:right">'.$row2["courseName"].'</td>	
	   </tr>';
	   }
echo '</tbody>
      </table> 	
    	</form>
		';
			
		?>
  </div>
  </div>
<div id="note">

</div>
<script>
function myfun(){

   note = document.getElementById("note");
   note.innerHTML = "wrong";
   note.style.display = 'none';
 }
</script>


<?php $conn->close();?>


</body>
</html> 


