<?php
include('session.php');
$query=mysqli_query($db,"select * from user where level = 'admin'");
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
      <h2>Data Admin</h2>
      <a href="tambaha.php" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Admin</a>
      <div class="table-responsive">
      <table class="table table-bordered">
		<thead>
			 <tr>
		    <th>NO</th>
		    <th>NAMA</th>
			<th>USERNAME</th>
			<th>PASSWORD</th>
		    <th>TINDAKAN</th>
			
		  </tr>
		</thead>
		<tbody>
			<?php
		  $no=1;
		  while($q=mysqli_fetch_array($query)){
		  ?>
		  <tr>
		    <td><?php echo $no++; ?></td>          
		    <td><?php echo $q['NAMA']?></td>
			<td><?php echo $q['USERNAME']?></td>
			<td><?php echo $q['PASSWORD']?></td>
		    <td>
		    	<a class="btn btn-success" href="edita.php?id_user=<?php echo $q['ID_USER']; ?>">Edit</a>
		    	<a class="btn btn-danger" href="hapusa.php?id_user=<?php echo $q['ID_USER']; ?>">Hapus</a>
		    </td>
			
		  </tr>
          <?php } ?>
		</tbody>
		</table>
        </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>Halo Dosen @2018</p>
</footer>

</body>
</html>
