<?php
    include('session.php');
    $nom = 5;
    if(isset($_POST['tambah'])){
        $nom += $_POST['nilai'];
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
      <div class="col-sm-6">
	  
	  <h2>List Matakuliah Yang Disubscribe</h2>
	  <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Nama Dosen</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql = "select * from subscribe where nim = (select nim from mahasiswa where id_user = '".$user_id."')";
                            $result = mysqli_query($db, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    $sql2 = mysqli_query($db,"select nama from user where id_user = (select id_user from dosen where nip = '".$row['NIP']."')");
                                    $result2 = mysqli_fetch_array($sql2,MYSQLI_ASSOC);
                                    $sql3 = mysqli_query($db,"select nama_mk from matakuliah where kode_mk = (select kode_mk from jadwal where id_jadwal = '".$row['ID_JADWAL']."')");
                                    $result3 = mysqli_fetch_array($sql3,MYSQLI_ASSOC);
                                    $sql7 = mysqli_query($db,"select kelas,waktu,hari from jadwal where id_jadwal = '".$row['ID_JADWAL']."'");
                                    $result7 = mysqli_fetch_array($sql7,MYSQLI_ASSOC);
                                    if($result7['hari']==2)
                                        $hari = "Senin";
                                    elseif($result7['hari']==3)
                                        $hari = "Selasa";
                                    elseif($result7['hari']==4)
                                        $hari = "Rabu";
                                    elseif($result7['hari']==5)
                                        $hari = "Kamis";
                                    elseif($result7['hari']==6)
                                        $hari = "Jumat";
                                    else
                                        $hari = "Undefined";
                                    echo '<tr>';
                                    echo '<td>'.$result2['nama'].'</td>';
                                    echo '<td>'.$result3['nama_mk'].'</td>';
                                    echo '<td>'.$result7['kelas'].'</td>';
                                    echo '<td>'.$hari.'</td>';
                                    echo '<td>'.$result7['waktu'].'</td>';
                                    $link = "unsub.php?id_user=".$user_id."&nip=".$row['NIP']."&id_jadwal=".$row['ID_JADWAL'];
                                    echo "<td><a href='$link' class='btn btn-danger'>Unsubscribe</a></td>";
                                    echo '</tr>';
                                }
                            }else{
                                echo '<tr>';
                                echo '<td colspan=4><center>Belum ada yang disubscribe</center></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                    </div>
	  </div>
	  <div class="col-sm-6">
	  <h2>List Mata Kuliah Untuk Disubscribe</h2>
	  <hr>
      <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th>Nama Dosen</th>
                            <th>Nama Mata Kuliah</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                        <?php
                            $sql4 = "select * from jadwal where id_jadwal not in(select id_jadwal from subscribe WHERE nim = (select nim from mahasiswa where id_user = '".$user_id."'))";
                            $result4 = mysqli_query($db, $sql4);
                            if(mysqli_num_rows($result4) > 0){
                                while($row = mysqli_fetch_array($result4)){
                                    $sql5 = mysqli_query($db,"select nama from user where id_user = (select id_user from dosen where nip = '".$row['NIP']."')");
                                    $result5 = mysqli_fetch_array($sql5,MYSQLI_ASSOC);
                                    $sql6 = mysqli_query($db,"select nama_mk from matakuliah where kode_mk = (select kode_mk from jadwal where id_jadwal = '".$row['ID_JADWAL']."')");
                                    $result6 = mysqli_fetch_array($sql6,MYSQLI_ASSOC);
                                    if($row['HARI']==2)
                                        $harii = "Senin";
                                    elseif($row['HARI']==3)
                                        $harii = "Selasa";
                                    elseif($row['HARI']==4)
                                        $harii = "Rabu";
                                    elseif($row['HARI']==5)
                                        $harii = "Kamis";
                                    elseif($row['HARI']==6)
                                        $harii = "Jumat";
                                    else
                                        $harii = "Undefined";
                                    echo '<tr>';
                                    echo '<td>'.$result5['nama'].'</td>';
                                    echo '<td>'.$result6['nama_mk'].'</td>';
                                    echo '<td>'.$row['KELAS'].'</td>';
                                    echo '<td>'.$harii.'</td>';
                                    echo '<td>'.$row['WAKTU'].'</td>';
                                    $link = "subs.php?id_user=".$user_id."&nip=".$row['NIP']."&id_jadwal=".$row['ID_JADWAL'];
                                    echo "<td><a href='$link' class='btn btn-success'>Subscribe</a></td>";
                                    echo '</tr>';
                                }
                            }else{
                                echo '<tr>';
                                echo '<td colspan=4><center>Data jadwal belum ada</center></td>';
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
  <li class="active"><a href="subscribe.php?id_user=<?php echo $user_id;?>">Subscribe Mata Kuliah</a></li>
  <li><a href="status_kelas.php">Status Kelas</a></li>
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