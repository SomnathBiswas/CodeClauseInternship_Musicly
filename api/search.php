<?php
    include '../partials/dbConnect.php';
    // API endpoint for search
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Get the search query from the request parameters
        $query = $_GET['query'];

        // Prepare the SQL statement
        $sql = "SELECT tracks.*, artists.name FROM tracks INNER JOIN artist_track ON tracks.id = artist_track.track_id INNER JOIN artists ON artist_track.artist_id = artists.id  WHERE tracks.title LIKE '%" . $conn->real_escape_string($query) . "%'";

        // Execute the query
        $result = $conn->query($sql);

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

        // Close the database connection
        $conn->close();
    }
?>
