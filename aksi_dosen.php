<?php
	include('session.php');
	
	if(isset($_GET['masuk'])){
		$sql = "insert into news (nip, id_jadwal, jenis_news, tgl_post) values ((select nip from jadwal where id_jadwal = '".$_GET['id_jadwal']."'), '".$_GET['id_jadwal']."', 'infomasuk', NOW());";
		$sql .= "update jadwal set tindakan = 1, status_kelas = 1 where id_jadwal = '".$_GET['id_jadwal']."'";
		 
		if(mysqli_multi_query($db, $sql)){
			header("location: index_dosen.php");
		}
	}elseif(isset($_GET['ubah'])){
		if(isset($_POST['caw'])){
			$jenis = $_POST['jenis'];
			$deskripsi = $_POST['deskripsi'];
			if($jenis == "infomasuk"){
        $tindakan = 1;
        $statkls = 1;
      }
			elseif($jenis == "libur"){
        $tindakan = 2;
        $statkls = 2;
      }
			elseif($jenis == "ganti"){
        $tindakan = 3;
        $statkls = 2;
      }
			elseif($jenis == "tugas"){
        $tindakan = 4;
        $statkls = 1;
      }

			$sql3 = "update news set jenis_news = '".$jenis."', deskripsi = '".$deskripsi."', tgl_post = NOW() where id_news = (select * from (select id_news from news where id_jadwal = '".$_GET['id_jadwal']."' order by tgl_post desc limit 1) n);";
			$sql3 .= "update jadwal set tindakan = '".$tindakan."', status_kelas = '".$statkls."' where id_jadwal = '".$_GET['id_jadwal']."'";
			if(mysqli_multi_query($db, $sql3)){
				header("location: index_dosen.php");
			}else{
                echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
            }
		}
	
	}else{
		if(isset($_POST['caw'])){
			$jenis = $_POST['jenis'];
			$deskripsi = $_POST['deskripsi'];
			if($jenis == "infomasuk"){
        $tindakan = 1;
        $statkls = 1;
      }
			elseif($jenis == "libur"){
        $tindakan = 2;
        $statkls = 2;
      }
			elseif($jenis == "ganti"){
        $tindakan = 3;
        $statkls = 2;
      }
			elseif($jenis == "tugas"){
        $tindakan = 4;
        $statkls = 1;
      }

			$sql2 = "insert into news (nip, id_jadwal, jenis_news, deskripsi, tgl_post) values ((select nip from jadwal where id_jadwal = '".$_GET['id_jadwal']."'),'".$_GET['id_jadwal']."', '".$jenis."', '".$deskripsi."', NOW());";
			$sql2 .= "update jadwal set tindakan = '".$tindakan."', status_kelas = '".$statkls."' where id_jadwal = '".$_GET['id_jadwal']."'";
			if(mysqli_multi_query($db, $sql2)){
				header("location: index_dosen.php");
			}else{
                echo "Error: " . $sql2 . "<br>" . mysqli_error($db);
            }
		}
	}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Halo Dosen</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 847px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Halo Dosen - Halaman Dosen</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index_dosen.php">Home</a></li>
        <li><a href="about.php">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
		<div class="well">
			<p><a href="profile_dosen.php?id_user=<?php echo $user_id;?>" class="label label-primary">My Profile</a></p>
			<img src="icon-mhs.png" class="img-circle" height="65" width="65" alt="Avatar">
			<p><?php echo $login_session;?></p>
		</div>
		<div class="well">
			<p><a href="#" class="label label-primary">Mata Kuliah Diampu</a></p>
			<hr>
			<?php
                    $sql = "select * from jadwal where nip = (select nip from dosen where id_user = '".$user_id."')";
                    $result = mysqli_query($db, $sql);
                    while($row = mysqli_fetch_array($result)){
                        $sql1 = mysqli_query($db,"select nama_mk from matakuliah where kode_mk = (select kode_mk from jadwal where id_jadwal = '".$row['ID_JADWAL']."')");
                        $result1 = mysqli_fetch_array($sql1,MYSQLI_ASSOC);
                        
						echo "<label class='label label-success'>".$result1['nama_mk']." - ".$row['KELAS']."</label><br>";
                    }
                ?>
		</div>
    </div>
    <div class="col-sm-8 text-left"> 
      <div class="col-sm-12">
	  
	  <h2>Tindakan</h2>
	  <hr>
                <form method="post" action="">
					<div class="form-group">
					<label>Jenis Info</label>
					<select name="jenis" class="form-control">
						<option value="tugas">Tugas</option>
						<option value="infomasuk">Masuk</option>
						<option value="ganti">Ganti Jadwal</option>
						<option value="libur">Libur</option>
					</select>
					</div>
					<div class="form-group">
					<label>Deskripsi</label>
					<textarea rows="10" cols="50" name="deskripsi" class="form-control"></textarea>
					</div>
					
					<input type="submit" name="caw" value="SUBMIT" class="btn btn-primary"/>
                </form>
	  </div>
	  
    </div>
    <div class="col-sm-2 sidenav">
		<div class="text-center">
			<h2>Menu</h2>
		</div>
      <div class="well">
	  <ul class="nav nav-pills nav-stacked">
  <li><a href="index_dosen.php">Jadwal Mengajar</a></li>
  <li><a href="atur_jadwal.php?id_user=<?php echo $user_id;?>">Atur Jadwal Mengajar</a></li>
</ul>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Halo Dosen - 2018</p>
</footer>

</body>
</html>