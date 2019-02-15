<?php
    include('db_conn.php');
    $nom = 5;
    if(isset($_POST['tambah'])){
        $nom += $_POST['nilai'];
    }
?>
<html>
    <body>
        <?php
            $sql = mysqli_query($db,"select * from matakuliah limit $nom");
            while($row = mysqli_fetch_array($sql)){
                echo $row['NAMA_MK'].'<br>';
            }
            date_default_timezone_set('Asia/Jakarta');
            $time = date('H:i:s');
            $cek = "18:00:00";
            $cek2 = "23:59:59";
            if(strtotime($time) >= strtotime($cek) && strtotime($time) <= strtotime($cek2))
                echo 'besok';
            else
                echo 'hari ini';
        ?>
        <form action="" method="post">
            <input type="hidden" name="nilai" value=<?php echo $nom; ?> />
            <input type="submit" name="tambah" value="tambah" />
        </form>
    </body>
</html>