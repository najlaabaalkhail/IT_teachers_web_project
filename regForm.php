<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>

<?php
ob_start();
	session_start();
	
	if(isset($_SESSION['teacher']) != ""){
		header("Location: tetcherhomepage.php");
	}
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

if(isset($_POST["submit"])){
	

	$firstName = $midName = $lastName = $password = $email = $phone = $qualification = $yearsOfService = "";
	$school = $level =$admin=$office ="";
               

                $firstName = $_POST['firstName'];
				$midName = $_POST['midName'];
				$lastName = $_POST['lastName'];
                $password = $_POST['password'];
				$email = $_POST['email'];
                $phone = $_POST['phone'];
                $qualification = $_POST['qualification'];
                $yearsOfService = $_POST['yearsOfService'];
				$school = $_POST['school'];
				$level = $_POST['level'];
				$office = $_POST['office'];
				$admin = $_POST['admin'];
				$IsEmailUsed = false;
				
				
				
				$sql="SELECT email FROM admain WHERE name = '$admin'";
				$result1 = mysqli_query( $conn,$sql );
				$row1 = $result1->fetch_assoc();
				
                if ($email == "" || $password == "" || $phone == "") {
                    $RegisterMessage = "Please Enter All Information";
                } else {
                    try {
						$query1 = "SELECT email FROM teacher where email='$email'";
						$co = mysqli_query($conn,$query1);
						$row = mysqli_fetch_array($co);
						if($row["email"] == $email)
                          $IsEmailUsed = true;

                        if (!$IsEmailUsed) {
                            $registerState = "INSERT INTO `teacher` (`firstName`, `midName`, `lastName`, `password`, `email`, `phone`,
							`qualification`, `yearsOfService`, `school`, `level`, `office`,`adminEmail`)
VALUES ( '".$firstName."', '".$midName."','".$lastName."','".$password."','".$email."','".$phone."',
'".$qualification."','".$yearsOfService."','".$school."','".$level."','".$office."','".$row1["email"]."')";
                             
                            if (( $result = mysqli_query( $conn,$registerState ) )) {
                                echo "Account Has Been Registerd.";

                              //  Login
							  $_SESSION['teacher'] = $email;
				              header("Location: tetcherhomepage.php");
                            }
                         else {
                            echo "Failed To Register The Account.";
							}
							
					  }else{
						 echo "email is used."; 
					  }
						
                    } catch (Exception $ex) {
                        echo "Error While Registering the account";
                    }
                }
            } else {
                echo "Please Enter All Required Values.";
            }




?>


<style type="text/css">
	@font-face {
    font-family: 'Fira Sans';
    src: local('FiraSans-Regular'),
    url('/media/fonts/FiraSans-Regular.woff2') format('woff2');
}

legend {
    background-color: #000;
    color: #fff;
    padding: 3px 6px;
}

input,
label {
    width: 43%;
}

input {
    margin: .5rem 0;
    padding: .5rem;
    border-radius: 4px;
    border: 1px solid #ddd;
}

label {
    display: inline-block;
    font-size: .8rem;
}

input:invalid + span:after {
    content: '✖';
    color: red;
    padding-left: 5px;
}

input:valid + span:after {
    content: '✓';
    color: green;
    padding-left: 5px;
}

.warning {
    font-size: .65rem;
    color: #e67d09;
}

.submit {
    width: 92%;
    margin: 0 auto;
}

</style>
<body align="right">

<h2 align="center">تسجيل كمتدرب جديد</h2>
<p> النموذج إدناه خاص بمعلمات منطقة الرياض* </p>



