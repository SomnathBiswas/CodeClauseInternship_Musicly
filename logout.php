<?php

    // UNSET SESSION VARIABLES
    session_start();
    unset($_SESSION['user_id']);
    unset($_SESSION['song_id']);
    unset($_SESSION['played_songs']);

    // DESTROY SESSION
    session_destroy();
    header('location: ./index.php');
?>