<?php
    include_once 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createGenreBtn'])){
        // GET VALUES FROM FORM DATA
        $title = $_POST['genreTitle'];

        // INSERT INTO GENRE QUERY
        $qry = "INSERT INTO genre (title) VALUES ('$title')";
        mysqli_query($conn, $qry);

        header('location: ../admin/genre.php');
    }
?>