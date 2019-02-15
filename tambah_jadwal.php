<?php
    include('session.php');

    if(isset($_POST['tbj'])){
        $matkul = $_POST['matkul'];
		$hari = $_POST['hari'];
		$waktu = $_POST['waktu'];
		$ruang = $_POST['ruang'];
        $kelas = $_POST['kelas'];
        $max = sizeof($_POST['matkul']);
        for($i=0;$i<$max;$i++){
			if($i==0)
				$sql = "INSERT INTO jadwal (kd_ruang, kode_mk, nip, waktu, kelas, hari)
				VALUES ('".$ruang[$i]."','".$matkul[$i]."',(select nip from dosen where id_user = '".$user_id."'),'".$waktu[$i]."','".$kelas[$i]."','".$hari[$i]."');";
			elseif($i==$max-1)
				$sql .= "INSERT INTO jadwal (kd_ruang, kode_mk, nip, waktu, kelas, hari)
				VALUES ('".$ruang[$i]."','".$matkul[$i]."',(select nip from dosen where id_user = '".$user_id."'),'".$waktu[$i]."','".$kelas[$i]."','".$hari[$i]."')";
			else
				$sql .= "INSERT INTO jadwal (kd_ruang, kode_mk, nip, waktu, kelas, hari)
				VALUES ('".$ruang[$i]."','".$matkul[$i]."',(select nip from dosen where id_user = '".$user_id."'),'".$waktu[$i]."','".$kelas[$i]."','".$hari[$i]."');";
		}
        if (mysqli_multi_query($db, $sql)) {
            $info = "Data berhasil ditambahkan";
        } else {
            $infoe = "Error inserting record: " . mysqli_error($db);
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
	  
	  <h2>Tambah Jadwal Mengajar</h2>
	  <hr>
	  <div style="color:green;">
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
                <form method="post" action="" class="form-inline">
				<div class="test-container">
					<div class="test0" id="test0">
						<select name = "matkul[]" class="form-control">
						  <?php
							$sql = "select * from matakuliah";
							
							$result = mysqli_query($db,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='".$row["KODE_MK"]."'>".$row["NAMA_MK"]."</option>";
							}
							?>
						</select>
						<select name = "hari[]" style = "margin-left: 10px;" class="form-control">
						  <option value="" selected>Pilih Hari</option>
						  <option value="2">Senin</option>
						  <option value="3">Selasa</option>
						  <option value="4">Rabu</option>
						  <option value="5">Kamis</option>
						  <option value="6">Jumat</option>
						</select>
						<select name = "waktu[]" style = "margin-left: 10px;" class="form-control">
						  <option value="" selected>Pilih Waktu</option>
						  <option value="06:50-08:30">06:50-08:30</option>
						  <option value="06:50-09:20">06:50-09:20</option>
						  <option value="07:00-08:40">07:00-08:40</option>
						  <option value="07:00-09:30">07:00-09:30</option>
						  <option value="08:30-10:10">08:30-10:10</option>
						  <option value="08:40-10:20">08:40-10:20</option>
						  <option value="08:30-11:00">08:30-11:00</option>
						  <option value="08:40-11:10">08:40-11:10</option>
						  <option value="09:20-11:00">09:20-11:00</option>
						  <option value="09:20-11:50">09:20-11:50</option>
						  <option value="09:30-11:10">09:30-11:10</option>
						  <option value="09:30-12:00">09:30-12:00</option>
						  <option value="10:20-12:00">10:20-12:00</option>
						  <option value="12:40-14:20">12:40-14:20</option>
						  <option value="12:40-15:30">12:40-15:30</option>
						  <option value="14:20-16:00">14:20-16:00</option>
						  <option value="15:30-18:00">15:30-18:00</option>
						</select>
						<select name = "ruang[]" style = "margin-left: 10px;" class="form-control">
						  <option value="" selected>Pilih Ruang</option>
						  <?php
							$sql = "select * from ruang";
							
							$result = mysqli_query($db,$sql);
							while($row = mysqli_fetch_array($result)){
								echo "<option value='".$row["KD_RUANG"]."'>".$row["NAMA_RUANG"]."</option>";
							}?>
						</select>
						<select name = "kelas[]" style = "margin-left: 10px;" id="akhir" class="form-control">
						  <option value="" selected>Pilih Kelas</option>
						  <option value="A">A</option>
						  <option value="B">B</option>
						  <option value="C">C</option>
						  <option value="D">D</option>
						  <option value="E">E</option>
						  <option value="F">F</option>
						  <option value="G">G</option>
						  <option value="H">H</option>
						</select>
						<button type="button" class="btnRemove btn btn-danger">Hapus</button><br><br>
					</div>
					<div id="clonedItem"></div>		
				</div>
				<button type="button" id="add" class="btn btn-success">Tambah Baris</button>
				<hr>
                <input type="submit" name="tbj" value="Submit" class="btn btn-primary"/>
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
  <li class="active"><a href="atur_jadwal.php?id_user=<?php echo $user_id;?>">Atur Jadwal Mengajar</a></li>
</ul>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Halo Dosen - 2018</p>
</footer>

</body>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="myjs.js"></script>
</html>