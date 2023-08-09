<?php
    include 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $coverUrl = "";
      $mp3Url = "";
      if(isset($_FILES['cover'])){
          $file_tmp = $_FILES['cover']['tmp_name'];
          
          $uniqueFileName = time() . '_' . uniqid() . '.jpeg';
          
          // Move the uploaded file to a desired directory
          $coverUrl = "./uploads/trackCover/" . $uniqueFileName;
          move_uploaded_file($file_tmp, "../uploads/trackCover/" . $uniqueFileName);
          echo "File uploaded successfully.";
      }
      if (isset($_FILES['trackUrl'])) {
        $uniqueFileName = time() . '_' . uniqid() . '.mp3';
        $targetFile = '../uploads/tracks/' .  $uniqueFileName;
        $mp3Url = './uploads/tracks/'.$uniqueFileName;
        // Check if the file is an MP3
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if ($fileType == 'mp3') {
          // Move the uploaded file to the target directory
          if (move_uploaded_file($_FILES['trackUrl']['tmp_name'], $targetFile)) {
            echo "The track has been uploaded successfully.";
          } else {
            echo "Sorry, there was an error uploading your track.";
          }
        } else {
          echo "Only MP3 files are allowed.";
        }
      }

      $title = $_POST['trackTitle'];
      $year = $_POST['trackYear'];
      $genre = $_POST['trackGenre'];
      $album = $_POST['trackAlbum'];
      $artist = $_POST['trackArtist'];

      // INSERT INTO TRACK
      $insertTrackQry = "INSERT INTO tracks (title, year, genre, url, cover) VALUES ('$title', '$year', '$genre', '$mp3Url', '$coverUrl')";
      mysqli_query($conn, $insertTrackQry);

      // GET TRACK ID
      $qry = "SELECT * FROM tracks ORDER BY id DESC LIMIT 1";
      $result = mysqli_query($conn, $qry);
      $row=mysqli_fetch_assoc($result);
      $track_id = $row['id'];

      // INSERT INTO ALBUM_TRACK
      $qry = "INSERT INTO album_track (album_id, track_id) VALUES ('$album','$track_id')";
      mysqli_query($conn, $qry);

      // INSERT INTO ARTIST_TRACK
      $qry = "INSERT INTO artist_track (artist_id, track_id) VALUES ('$artist', '$track_id')";
      mysqli_query($conn, $qry);

      // INSERT INTO GENRE_TRACK
      $qry = "INSERT INTO genre_track (genre_id, track_id) VALUES ('$genre', '$track_id')";
      mysqli_query($conn, $qry);

      header('location: ../admin/tracks.php');
    }
?>
