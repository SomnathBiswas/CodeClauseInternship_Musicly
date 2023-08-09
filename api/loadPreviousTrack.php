<?php
    include '../partials/dbConnect.php';

    session_start();
    $previousSongId = array_pop($_SESSION['played_songs']);
    
    $sql = "SELECT t.*, a.name FROM tracks t JOIN artist_track at ON t.id = at.track_id JOIN artists a ON at.artist_id = a.id WHERE t.id = '$previousSongId'";
    $result = mysqli_query($conn, $sql);

    // Check if any results were found
    if ($result->num_rows > 0) {
        // Fetch the results and store them in an array
        $tracks = array();
        while ($row = $result->fetch_assoc()) {
            $tracks[] = $row;
        }
        // Set the response content type to JSON
        header('Content-Type: application/json');
        // Send the JSON-encoded search results as the API response
        echo json_encode($tracks);
    } else {
        // No results found
        echo 'No results found.';
    }
    $conn->close();
?>