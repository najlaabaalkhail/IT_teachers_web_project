<?php require_once('header.php');?>

<style>
body {

  background: url("image/p2.jpg") no-repeat;
  background-size: cover;
  height: 100vh;
  color:white;
}

@import url(http://fonts.googleapis.com/earlyaccess/amiri.css);

.mainHeader {
  text-align: center;
  color: black;
  margin: 70px 0;
  font-family: 'Amiri', serif;
}

<!--.box {
  width: 40%;
  margin: 0 auto;
  background:black;
  padding: 25px;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
  font-size: 1.5em;
}-->

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

}
.overlay:target {
  visibility: visible;
  opacity: 1;
    overflow: auto;
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

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
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

li {
    display: inline;
}

a {
    color: black;
}
p, a span {
    color: black;
}

.p{
color : black;}
}
@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}

.a1:hover, .a2, .c2, .d2, .e2, .f3, .f4 {
  color: #3f51b5;
  background:#0b212f;
  background-color: transparent;
}

</style>
<div class="mainHeader">

<h1>مرحبـاً بك</h1>

</div>

<body>
<!--login-->
<div align="center">
 <div class="p">
<form action="#" method="post">

 <ul>
   <li><strong><h4>: البريد الألكتروني</h4></strong></li>
     <li><input type="email" id="email" name="email"> </li>

  </ul>
  <ul>
  <li> <strong><h4>:كلمة المرور</h4></strong> </li>
    <li> <input type="password" id="password" name="password"> </li>

  </ul>
  <br>
  
  <ul>
 <li> معلم <input type="radio" name="type" id="type" value="admin"></li>
 <li> مشرف <input type="radio" name="type" id="type" value="teacher" checked>  </li>
  </ul>
  <br>

   <input class="myButton" type="submit" name="submit" class="a1" value="تسجيل دخول">

  <!--<button class="a1"><span>I'm a button</span></button><span class="desc">-->

</form>
</div>
<!-- regist info the link missed -->

<p><a href="regForm.php">لا تملك حساباً؟</a></p>
</div>
</body>
</html>