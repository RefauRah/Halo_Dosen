<?php
    include('session.php');

    $idj = $_GET['id_jadwal'];
    $idu = $_GET['id_user'];

    $sql = "delete from jadwal where nip =(select nip from dosen where id_user = '".$idu."') and id_jadwal = '".$idj."'";

    if (mysqli_query($db, $sql)) {
        $info = "Data berhasil dihapus";
        header('location: atur_jadwal.php?id_user='.$idu);
    } else {
        $infoe = "Error deleting record: " . mysqli_error($db);
    }
?>