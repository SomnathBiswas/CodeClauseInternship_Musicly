<?php
    include '../partials/dbConnect.php';

    $playlist_id = $_GET['id'];
    $qry = "DELETE FROM playlists WHERE id = '$playlist_id'";
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