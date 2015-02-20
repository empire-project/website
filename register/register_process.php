<?php
session_start();

$email     = $_POST['email_register'];
$password  = $_POST['password_register'];
$rpassword = $_POST['rpassword_register'];

if ($email && $password && $rpassword) {
    
    if ($password === $rpassword) {
        
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        
        if ($uppercase && $lowercase && $number && strlen($password) >= 8) {
            require("../connect_db.php");
            require("../functions.php");
            
            $email     = mysql_fix_string($email);
            $password  = mysql_fix_string($password);
            $rpassword = mysql_fix_string($rpassword);
            
            $query = mysql_query("SELECT email FROM users WHERE email='$email' ");
            $count = mysql_num_rows($query);
            
            if ($count == 0) {
                
                
                
                $hash = md5(uniqid(mt_rand(), true));
                
                $query   = mysql_query("INSERT INTO users VALUES ('','$email','$password','','$hash','0') ");
                $to      = $email;
                $from = 'noreply@empirecoin.co';
                $subject = "Activate your account!";
                
                $headers = "From: " . strip_tags($from) . "\r\n";
  				$headers .= "Reply-To: ". strip_tags($from) . "\r\n";
  				$headers .= "CC: info@phpgang.com\r\n";
  				$headers .= "MIME-Version: 1.0\r\n";
  				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                
                $body    = "
                <html>
                <body>
                <p>Hello,<br>
                please confirm your account with the link below:<br>
                <a href='http://empirecoin.co/login/activate?email=$to&hash=$hash'>http://empirecoin.co/login/activate?email=$to&hash=$hash</a>
				Thank you!
				</p>
				";
                //Send email
                mail($to, $subject, $body, $headers);
                
                
                echo "<span id='success'>We have sent you an email, please confirm your account to log in </span>";
                
                
            } else {
                echo "<span id='error'>The email you entered has already been registered</span>";
            }
            
        } else {
            echo "<span id='error'>Your password must be at least 8 characters long and contain an uppercase letter, lowercase letter, and a number</span>";
        }
        
    } else {
        echo "<span id='error'>The passwords you entered do not match</span>";
    }
    
} else {
    echo "<span id='error'>Please complete all the required fields</span>";
}
?>