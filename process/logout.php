<?php
session_start(); 
if ($_SESSION['rol']=='1') {
	session_unset();
	session_destroy();
    
	header("Location: ../index.php");
}else{
	session_unset();
	session_destroy();
	header("Location: ../index.php");
}

