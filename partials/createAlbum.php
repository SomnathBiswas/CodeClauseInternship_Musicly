<?php
    include_once 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createAlbumBtn'])){
        $uniqueFileName = time() . '_' . uniqid() . '.jpeg';
        if(isset($_FILES['cover'])){
            $file_name = $_FILES['cover']['name'];
            $file_size = $_FILES['cover']['size'];
            $file_tmp = $_FILES['cover']['tmp_name'];
            $file_type = $_FILES['cover']['type'];
            // Move the uploaded file to a desired directory
            move_uploaded_file($file_tmp, "../uploads/albumCover/" . $uniqueFileName);
            echo "File uploaded successfully.";
        }

        // GET VALUES FROM FORM DATA
        $title = $_POST['albumTitle'];
        $year = $_POST['albumYear'];
        $cover = "./uploads/albumCover/" . $uniqueFileName;

        // INSERT INTO ALBUM QUERY
        $qry = "INSERT INTO albums (title, year, cover) VALUES ('$title', '$year', '$cover')";
        mysqli_query($conn, $qry);
        header('location: ../admin/albums.php');
    }
?>