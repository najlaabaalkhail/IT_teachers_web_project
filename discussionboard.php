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

button {
	margin: 10px;
}
.navtest
 {
	  border:1px solid #eee;
      padding: 10px;
}


</style>

  
<div class="container">
    <div class="row">
	<br>
	<br>

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

$qu= "SELECT courseName FROM courses";
$res = mysqli_query($conn,$qu);

          echo'<nav class="navbar  navtest">           
                <ul class="nav navbar-nav navbar-right" >
                    ';
while($row1 = $res->fetch_assoc()){
	echo'<li><a style="color:#0000b3;" type="submit" href="discussionboard.php?course1='.$row1['courseName'].'">
	'.$row1['courseName'].'</a></li>';
	
}
echo '<li><a style="color:#0000b3;" href="discussionboard.php?course1=مقدمة">مقدمة</a></li> </ul>
        </nav>
		';




		if(isset($_GET['course1'])){
			if($_GET['course1'] == 'مقدمة'){
				echo'<div align="center"><h3>'.$_GET['course1'].'</h3></div>';
				echo'
				<br>
				<div class="container">
				<div style="text-align:right; margin-right: 30px;" id="a" >
				<div  align="center">
				<p style="font-size:18px;"> في حال انتهائك من كل مادة علمية شاركنا "ماذا تعلمت!" حتى تعم الفائدة للجميع</p>
				</div>
				
		      </div>
		</div>';
			}else{
				echo'<div align="center"><h3>'.$_GET['course1'].'</h3></div>';
			echo'
			<div class="container">

    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
    						<div class="widget-area no-padding blank">
								<div class="status-upload">
									<form method="post" action="">
										<textarea style="text-align: right;
										" type=text" id="comment" name="comment" 
										placeholder="ماذا استفدت من الدورة؟" ></textarea>
										
										<button type="submit" name="submit" 
										class="blue  green">تعليق</button>
									</form>
								</div><!-- Status Upload  -->
							</div><!-- Widget Area -->
						</div>
        
    </div>
	<div class="col-md-1"></div>
</div>
<br>';
          
			
			if(isset($_POST["submit"])){
                $query ="";
                $comment = $_POST['comment'];
				
				
				if($_SESSION["admin"] == ""){
				$query = "INSERT INTO `discussionboard`
					   VALUES ('', '".$comment."', '".$_GET['course1']."','".$_SESSION['teacher']."',
					   'T')";
				}else{
					$query = "INSERT INTO `discussionboard` 
					   VALUES ('', '".$comment."', '".$_GET['course1']."','".$_SESSION['admin']."',
					   'A')";
				}
				mysqli_query( $conn,$query );
			
			if($_SESSION["admin"] == ""){
			    $query2 = "SELECT courseName FROM joincourses WHERE 
				courseName='".$_GET['course1']."' AND email='".$_SESSION['teacher']."'";
				$result2 = mysqli_query( $conn,$query2 );
				$row2 = mysqli_num_rows($result2);
				
				if($row2 > 0){
					$query3 = "UPDATE joincourses SET commentDone = 1
					WHERE courseName='".$_GET['course1']."' AND email='".$_SESSION['teacher']."' ";
				    mysqli_query( $conn,$query3 );
				}
			}
										 
                             
}
    $sql = "SELECT * FROM `discussionboard` WHERE courseName='".$_GET['course1']."'
	order by `id` desc";
    $result = $conn->query($sql);
	$sqll2 ="";
	$result2 ="";
	$row2 ="";
	$sql3 ="";
	$result2 ="";
	$row2 ="";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if($row["type"] == "T"){
		  $sql2 = "SELECT firstName, lastName FROM `teacher` WHERE email='".$row["email"]."'";
		  $result2 = $conn->query($sql2);
		  $row2 = $result2->fetch_assoc();
		}else if($row["type"] == "A"){
		  $sql3 = "SELECT name FROM `admain` WHERE email='".$row["email"]."'";
		  $result3 = mysqli_query( $conn, $sql3);
		  $row3 = $result3->fetch_assoc();
		}
	
        
        echo "
		<br>
		<div class='row'>
     <div class='col-md-1'></div>
    <div class='col-md-10'>
            <div class='panel panel-white post panel-shadow'>
                <div class='post-heading'>
                    
                    <div align='right'>
                        <div class='title h5'>";
						
						if($_SESSION["teacher"] == ""){
							
			            	echo "
						<div align='left'>	
						  <form action='' method='post'>
						    <input type='hidden' name='email' value='".$row["email"]."'/>
							<input type='hidden' name='id' value='".$row["id"]."'/>
			  	            <button type='submit' name='submit3'>
                               <img src='image/delete.png' alt='حذف'>
                            </button>
							</form>
		                </div>";
						
						
            			}
			
						if($row["type"] == "T"){
                            echo "<a href=''><b>".$row2["firstName"]." ".$row2["lastName"]."</b></a>";
						}else if($row["type"] == "A"){
							echo "<a href=''><b>".$row3["name"]."</b></a>";
						}
						
			
			echo "
                        </div>

                    </div>
                </div> 
				<br>
				<br>
                <div class='post-description' align='right'> 
                    <p>".$row["comment"]."</p>
                   
                </div>
				
            </div>
        </div>
		<div class='col-md-1'></div>
		</div>";	
}
}
			}	
	
}

              if(isset($_POST["submit3"])){
				$sql4 = "DELETE FROM `discussionboard` WHERE id='".$_POST["id"]."' 
				         AND email='".$_POST["email"]."'";
				$conn->query($sql4);	
				echo'
		          <script language="javascript">
                     window.location.href="discussionboard.php?course1='.$_GET['course1'].'";		  
                  </script>
		           ';
						}
						
$conn->close();
		
		?>
    </div>
</div>

</body>
</html>