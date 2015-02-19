<!DOCTYPE html>
<html>
<head>
	<title>Login | Empirecoin</title>
	<meta charset="utf-8">
	<style type="text/css">
		#error{
			color: red;
			font-size: 16px;			
		}
		#success{
			color: green;
			font-size: 16px;
		}

	</style>
</head>
<body>
	<form method="post" action="">
		<div class="form-control">
			<input type="email" name="email_register" placeholder="example@email.com" required>
		</div>
		<div class="form-control">
			<input type="password" name="password_register" placeholder="Password" required>
		</div>
		<div class="form-control">	
			<input type="password" name="rpassword_register" placeholder="Repeat password" required>
		</div>
		<div class="form-control">
			<input type="submit" name="submit" value="Register">
		</div>
	</form>
</body>
</html>