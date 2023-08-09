<?php

    include 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateGenreBtn'])){

        // GET VALUES FROM FORM DATA
        $genre_id = $_POST['genreId'];
        $title = $_POST['genreTitle'];

        // UPDATE ALBUM
        $qry = "UPDATE genre SET title='$title' WHERE id='$genre_id'";
        mysqli_query($conn, $qry);
        header('location: ../admin/editGenre.php?id='.$genre_id);
    }

?>