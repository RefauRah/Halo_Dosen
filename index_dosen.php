<?php
    include('session.php');
    date_default_timezone_set('Asia/Jakarta');
    $time = date('H:i:s');
    $cek = "18:00:00";
    $cek2 = "23:59:59";
    $query = "select first_login from user where id_user = {$user_id}";
    $result = mysqli_query($db,$query);
    $row = mysqli_fetch_array($result);
    if($row['first_login'] == 1){
      header("location: first_login.php?level={$level}");
    }
    if(strtotime($time) >= strtotime($cek) && strtotime($time) <= strtotime($cek2))
        $title = "Jadwal Mengajar Untuk Besok";
    else
        $title = "Jadwal Mengajar Untuk Hari Ini";
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
	  
	  <h2><?php echo $title; ?></h2>
	  <hr>
	  
                <?php
                    if(strtotime($time) >= strtotime($cek) && strtotime($time) <= strtotime($cek2))
                        $sql = "select * from jadwal where nip = (select nip from dosen where id_user = '".$user_id."') AND hari = dayofweek(CURRENT_DATE)+1";
                    else
                        $sql = "select * from jadwal where nip = (select nip from dosen where id_user = '".$user_id."') AND hari = dayofweek(CURRENT_DATE)";

                    $result = mysqli_query($db, $sql);
                    if(mysqli_num_rows($result) > 0){ ?>
            <div class="table-responsive">
						<table class="table table-hover">
						<tr>
							<th>Matakuliah</th>
							<th>Ruang</th>
							<th>Kelas</th>
							<th>Waktu</th>
							<th>Tindakan</th>
							<th>Tindakan Diambil</th>
					</tr>
					<?php
                        while($row = mysqli_fetch_array($result)){
                            $sql1 = mysqli_query($db,"select nama_mk from matakuliah where kode_mk = (select kode_mk from jadwal where id_jadwal = '".$row['ID_JADWAL']."')");
                            $result1 = mysqli_fetch_array($sql1,MYSQLI_ASSOC);
                            $link1 = "aksi_dosen.php?id_jadwal=".$row['ID_JADWAL']."&masuk=1";
                            $link2 = "aksi_dosen.php?id_jadwal=".$row['ID_JADWAL'];
                            $link3 = "aksi_dosen.php?id_jadwal=".$row['ID_JADWAL']."&ubah=1";
                            echo '<tr>';
                            echo "<td>".$result1['nama_mk']."</td>";
                            echo "<td>".$row['KD_RUANG']."</td>";
                            echo "<td>".$row['KELAS']."</td>";
							echo "<td>".$row['WAKTU']."</td>";
							if($row['TINDAKAN'] == null){
								echo "<td><a href='$link1' class='btn btn-success'>Masuk</a>  <a href='$link2' class='btn btn-primary'>Tindakan Lain</a></td>";
								echo "<td><label class='label label-default'>Belum Ada Tindakan</label></td>";
							}else{
								echo "<td><a href='$link3' class='btn btn-primary'>Ubah Tindakan</a></td>";
								if($row['TINDAKAN'] == 1)
									echo "<td><label class='label label-success'>Masuk</label></td>";
								elseif($row['TINDAKAN'] == 2)
									echo "<td><label class='label label-success'>Libur</label></td>";
								elseif($row['TINDAKAN'] == 3)
									echo "<td><label class='label label-success'>Ganti Jadwal</label></td>";
								elseif($row['TINDAKAN'] == 4)
									echo "<td><label class='label label-success'>Tugas</label></td>";
							}
							echo '</tr>';
              echo '</table>';
              echo '</div>';
                        }
                    }else{
                        if(strtotime($time) >= strtotime($cek) && strtotime($time) <= strtotime($cek2))
                            echo "<div class='alert alert-info'>
							<strong>Info!</strong> Tidak Ada Jadwal Untuk Besok.
						  </div>";
                        else
							echo "<div class='alert alert-info'>
							<strong>Info!</strong> Tidak Ada Jadwal Untuk Hari Ini.
						</div>";
                    }
                ?>
                
	  </div>
	  
    </div>
    <div class="col-sm-2 sidenav">
		<div class="text-center">
			<h2>Menu</h2>
		</div>
      <div class="well">
	  <ul class="nav nav-pills nav-stacked">
  <li class="active"><a href="index_dosen.php">Jadwal Mengajar</a></li>
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