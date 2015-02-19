<?php
session_start();
$email = $_POST['email_login'];
$password = $_POST['password_login'];

if($email && $password){
	require("../connect_db.php");
	require ("../functions.php");

	$email = mysql_fix_string($email);
	$password = mysql_fix_string($password);

	$query = mysql_query("SELECT email , password ,activated FROM users WHERE email='$email' ");
	$count = mysql_num_rows($query);

	if($count != 0){

		while($row = mysql_fetch_assoc($query)){
			$dbemail = $row['email'];
			$dbpassword = $row['password'];
			$activate = $row['activated'];
		}

		if ($email == $dbemail && $password == $dbpassword){

			if($activated == 1){
				
				$_SESSION['email'] = $dbemail;
				sleep(2);
				header("Location: ../dashboard");
				exit();

			} else {
				echo "<span id='error'>Please check your email to activate your account</span>";				
			}

		} else {
			echo "<span id='error'>The email or password you entered are incorrect</span>";
		}

	} else {
		echo "<span id='error'>The user you entered does not exist</span>";
	}
} else {
	echo "<span id='error'>Please complete all the required fields</span>";
}

?>