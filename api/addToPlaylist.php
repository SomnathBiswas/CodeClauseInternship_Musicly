
<?php
    include '../partials/dbConnect.php';

    // GET VARIABLES
    session_start();
    $track_id = $_SESSION['song_id'];
    $playlist_id = $_POST['playlist_id'];

    // INSERT TRACK TO PLAYLIST
    $qry1 = "INSERT INTO playlist_track (playlist_id, track_id) VALUES ('$playlist_id', '$track_id')";
    $result1 = mysqli_query($conn, $qry1);

    // GET TRACK COVER
    $qry2 = "SELECT * FROM tracks WHERE id='$track_id'";
    $result2 = mysqli_query($conn, $qry2);
    $row2 = mysqli_fetch_assoc($result2);
    $cover = $row2['cover'];

    // ADD COVER TO PLAYLIST
    $qry3 = "UPDATE playlists SET cover='$cover' WHERE id='$playlist_id'";
    $result3 = mysqli_query($conn, $qry3);

    if($result1 && $result3){
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