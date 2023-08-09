<?php

    include 'dbConnect.php';

    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateTrackBtn'])){

        // GET VALUES FROM FORM DATA
        $track_id = $_POST['trackId'];
        $title = $_POST['trackTitle'];
        $year = $_POST['trackYear'];
        $genre = $_POST['trackGenre'];
        $album = $_POST['trackAlbum'];
        $artist = $_POST['trackArtist'];
        
        if(!empty($_FILES['cover']['name'])){
            $uniqueFileName = time() . '_' . uniqid() . '.jpeg';
            $cover = "./uploads/trackCover/" . $uniqueFileName;

            $file_tmp = $_FILES['cover']['tmp_name'];
            // Move the uploaded file to a desired directory
            move_uploaded_file($file_tmp, "../uploads/trackCover/" . $uniqueFileName);

            // UPDATE TRACKS
            $qry = "UPDATE tracks SET cover='$cover' WHERE id='$track_id'";
            mysqli_query($conn, $qry);
        }
        if(!empty($_FILES['trackUrl']['name'])){
            $uniqueFileName = time() . '_' . uniqid() . '.mp3';
            $targetFile = '../uploads/tracks/' .  $uniqueFileName;
            $mp3Url = './uploads/tracks/'.$uniqueFileName;
            // Check if the file is an MP3
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            if ($fileType == 'mp3') {
            // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['trackUrl']['tmp_name'], $targetFile)) {
                    $trackUrl = $mp3Url.
                    // UPDATE TRACKS
                    $qry = "UPDATE tracks SET url='$mp3Url' WHERE id='$track_id'";
                    mysqli_query($conn, $qry);
                } 
                else {
                    echo "Sorry, there was an error uploading your track.";
                }
            } 
            else {
                echo "Only MP3 files are allowed.";
            }
        }

        // UPDATE TRACKS
        $qry = "UPDATE tracks SET title='$title', year='$year', genre='$genre' WHERE id='$track_id'";
        mysqli_query($conn, $qry);
        header('location: ../admin/editTrack.php?id='.$track_id);
    }

?>