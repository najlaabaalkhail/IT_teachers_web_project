<?php require_once('logout.php');?>
<!DOCTYPE html>

<html lang="ar">
<link rel="stylesheet" type="text/css" href="bootstrap-css2.css">
<link rel="stylesheet" type="text/css" href="bootstrap-css.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="commentStyle.css">
<link rel="stylesheet" type="text/css" href="commentBox.css">

<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>


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
                <ul class="nav navbar-nav">
				<li><a  href="<?php echo $logoutAction ?>">تسجيل الخروج</a></li>
				</ul>
				<ul style="margin-right:20px;width:40%;" class="nav navbar-nav navbar-right">

					<li><a  href="courses.php">المحتوى التعليمي</a></li>
                    <li><a  href="teacherList.php">قائمة المعلمات</a></li>
                    <li><a  href="task&quiz.php">المهام والاختبارات</a></li>
					<li><a  href="discussionboard.php?course1=مقدمة">منتدى المناقشات</a></li>					
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
		