<form  method="post" action="#">

	<div>
            
            <input type="text" id="firstName" name="firstName"
                   pattern="/^[\x{0600}-\x{06FF}]+$/u"
                   maxlength="12" minlength="2" placeholder="" value="نجلاء" required />
                   <span></span>

                   <label for="display-name"> الأسم الأول:
                <span class="warning">*حروف فقط</span> 
            </label>
            
        </div>

        <div>
           
            <input type="text" id="midName" name="midName"
                   pattern="/^[\x{0600}-\x{06FF}]+$/u"
                   maxlength="12" minlength="2" placeholder="" value="م" required />
            <span></span>
             <label for="display-name"> اسم الأب:
                <span class="warning">*حروف فقط</span> 
            </label>
        </div>

         <div>
            
            <input type="text" id="lastName" name="lastName"
                   pattern="/^[\x{0600}-\x{06FF}]+$/u"
                   maxlength="20" minlength="2" placeholder="" value="ي" required />
            <span></span>
            <label for="display-name"> اسم العائلة :
                <span class="warning">*حروف فقط</span> 
            </label>
        </div>


         <div>
            
            <input type="password"  id="password" name="password" value="11111111"
                   
                   maxlength="15" minlength="8" placeholder="" onkeyup='check();' required />
            <span></span>
            <label for="display-name"> كلمة المرور :
            </label>
        </div>

        <div>
            
            <input type="password"  id="password2" name="password2" value="11111111"
                   
                   maxlength="15" minlength="8" placeholder=""  onkeyup='check();' required />
            <span></span>
            <label for="display-name"> تأكيد كلمة المرور:
            </label>
        </div>
		<span id='message'></span>
		

		<!-- check password simlarty -->
		<script>
		
		var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('password2').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}

		</script>

        <div>
            
            <input type="text"  id="email" name="email"
                   pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$"
                   maxlength="50" minlength="8" placeholder="" required />
            <span></span>
            <label for="display-name"> البريد الإلكتروني :
            </label>
        </div>

         <div>
            
            <input type="text"  id="phone" name="phone" value="11111111111"
                   pattern="[0-9]*"
                   maxlength="10" minlength="10"  required />
            <span></span>
            <label for="display-name"> رقم الجوال :
            </label>
        </div>

        <div>
           
            <input type="text"  id="qualification" name="qualification" value="بكالوريوس"
                   
                      required />
            <span></span>
             <label for="display-name"> المؤهل :
            </label>
        </div>

        <div>
           
            <input type="text"  id="yearsOfService" name="yearsOfService"
                   
                    minlength="1" value="5" required />
            <span></span>
             <label for="display-name"> سنوات الخدمة :
            </label>
        </div>


        <div>
           
            <input type="text"  id="school" name="school" value="333"
                   
                    minlength="2"  required />
            <span></span>
             <label for="display-name"> المدرسة :
            </label>
        </div>

        <div>
  

  <select id="level" name="level">
    <option value="متوسط">متوسط</option>
    <option value="ثانوي">ثانوي</option>

    <option value="متوسط" selected>-- الرجاء اختيار المرحلة --</option>
  </select>

  <label for="display-name">مرحلة التدريس : </label>
  </div>
<br>
<div>
  <select id="office" name="office">
    <option value="شمال"> شمال </option>
    <option value="النهضة"> النهضة </option>
    <option value="الراوبي"> الراوبي </option>
    <option value="جنوب"> جنوب </option>
    <option value="غرب"> غرب </option>
    <option value="الشفاء"> الشفاء </option>
    <option value="البديعة"> البديعة </option>
    <option value="الحرس"> الحرس </option>
    <option value="وسط"> وسط </option>
    <option value="الرماح"> الرماح </option>
    <option value="المزاحمية"> المزاحمية </option>
    <option value="ضرما"> ضرما </option>
    <option value="ثادق"> ثادق </option>
    <option value="حريملاء"> حريملاء </option>
    <option value="العيينة"> العيينة </option>
    <option value="ضرما" selected>-- الرجاء اختيار المكتب --</option>
    
  </select>

   <label for="display-name"> مكتب التعليم :  </label>
</div>
<br>
<br>
<div>
  <select name="admin">
  <?php  
      $qur3="SELECT name FROM admain";  
	  if($result2= mysqli_query($conn,$qur3)){
		  while($row2= $result2->fetch_assoc()){
			  echo '<option value="'.$row2["name"].'">'.$row2["name"].'</option>';
		  }
		  
	  }else{
		  echo "no admin";
	  }
  ?>
  <option value="none" selected>-- الرجاء اختيار اسم المشرف --</option>
    
  </select>
    <label for="display-name">المشرف : </label>

  </div>
  <br>
  <input class="myButton" type="submit" name="submit" value="تسجيل">
</form> 

<?php $conn->close(); ?>


</body>
</html>
