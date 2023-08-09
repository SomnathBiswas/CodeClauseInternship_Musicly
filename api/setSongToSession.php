<?php
    session_start();

    // Get the currently playing song ID from the AJAX request
    $currentlyPlayingSongId = $_POST['songId'];

    // Set the song ID in the session
    $_SESSION['song_id'] = $currentlyPlayingSongId;

    // Send a response back to the JavaScript
    $response = array('status' => 'success');
    echo json_encode($response);
?>