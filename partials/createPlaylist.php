<?php
    include './dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['createPlaylistSubmitBtn'])){
        // INSERT INTO PLAYLIST
        $title = $_POST['playlistTitle'];
        $qry = "INSERT INTO playlists (title) VALUES ('$title')";
        $result = mysqli_query($conn, $qry);

        // GET NEWLY CREATED PLAYLIST ID
        $qry = "SELECT * FROM playlists WHERE title = '$title'";
        $result = mysqli_query($conn, $qry);
        $row = mysqli_fetch_assoc($result);
        $playlist_id = $row['id'];

        // INSERT INTO PLAYLIST USER
        $user_id = $_SESSION['user_id'];
        $qry = "INSERT INTO playlist_user (playlist_id, user_id) VALUES ('$playlist_id', '$user_id')";
        $result = mysqli_query($conn, $qry);
    }
    header('location: ../playlist.php?id='.$playlist_id);
?>