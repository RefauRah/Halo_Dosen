<?php
    include('session.php');

    $sql = "delete from user where id_user = '".$_GET['id_user']."'";

    if(mysqli_query($db,$sql)){
        header("location: datauser.php");
    }else{
        echo mysqli_error($db);
    }
?>