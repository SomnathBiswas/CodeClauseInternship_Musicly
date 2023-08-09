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
                <li class=""><a href="admin.php"><i class="fas fa-star"></i> Dashboard</a></li>
                <li class=""><a href="albums.php"><i class="fas fa-star"></i> Albums</a></li>
                <li class="active"><a href="artists.php"><i class="fas fa-star"></i> Artists</a></li>
                <li class=""><a href="genre.php"><i class="fas fa-star"></i> Genre</a></li>
                <li class=""><a href="tracks.php"><i class="fas fa-star"></i> Tracks</a></li>
                <li class=""><a href="playlists.php"><i class="fas fa-star"></i> Playlists</a></li>
            </ul>
        </div>
        <div class="mainContent">
            <div class="contentHeader">
                <div class="headerTitle">Edit Artist</div>
                <div class="actionBtns">
                    <a href="./createArtist.php">Create Artist</a>
                </div>
            </div>
            <div class="allContents">
                <form action="../partials/editArtist.php" method="post" enctype="multipart/form-data">
                    <?php
                        $artist_id = $_GET['id'];
                        $qry = "SELECT * FROM artists WHERE id='$artist_id'";
                        $result = mysqli_query($conn, $qry);
                        $row = mysqli_fetch_assoc($result);
                        $title = $row['name'];
                        $cover = $row['cover'];
                    ?>
                    <img src=".<?php echo $cover; ?>" alt="" id="artistCover">
                    <div class="formItem">
                        <label for="artistId">ID</label>
                        <input type="text" value="<?php echo $artist_id; ?>" name="artistId">
                    </div>
                    <div class="formItem">
                        <label for="artistName">Name</label>
                        <input type="text" value="<?php echo $title; ?>" name="artistName">
                    </div>
                    <div class="formItem">
                        <label for="artistCover">Cover Photo</label>
                        <input type="file" name="cover" accept="image/*" onchange="document.getElementById('artistCover').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="actionBtns">
                        <button type="submit" name="updateArtistBtn">Update</button>
                        <a href="artists.php">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>