<?php
    include('session.php');
    
        if(isset($_POST['profile'])){
            if($level == "mahasiswa"){
                $nim = $_POST['nim'];
                $jurusan = $_POST['jurusan'];
                $semester = $_POST['semester'];
                $sql = "UPDATE mahasiswa SET nim='".$nim."', jurusan='".$jurusan."', semester='".$semester."' WHERE id_user='".$user_id."';";
                $sql .= "UPDATE user SET first_login = 0 where id_user={$user_id}";

        
                if (mysqli_multi_query($db, $sql)) {
                    $info = "Data berhasil diperbarui";
                    header("location: index.php");
                } else {
                    $infoe = "Error updating record: " . mysqli_error($db);
                }
            }else{
                $nip = $_POST['nip'];
                $prodi = $_POST['prodi'];
                $sql = "UPDATE dosen SET nip='".$nip."', prodi='".$prodi."' WHERE id_user='".$user_id."';";
                $sql .= "UPDATE user SET first_login = 0 where id_user={$user_id}";
                if (mysqli_multi_query($db, $sql)) {
                    $info = "Data berhasil diperbarui";
                    header("location: index.php");
                } else {
                    $infoe = "Error updating record: " . mysqli_error($db);
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
      <a class="navbar-brand" href="#">Halo Dosen</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
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
		
    </div>
    <div class="col-sm-8 text-left"> 
      <div class="col-sm-12">
	  
	  <h2>Mohon Isi Profil Anda Untuk Dapat Mengakses Fitur Halo Dosen</h2>
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
      <?php
        if($level == "mahasiswa"){
      ?>
      <form method="post" action="">
                    
					<div class="form-group">
					<label>NIM</label>
                    <input type="text" class="form-control" name="nim" value=""/>
					</div>
					
					<div class="form-group">
					<label>Jurusan</label>
                    <select name = "jurusan" class="form-control">
                        <option value="IF">Teknik Informatika</option>
                        <option value="BIO">Biologi</option>
                        <option value="FIS">Fisika</option>
                        <option value="MAT">Matematika</option>
                        <option value="AGRO">Agroteknologi</option>
                        <option value="KIM">Kimia</option>
                        <option value="TE">Teknik Elektro</option>
                    </select>
					</div>
					
					<div class="form-group">
					<label>Semester</label>
                    <select name = "semester" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
					</div>
                    
                    <input type="submit" class="btn btn-primary" name="profile" value="Simpan Data"/>
                </form>
                <?php
                }else{
                ?>
                <form method="post" action="">
                    
					<div class="form-group">
					<label>NIP</label>
                    <input type="text" name="nip" value="" class="form-control"/>
					</div>
					
					<div class="form-group">
					<label>Prodi</label>
                    <select name = "prodi" class="form-control">
                       
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
                <?php } ?>
	  </div>
	  
    </div>
    <div class="col-sm-2 sidenav">
		
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