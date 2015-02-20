<?php
$email = $_GET['email'];
$hash = $GET['hash'];

if($email && $hash){
	require("../../connect_db.php");
	require("../../functions.php");

	$email = mysql_fix_string($email);
	$hash = mysql_fix_string($hash);

	$query = mysql_query("SELECT email, hash, activated FROM users WHERE email='$email' ");
	$count = mysql_num_rows($query);

	if($count != 0){

		while($row = mysql_fetch_assoc($query)){
			$dbemail = $row['email'];
			$dbhash = $row['hash'];
			$dbactivated = $row['activated'];
		}

		if($hash == $dbhash && $dbactivated == 0 ){

			$query = mysql_query("UPDATE users SET activated='1' WHERE email='$email'  ");
			$_SESSION['email'] = $dbemail;
			header("Location: ../../dashboard");

		} else {
			//Hash doesn't match or account has already been activated
			header("Location: ../");
			exit();
		}

	} else {
		//The user doesn't exist
		header("Location: ../");
		exit();
	}

} else {
	//Didn't enter all the fields
	header("Location: ../");
	exit();
}

?>