<?php
    include('db_conn.php');
    if(isset($_POST['daftar'])){
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$notelp = $_POST['notelp'];
        $tipeuser = $_POST['tipeuser'];
        
        $sql = "INSERT INTO user (nama, username, password, email, no_telp, level ,first_login)
            VALUES ('".$nama."','".$username."','".$password."','".$email."','".$notelp."','".$tipeuser."', '1')";
        $last_id = null;
		if (mysqli_query($db, $sql)) {
			$last_id = mysqli_insert_id($db);
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($db);
        }
        
        if($tipeuser=="dosen")
            $sql2 = "INSERT INTO dosen (id_user) VALUES ('".$last_id."')";
        else
            $sql2 = "INSERT INTO mahasiswa (id_user) VALUES ('".$last_id."')";

		if (mysqli_query($db, $sql2)) {
            $info = "Username {$username} berhasil didaftarkan. Klik <a href='login.php'>disini</a> untuk Login!";
		} else {
			$infoe = "Error: " . $sql . "<br>" . mysqli_error($db);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Register Ke Halo Dosen</title>
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
				<h3>Register</h3>
				<div style="color:white;">
        <?php
            if(isset($info))
                echo $info;
        ?>
    </div>
    <div style="color:red;">
        <?php
            if(isset($infoe))
                echo $infoe;
        ?>
    </div>
				<div class="login-form">
					<form action="" method="post">
						<input type="text" name="nama" placeholder="Masukkan nama lengkap"/><br>
        <input type="text" name="username" placeholder="Masukkan username"/><br>
        <input type="password" name="password" placeholder="Masukkan password"/><br>
        <input type="text" name="email" placeholder="Masukkan email"/><br>
        <input type="text" name="notelp" placeholder="Masukkan no telp"/><br>
        <input type="hidden" name="tipeuser" value="mahasiswa" />
						<div class="tp">
							<input type="submit" name="daftar" value="Daftar">
						</div>
						
					</form>
				</div>
				<p><a href="login.php"> Have an account ? Click Here</a></p>
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