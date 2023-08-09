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
                <div class="headerTitle">Artists</div>
                <div class="actionBtns">
                    <a href="./createArtist.php">Create Artist</a>
                </div>
            </div>
            <div class="allContents">
                <div class="searchBox">
                    <input type="text" placeholder="Search artists...">
                </div>
                <table>
                    <tr>
                        <th>ID.</th>
                        <th>Name</th>
                        <th>Cover Picture</th>
                        <th>More</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php
                        $qry = "SELECT * FROM artists ORDER BY id DESC";
                        $result = mysqli_query($conn, $qry);
                        while($row = mysqli_fetch_assoc($result)){
                            echo '
                                <tr>
                                    <td>'.$row['id'].'</td>
                                    <td>'.$row['name'].'</td>
                                    <td><img src=".'.$row['cover'].'"></td>
                                    <td><a href="">See all contents</a></td>
                                    <td><a href="./editArtist.php?id='.$row['id'].'">Edit</a></td>
                                    <td><a href="../partials/deleteArtist.php?id='.$row['id'].'">Delete</a></td>
                                </tr>
                            ';
                        }
                    ?>
                    
                </table>
            </div>
        </div>
    </main>
</body>
</html>