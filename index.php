<?php
    include('session.php');

    if(isset($level)){
        if($level == "dosen")
            header("location: index_dosen.php");
        elseif($level == "mahasiswa")
            header("location: index_mahasiswa.php");
        else
            header("location: index_admin.php");
    }
    
?>