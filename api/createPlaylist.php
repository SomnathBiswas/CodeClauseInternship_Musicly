<?php
    include '../partials/dbConnect.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    $playlist_title = $_POST['title'];

    $qry = "INSERT INTO playlists (title) VALUES ('$playlist_title')";
    $result = mysqli_query($conn, $qry);

    // GET NEWLY CREATED PLAYLIST ID
    $qry1 = "SELECT * FROM playlists WHERE title = '$playlist_title'";
    $result1 = mysqli_query($conn, $qry1);
    $row1 = mysqli_fetch_assoc($result1);
    $playlist_id = $row1['id'];

    // INSERT INTO PLAYLIST USER
    $qry2 = "INSERT INTO playlist_user (playlist_id, user_id) VALUES ('$playlist_id', '$user_id')";
    $result2 = mysqli_query($conn, $qry2);

    if($result && $result1 && $result2){
        // Send a response back to the JavaScript
        $response = array('status' => 'success');
        echo json_encode($response);
    }
    else{
        // Send a response back to the JavaScript
        $response = array('status' => 'failed');
        echo json_encode($response);
    }

?>