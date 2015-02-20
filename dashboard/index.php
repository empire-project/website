<?php
session_start();
if($_SESSION['email']){

	require("view.php");

} else {
	header("Location: ../login");
	exit();
}
?>