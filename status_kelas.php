<?php
    include('session.php');
    date_default_timezone_set('Asia/Jakarta');
    $time = date('H:i:s');
    $cek = "18:00:00";
    $cek2 = "23:59:59";
    if(strtotime($time) >= strtotime($cek) && strtotime($time) <= strtotime($cek2))
        $title = "Status Kelas Untuk Besok";
    else
        $title = "Status Kelas Untuk Hari Ini";
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
    .row.content {min-height: 847px; height: auto;}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      min-height: 847px;
      height: auto;
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
      <a class="navbar-brand" href="#">Halo Dosen - Halaman Mahasiswa</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="index_mahasiswa.php">Home</a></li>
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
			<p><a href="profile_mhs.php?id_user=<?php echo $user_id;?>" class="label label-primary">My Profile</a></p>
			<img src="icon-mhs.png" class="img-circle" height="65" width="65" alt="Avatar">
			<p><?php echo $login_session;?></p>
		</div>
		<div class="well">
			<p><a href="#" class="label label-primary">SUBSCRIPTIONS</a></p>
			<hr>
			<?php
                            $sql = "select * from subscribe where nim = (select nim from mahasiswa where id_user = '".$user_id."')";
                            $result = mysqli_query($db, $sql);
                            if(mysqli_num_rows($result) > 0){
								
                                while($row = mysqli_fetch_array($result)){
                                    $sql2 = mysqli_query($db,"select nama from user where id_user = (select id_user from dosen where nip = '".$row['NIP']."')");
                                    $result2 = mysqli_fetch_array($sql2,MYSQLI_ASSOC);
                                    $sql3 = mysqli_query($db,"select nama_mk from matakuliah where kode_mk = (select kode_mk from jadwal where id_jadwal = '".$row['ID_JADWAL']."')");
                                    $result3 = mysqli_fetch_array($sql3,MYSQLI_ASSOC);
                                    $sql7 = mysqli_query($db,"select kelas from jadwal where id_jadwal = '".$row['ID_JADWAL']."'");
                                    $result7 = mysqli_fetch_array($sql7,MYSQLI_ASSOC);
                                    echo "<label class='label label-success'>".$result3['nama_mk']." - ".$result7['kelas']."</label><br>";
								}
								
                            }else{
                                echo '<p>Belum ada yang disubscribe</p>';
                            }
                        ?>
		</div>
    </div>
    <div class="col-sm-8 text-left"> 
      <div class="col-sm-12">
	  
	  <h2><?php echo $title; ?></h2>
	  <hr>
    <div class="table-responsive">
	  <table class="table table-condensed">
                    <tr>
                        <th>WAKTU /<br> RUANGAN</th>
                        <th>06:50-08:30</th>
						<th>06:50-09:20</th>
						<th>07:00-08:40</th>
						<th>07:00-09:30</th>
						<th>08:30-10:10</th>
						<th>08:40-10:20</th>
                        <th>08:30-11:00</th>
                        <th>08:40-11:10</th>
                        <th>09:20-11:00</th>
                        <th>09:20-11:50</th>
                        <th>09:30-11:10</th>
                        <th>09:30-12:00</th>
						<th>10:20-12:00</th>
						<th>12:40-14:20</th>
						<th>12:40-15:30</th>
						<th>14:20-16:00</th>
						<th>15:30-18:00</th>
                    </tr>
                    <?php
                        $waktu = array("06:50-08:30", "06:50-09:20", "07:00-08:40", "07:00-09:30", "08:30-10:10", "08:40-10:20", "08:30-11:00", "08:40-11:10", 
                        "09:20-11:00", "09:20-11:50", "09:30-11:10", "09:30-12:00", "10:20-12:00", "12:40-14:20", "12:40-15:30", "14:20-16:00", "15:30-18:00");
                        $sql = "select * from ruang";
                        $result = mysqli_query($db, $sql);
                        while($row = mysqli_fetch_array($result)){
                            echo '<tr>';
                            echo '<th>'.$row['KD_RUANG'].'</th>';
                            for($i=0; $i<17; $i++){
                                if(strtotime($time) >= strtotime($cek) && strtotime($time) <= strtotime($cek2))
                                    $sql2 = mysqli_query($db, "select status_kelas from jadwal where kd_ruang = '".$row['KD_RUANG']."' and waktu = '".$waktu[$i]."' and hari = DAYOFWEEK(CURDATE())+1");
                                else
                                    $sql2 = mysqli_query($db, "select status_kelas from jadwal where kd_ruang = '".$row['KD_RUANG']."' and waktu = '".$waktu[$i]."' and hari = DAYOFWEEK(CURDATE())");

                                $result2 = mysqli_fetch_array($sql2);
                                if($result2['status_kelas'] == 1)
                                    echo "<td><label class='label label-danger'>DIPAKAI</label></td>";
                                elseif($result2['status_kelas'] == 2)
                                    echo "<td><label class='label label-success'>KOSONG</label></td>";
                                else
                                    echo "<td><label class='label label-default'>NODATA</label></td>";
                            }
                            echo '</tr>';
                        }
                    ?>
                </table>
                </div>
	  </div>
	  
    </div>
    <div class="col-sm-2 sidenav">
		<div class="text-center">
			<h2>Menu</h2>
		</div>
      <div class="well">
	  <ul class="nav nav-pills nav-stacked">
  <li><a href="index_mahasiswa.php">Info Terkini</a></li>
  <li><a href="subscribe.php?id_user=<?php echo $user_id;?>">Subscribe Mata Kuliah</a></li>
  <li class="active"><a href="status_kelas.php">Status Kelas</a></li>
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