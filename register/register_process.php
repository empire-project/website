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
                $subject = "Activate your account!";
                $headers = "From: noreply@empirecoin.co";
                $body    = "
Hello $email,\n\n
You need to activate your account with the link below:\n
http://libertypay.net/email_confirmation.php?id=$lastid&hash=$hash
\n
Thanks!
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