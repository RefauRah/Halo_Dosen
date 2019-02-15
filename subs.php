<?php
    include('session.php');

    $nip = $_GET['nip'];
    $idj = $_GET['id_jadwal'];
    $idu = $_GET['id_user'];

    $sql = "insert into subscribe (nim, nip, id_jadwal) values ((select nim from mahasiswa where id_user = '".$idu."'), '".$nip."', '".$idj."')";

    if (mysqli_query($db, $sql)) {
        $info = "Data berhasil ditambahkan";
        header("location: subscribe.php?id_user='".$idu."'");
    } else {
        $infoe = "Error inserting record: " . mysqli_error($db);
    }
?>