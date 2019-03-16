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

<style>
.details li {
    list-style: none;
}
li {
	margin-bottom:10px;
        
}
.embed-responsive{
position:relative;
display:block;
height:0;
padding:0;
overflow:hidden
}
.embed-responsive-item{
position:absolute;
top:0;
bottom:0;
left:0;
width:100%;
height:100%;
border:0;
}
.embed-responsive-1by1{
  padding-bottom:100%;
}
.embed-responsive-21by9{
  padding-bottom:42.85%;
}
.embed-responsive-16by9{
padding-bottom:56.25%
}
.embed-responsive-4by3{
padding-bottom:75%
}
</style>

<body align="right">
</br>		
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
$teacherEmail = $_GET["email"];
$sql = "SELECT * FROM teacher WHERE email='".$teacherEmail."'";

$resu=mysqli_query($conn,$sql);
$row1=mysqli_fetch_array($resu);

echo '<div align="right" style="margin:50px; padding-right:60px" class="well">
    <ul class="nav nav-tabs" align="right">
      <li class="active" align="right"><a href="#profile" data-toggle="tab">ملف المعلم</a></li>
      <li><a href="#course" data-toggle="tab">متابعة سير المعلم</a></li>
      <li><a href="#comment" data-toggle="tab">سجل التعليقات</a></li>
	  </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="profile">
        <form id="tab1">
          
                  <div class="row">
                      <div style="width:40%;margin-right:30px;">
                          <div class="container" style="margin-right:0px; width:40%;border-bottom:1px solid black">
                            <h2>'.$row1["firstName"].' '.$row1["lastName"].'</h2>
                          </div>
						  <br>
                          <ul style="list-style: none;">
                            <li><p>'.$row1["phone"].' <strong>:رقم الجوال</strong></p></li>
                            <li><p>'.$row1["email"].'<strong> :البريد الألكتروني</strong></p></li>
                            <li><p><strong> المؤهل: </strong>'.$row1["qualification"].'</p></li>
							<li><p>'.$row1["yearsOfService"].'<strong>  :سنوات الخدمة </strong></p></li>
                            <li><p>'.$row1["school"].'<strong> : المدرسة </strong></p></li>
                            <li><p><strong> المرحلة: </strong>'.$row1["level"].'</p></li>
                            <li><p><strong>  المكتب: </strong>'.$row1["office"].'</p></li>
                          </ul>
                      </div>
                  </div>
                
        </form>
      </div>';


echo '<div class="tab-pane fade" id="course">
    	<form id="tab2a" action="" method="POST">
        	<label>:الدورات</label>
				<br>';
$tokenCourse = "SELECT * FROM joincourses WHERE email='".$teacherEmail."'";
$courseNames = "SELECT courseName FROM courses";
$tokenResult= mysqli_query( $conn, $tokenCourse );
$namesResult= mysqli_query( $conn, $courseNames );
$flag= FALSE; 
while($namesRow=mysqli_fetch_array($namesResult)){
while($tokenRow=mysqli_fetch_array($tokenResult)){
	if($tokenRow["courseName"] === $namesRow["courseName"]){		
		$flag = TRUE;
		break;
	}
}
if(!$flag){
echo $namesRow["courseName"]. '   <input type="checkbox" value="'.$namesRow["courseName"].'" name="check_list[]" ><br> 
<br>';
}
$flag = FALSE;
mysqli_data_seek($tokenResult,0);
}
mysqli_data_seek($namesResult,0);
echo '<div><button class="myButton" type="submit" name="hwSubmit1" class="btn btn-default sm"> اضافة</button></div>
</form>';

if(isset($_POST['hwSubmit1'])){
	

$course ='';
$em='';
echo $row1["email"];
if(($_POST['check_list'])) {
    foreach($_POST['check_list'] as $check) {
	echo $check;}
}
$sql = "INSERT INTO joincourses (email, courseName) VALUES ('$teacherEmail','$check')" ;


if(mysqli_query($conn,$sql)){
	echo'
		<script language="javascript">
          window.location.href="teacherProfileA.php?email='.$teacherEmail.'";		
        </script>
		';
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
}

echo '<label>جدول متابعة سير المعلم</label>';
mysqli_data_seek($tokenResult,0);


echo '
<table align="center" class="table-responsive col-md-12 col-sm-12 col-lg-12 table table-striped">
  <thead >
  <tr>
 <th style="text-align:right"></th>
<th style="text-align:right">درجة المهام</th>
<th style="text-align:right">المهام</th>
<th style="text-align:right">درجة الأختبارات</th>
<th style="text-align:right">الدورات الحالية</th>
  </tr>
 </thead>
  <tbody>';
  
while($row=mysqli_fetch_array($tokenResult)){
echo ' <tr>
<form id="tab2b" action="#" method="POST">
        <td> <div><button class="myButton" type="submit" name="updateScore" class="btn btn-default sm">حفظ</button></div> </td>
		<td><input class="form-control" type="number" name="taskMark" value="'.$row["taskMark"].'" min="0" max="100"/></td>
		<td style="text-align:right"><a href="upload/'.$row["taskUpload"].'">'.$row["taskUpload"].'</a></td>
		<td><input class="form-control" type="number" name="courseMark" value="'.$row["courseMark"].'" min="0" max="100"/></td>
		<td style="text-align:right">'.$row["courseName"].'</td>	
        <input type="hidden" name="courseName" value="'.$row["courseName"].'"/> 
</form>		
	   </tr>';
	   }
echo '</tbody>
</table> 
<br>
</div>';


$sql4="SELECT * FROM discussionboard WHERE email='".$row1["email"]."'";
$result=$conn->query($sql4);

echo '	  <div class="tab-pane fade" id="comment">
    	<form id="tab3">
		
		<script language="javascript">
          window.location.href="comment"?email='.$teacherEmail.'";		
        </script>
		
		<h4 style="margin-right:30px;">:سجل التعليقات</h4>';

while($row2=mysqli_fetch_array($result)){
echo "
		<br>
		<div class='row'>
     <div class='col-md-1'></div>
    <div class='col-md-10'>
            <div class='panel panel-white post panel-shadow'>
                <div class='post-heading'>
                    
                    <div align='right'>
                        <div class='title h5'>
			<h4>".$row2["courseName"]."</h4>
			<a href=''><b>".$row1["firstName"]." ".$row1["lastName"]."</b></a>

                        </div>

                    </div>
                </div> 
				<br>
				<br>
                <div class='post-description' align='right'> 
                    <p>".$row2["comment"]."</p>
                   
                </div>
				
            </div>
        </div>
		<div class='col-md-1'></div>
		</div>";

}
echo '    	</form>
      </div>
  </div>
</div>';

  if(isset($_POST["updateScore"])){
	  	  
	  $qur = "UPDATE joincourses SET courseMark = '".$_POST["courseMark"]."', taskMark = '".$_POST["taskMark"]."'
              WHERE courseName= '".$_POST["courseName"]."'  AND email='".$_GET["email"]."'";
			  echo $qur;
	  $result1 = $conn->query($qur);
			 
  }
  
  $conn->close();
?>

<script>
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }
}
</script>

<script>
function myfun(){

   note = document.getElementById("note");
   note.innerHTML = "wrong";
   note.style.display = 'none';
 }
</script>
</body>
</html>