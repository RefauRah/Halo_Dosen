<?php
include('session.php');
$query=mysqli_query($db,"select * from user where id_user=".$_GET['id_user']);
$data = mysqli_fetch_array($query);
if(isset($_POST['editu'])){
  $pass = md5($_POST['password']);
    mysqli_query($db,"UPDATE user SET nama='$_POST[nama]',
				username='$_POST[username]',
				password='$pass',
				email='$_POST[email]',
				no_telp='$_POST[notelp]'
        WHERE id_user='$_POST[id]'");
        header("location: datauser.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: DarkSlateGray;
      color: white;
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
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h4>Dashboard Admin</h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="datauser.php">Manage Data User</a></li>
        <li class="active"><a href="dataadmin.php">Manage Data Admin</a></li>
        
      </ul><br>
      <hr>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="logout.php" class="btn btn-danger">Logout</a></li>
      </ul><br>
    </div>

    <div class="col-sm-9">
      <h2>Edit User</h2>
      <form role="form" method="post" action="">
	          <input type="hidden" name="id" value="<?php echo $data['ID_USER']; ?>">
	           <input type="hidden" name="type" value="data_user">
	            <input type="hidden" name="cmd" value="edit">
	            <!-- text input -->
	            <div class="form-group">
	              <label>Nama</label>
	              <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data['NAMA']; ?>"/>
							</div>
							<div class="form-group">
	              <label>Username</label>
	              <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $data['USERNAME']; ?>"/>
							</div>
							<div class="form-group">
	              <label>Password</label>
	              <input type="password" class="form-control" name="password" placeholder="Password" value=""/>
	            </div>
	            <div class="form-group">
	              <label>Email</label>
	              <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $data['EMAIL']; ?>"/>
	            </div>
	            <div class="form-group">
	              <label>No Telp</label>
	              <input type="text" class="form-control" name="notelp" placeholder="No.Telp" value="<?php echo $data['NO_TELP']; ?>"/>
							</div>
							

	            <button type="submit" class="btn btn-success" name="editu"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-backward"></i> Kembalikan Data</button>
	            <a href="datauser.php" class="btn btn-danger"> <i class="fa fa-times"></i>  Batal</a>
	          </form>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Halo Dosen @2018</p>
</footer>

</body>
</html>
