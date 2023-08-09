<?php
    include_once 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["createArtistBtn"])){
        $uniqueFileName = time() . '_' . uniqid() . '.jpeg';
        if(isset($_FILES['cover'])){
            $file_tmp = $_FILES['cover']['tmp_name'];
            // Move the uploaded file to a desired directory
            move_uploaded_file($file_tmp, "../uploads/artistCover/" . $uniqueFileName);
            echo "File uploaded successfully.";
        }

        // GET VALUES FROM FORM DATA
        $title = $_POST['artistName'];
        $cover = "./uploads/artistCover/" . $uniqueFileName;

        // INSERT INTO ARTISTS QUERY
        $qry = "INSERT INTO artists (name, cover) VALUES ('$title', '$cover')";
        mysqli_query($conn, $qry);

        header('location: ../admin/artists.php');
    }
?>