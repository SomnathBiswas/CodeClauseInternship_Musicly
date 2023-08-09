<?php
    include '../partials/dbConnect.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    if($user_id == NULL){
        header('location: ../login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Admin Dashboard</title>
    <link rel="shortcut icon" href="../img/icons/purple-play-button.png" type="image/x-icon">
    <link rel="stylesheet" href="../master.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="https://kit.fontawesome.com/a165e4dd2f.js" crossorigin="anonymous"></script>

</head>
<body>
    <nav>
        <div class="logo">
            <a href="">
                <img src="../img/icons/purple-play-button.png" alt="">
                Musicly
            </a>
        </div>
        <div class="userAccount">
            <div class="accountIcon">
                <i class="fas fa-user"></i>
                <?php
                    $userQry = "SELECT * FROM users WHERE id='$user_id'";
                    $userResult = mysqli_query($conn, $userQry);
                    $userRow = mysqli_fetch_assoc($userResult);
                    $fname = $userRow['fname'];
                    $lname = $userRow['lname'];
                ?>
                <span id="userName"><?php echo $fname.' '.$lname ?></span>
            </div>
            <a href="../logout.php">Logout</a>
        </div>
    </nav>
    <main>
        <div class="sidebar">
            <ul>
                <li class="active"><a href="admin.php"><i class="fas fa-star"></i> Dashboard</a></li>
                <li class=""><a href="albums.php"><i class="fas fa-star"></i> Albums</a></li>
                <li class=""><a href="artists.php"><i class="fas fa-star"></i> Artists</a></li>
                <li class=""><a href="genre.php"><i class="fas fa-star"></i> Genre</a></li>
                <li class=""><a href="tracks.php"><i class="fas fa-star"></i> Tracks</a></li>
                <li class=""><a href="playlists.php"><i class="fas fa-star"></i> Playlists</a></li>
            </ul>
        </div>
        <div class="mainContent">
            <div class="contentHeader">
                <div class="headerTitle">Dashboard</div>
                <div class="actionBtns">
                </div>
            </div>
            <div class="allContents">
                <?php
                    $qry = "SELECT COUNT(*) AS total_rows FROM tracks";
                    $result = mysqli_query($conn, $qry);
                    $row = mysqli_fetch_assoc($result);
                    $totalTracks = $row['total_rows'];
                ?>
                <div class="cards">
                    <div class="cardFigure"><?php echo $totalTracks; ?></div>
                    <div class="cardTitle">Tracks</div>
                </div>
                <?php
                    $qry = "SELECT COUNT(*) AS total_rows FROM albums";
                    $result = mysqli_query($conn, $qry);
                    $row = mysqli_fetch_assoc($result);
                    $totalAlbums = $row['total_rows'];
                ?>
                <div class="cards">
                    <div class="cardFigure"><?php echo $totalAlbums; ?></div>
                    <div class="cardTitle">Albums</div>
                </div>
                <?php
                    $qry = "SELECT COUNT(*) AS total_rows FROM artists";
                    $result = mysqli_query($conn, $qry);
                    $row = mysqli_fetch_assoc($result);
                    $totalArtists = $row['total_rows'];
                ?>
                <div class="cards">
                    <div class="cardFigure"><?php echo $totalArtists; ?></div>
                    <div class="cardTitle">Artists</div>
                </div>
                <?php
                    $qry = "SELECT COUNT(*) AS total_rows FROM genre";
                    $result = mysqli_query($conn, $qry);
                    $row = mysqli_fetch_assoc($result);
                    $totalGenre = $row['total_rows'];
                ?>
                <div class="cards">
                    <div class="cardFigure"><?php echo $totalGenre; ?></div>
                    <div class="cardTitle">Genre</div>
                </div>
                <?php
                    $qry = "SELECT COUNT(*) AS total_rows FROM playlists";
                    $result = mysqli_query($conn, $qry);
                    $row = mysqli_fetch_assoc($result);
                    $totalPlaylists = $row['total_rows'];
                ?>
                <div class="cards">
                    <div class="cardFigure"><?php echo $totalPlaylists; ?></div>
                    <div class="cardTitle">Playlists</div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>