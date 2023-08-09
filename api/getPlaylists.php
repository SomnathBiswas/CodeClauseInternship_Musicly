<?php
    include '../partials/dbConnect.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT p.* FROM playlists p JOIN playlist_user pu ON p.id = pu.playlist_id WHERE pu.user_id ='$user_id'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any results were found
    if ($result->num_rows > 0) {
        // Fetch the results and store them in an array
        $playlists = array();
        while ($row = $result->fetch_assoc()) {
            $playlists[] = $row;
        }

        // Set the response content type to JSON
        header('Content-Type: application/json');

        // Send the JSON-encoded search results as the API response
        echo json_encode($playlists);
    } else {
        // No results found
        echo "No results found";
    }

    // Close the database connection
    $conn->close();


?>