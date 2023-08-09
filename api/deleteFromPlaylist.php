<?php
    include '../partials/dbConnect.php';

    $track_id = $_GET['track_id'];
    $playlist_id = $_GET['playlist_id'];

    $qry = "DELETE FROM playlist_track WHERE playlist_id='$playlist_id' AND track_id='$track_id'";
    $result = mysqli_query($conn, $qry);

    if($result){
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