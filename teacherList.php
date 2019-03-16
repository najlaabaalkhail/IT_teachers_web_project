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
<body>
<style>
.info-block
{
    border-left:5px solid #E6E6E6;margin-bottom:25px
}
.info-block .square-box
{
margin-left:22px;text-align:right!important;background-color:#676767;padding:20px 0
}
.info-block.block-info
{
    border-color:#cb6ba
}
.info-block.block-info .square-box
{
    background-color:#ffffff;color:#FFF
}
.form-control{
	float:left;width:100%;margin-bottom:0
}	
</style>
<br>
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

$sql = "SELECT * FROM teacher WHERE adminEmail='".$_SESSION['admin']."'";

$resu=mysqli_query($conn,$sql);
$r="";
echo '<div class="container">
	<div class="row">
		<h2 align="right">قائمة المعلمات</h2>
		
        <div class="col-lg-12">
            <input style="text-align: right;" type="search" class="form-control" id="input-search" placeholder="...ابحثِ عن المعلمة" >
        </div>
		<br>
		<br>
		<br>
		
        <div class="searchable-container">';
while($r=mysqli_fetch_array($resu)){
echo '<a href="teacherProfileA.php?email='.$r["email"].'">
            <div align="right" class="items col-xs-12 col-sm-6 col-md-6 col-lg-6 clearfix">
               <div class="info-block block-info clearfix">
                    <div class="square-box pull-right">
					<span><img src="image/user.png" width="80px" height="80px"></span>
                    </div>
					<br>
                    <h4><strong>الاسم:</strong> '.$r["firstName"].' '.$r["lastName"].'</h4>
                    <span>'.$r["email"].'<strong> :البريد الالكتروني</strong></span>
                </div>
            </div>
		
	</a>';

}
echo '        </div>
	</div>
</div>';	
$conn->close();
?>

<script>
      $(function() {    
        $('#input-search').on('keyup', function() {
          var rex = new RegExp($(this).val(), 'i');
            $('.searchable-container .items').hide();
            $('.searchable-container .items').filter(function() {
                return rex.test($(this).text());
            }).show();
        });
    });          
</script>
</body>
</html>