<?php
    include('session.php');

    $nip = $_GET['nip'];
    $idj = $_GET['id_jadwal'];
    $idu = $_GET['id_user'];

    $sql = "delete from subscribe where nim=(select nim from mahasiswa where id_user = '".$idu."') and id_jadwal = '".$idj."'";

    if (mysqli_query($db, $sql)) {
        $info = "Data berhasil dihapus";
        header('location: subscribe.php?id_user='.$idu);
    } else {
        $infoe = "Error deleting record: " . mysqli_error($db);
    }
?>