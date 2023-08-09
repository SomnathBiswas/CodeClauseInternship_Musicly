<?php

    include 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateAlbumBtn'])){

        // GET VALUES FROM FORM DATA
        $album_id = $_POST['albumId'];
        $title = $_POST['albumTitle'];
        $year = $_POST['albumYear'];
        
        if(!empty($_FILES['cover']['name'])){
            $uniqueFileName = time() . '_' . uniqid() . '.jpeg';

            $cover = "./uploads/albumCover/" . $uniqueFileName;
            $qry = "UPDATE albums SET cover='$cover' WHERE id='$album_id'";
            mysqli_query($conn, $qry);

            $file_tmp = $_FILES['cover']['tmp_name'];
            // Move the uploaded file to a desired directory
            move_uploaded_file($file_tmp, "../uploads/albumCover/" . $uniqueFileName);
        }

        // UPDATE ALBUM
        $qry = "UPDATE albums SET title='$title', year='$year' WHERE id='$album_id'";
        mysqli_query($conn, $qry);
        header('location: ../admin/editAlbum.php?id='.$album_id);
    }

?>