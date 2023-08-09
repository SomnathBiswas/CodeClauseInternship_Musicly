<?php
    // Start the session if it's not already started
    session_start();

    // Get the currently playing song ID from the AJAX request
    $currentlyPlayingSongId = $_GET['track_id'];

    // Add the current song ID to the 'played_songs' array
    array_push($_SESSION['played_songs'], $currentlyPlayingSongId);

    // Send a response back to the JavaScript
    $response = array('status' => 'success');
    echo json_encode($response);
?>