<?php

    include 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        // GET VALUES FROM FORM DATA
        $album_id = $_GET['id'];
        
        // UPDATE ALBUM
        $qry = "DELETE FROM albums WHERE id='$album_id'";
        mysqli_query($conn, $qry);
        header('location: ../admin/albums.php?id='.$album_id);
    }

?>