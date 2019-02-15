<?php
	include('session.php');

    if(isset($_POST['profile'])){
        $nip = $_POST['nip'];
        $prodi = $_POST['prodi'];
        $sql = "UPDATE dosen SET nip='".$nip."', prodi='".$prodi."' WHERE id_user='".$user_id."'";

        if (mysqli_query($db, $sql)) {
            $info = "Data berhasil diperbarui";
        } else {
            $infoe = "Error updating record: " . mysqli_error($db);
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
	  
	  <h2>Edit Profile</h2>
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
                <form method="post" action="">
                    <?php
                        $sql=mysqli_query($db,"select * from dosen where id_user = '".$user_id."'");
                        $hasil = mysqli_fetch_array($sql,MYSQLI_ASSOC);
					?>
					<div class="form-group">
					<label>NIP</label>
                    <input type="text" name="nip" value="<?php echo $hasil["NIP"];?>" class="form-control"/>
					</div>
					
					<div class="form-group">
					<label>Prodi</label>
                    <select name = "prodi" class="form-control">
                        <?php
                            if($hasil["PRODI"]==null)
                                echo "<option value='' selected>Pilih Jurusan</option>";
                            else
                                echo "<option value={$hasil["PRODI"]} selected>{$hasil["PRODI"]}</option>";
                        ?>
                        <option value="IF">Teknik Informatika</option>
                        <option value="BIO">Biologi</option>
                        <option value="FIS">Fisika</option>
                        <option value="MAT">Matematika</option>
                        <option value="AGRO">Agroteknologi</option>
                        <option value="KIM">Kimia</option>
                        <option value="TE">Teknik Elektro</option>
                    </select>
					</div>
                    
                    <input type="submit" name="profile" value="Simpan Data" class="btn btn-primary"/>
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