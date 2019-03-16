<?php

$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
if($_SESSION['admin'] == ""){
  $_SESSION['teacher'] = NULL;
  unset($_SESSION['teacher']);	
}if($_SESSION['teacher'] == ""){
	$_SESSION['admin'] = NULL;
  unset($_SESSION['admin']);
}
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>