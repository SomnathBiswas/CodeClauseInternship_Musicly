<?php

    include 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateArtistBtn'])){

        // GET VALUES FROM FORM DATA
        $artist_id = $_POST['artistId'];
        $title = $_POST['artistName'];
        
        if(!empty($_FILES['cover']['name'])){
            $uniqueFileName = time() . '_' . uniqid() . '.jpeg';

            $cover = "./uploads/artistCover/" . $uniqueFileName;
            $qry = "UPDATE artists SET cover='$cover' WHERE id='$artist_id'";
            mysqli_query($conn, $qry);

            $file_tmp = $_FILES['cover']['tmp_name'];
            // Move the uploaded file to a desired directory
            move_uploaded_file($file_tmp, "../uploads/artistCover/" . $uniqueFileName);
        }

        // UPDATE ALBUM
        $qry = "UPDATE artists SET name='$title' WHERE id='$artist_id'";
        mysqli_query($conn, $qry);
        header('location: ../admin/editArtist.php?id='.$artist_id);
    }

?>