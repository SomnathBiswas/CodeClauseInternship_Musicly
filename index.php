<?php
include './partials/dbConnect.php';

    session_start();
    if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];
        $sql="SELECT * FROM users where id='$id'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $is_admin = $row['is_admin'];

        if($is_admin == "0"){
            header('location: ./home.php');
        }
        else{
            header('location: ./admin/admin.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Web Player | Music for everyone</title>
    <link rel="shortcut icon" href="img/icons/purple-play-button.png" type="image/x-icon">
    <link rel="stylesheet" href="master.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="img/gif/colorful-wave.gif" alt="" class="colorWave">
    <div class="container">
        <div class="header">
            <a href="">
                <img src="img/icons/purple-play-button.png" alt=""> Musicly
            </a>
            <p>Musicly is a digital music service that gives you access to millions of songs.</p>
        </div>
        <div class="btns">
            <a href="login.php" id="loginBtn">Log in</a>
            <a href="signup.php" id="signupBtn">Sign up</a>
        </div>
    </div>
</body>
</html>