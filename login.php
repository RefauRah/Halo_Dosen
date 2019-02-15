<?php
	include("db_conn.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$myusername = mysqli_real_escape_string($db,$_POST['username']);
		$mypassword = mysqli_real_escape_string($db,$_POST['password']);
		
		$sql = "select id_user from user where username = '$myusername' and password = '$mypassword'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		$count = mysqli_num_rows($result);
		
		if($count == 1){
			//session_register("myusername");
			$_SESSION['login_user'] = $myusername;
			
			header("location: index.php");
		}else{
			$error = "Username atau password salah!";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Halo Dosen - Login</title>
<!--Custom Theme files-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Register Login Widget template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login Signup Responsive web template, SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="login.css" rel="stylesheet" type="text/css" media="all" />
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Jura:400,300,500,600' rel='stylesheet' type='text/css'>
<!--//web-fonts-->
</head>
<body>
	<h1>Halo Dosen</h1>
	<!-- main -->
	<div class="main">
		<!--login-profile-->
		
		<!--login-profile-->
		<!--signin-form-->
		<div class="w3">
			<div class="signin-form profile">
				<h3>Login</h3>
				
				<div class="login-form">
					<form action="" method="post">
						<input type="text" name="username" placeholder="Username" required="">
						<input type="password" name="password" placeholder="Password" required="">
						<div style = "color: white; margin-top: 10px;">
						<?php if(isset($error)) echo "<h2>".$error."</h2>"; ?>
					</div>
						<div class="tp">
							<input type="submit" value="LOGIN NOW">
						</div>
					</form>
				</div>
				
				<p><a href="register.php"> Don't have an account?</a></p>
			</div>
		</div>
		
		<div class="clear"></div>
		<!--//signin-form-->	
	</div>
	<div class="copyright">
		<p> &copy; 2018 Halo Dosen . All rights reserved </p>
	</div>					
</body>
</html>