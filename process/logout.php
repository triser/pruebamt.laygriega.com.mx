<?php
session_start(); 
if ($_SESSION['tipo']=='user') {
	session_unset();
	session_destroy();
	header("Location: ../index.php");
}else{
	session_unset();
	session_destroy();
	header("Location: ../sup.php");
}

