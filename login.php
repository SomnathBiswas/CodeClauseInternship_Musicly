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

    $showError = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Search the email of the user in the table
        $sql="SELECT * FROM users where email='$email'";
        $result=mysqli_query($conn,$sql);                   // execute the query
        $numOfRows=mysqli_num_rows($result);                // returns number of rows from the result
        
        // if no email matches
        if($numOfRows==0)
        {
            $errMsg = 'User not registered';
            $showError = true;
        }
        // if email matches
        else{
            // match the passwords
            $row=mysqli_fetch_assoc($result);
            $isAdmin = $row['is_admin'];
            // match the password with hash code
            if(password_verify($password, $row['password'])){
                session_start();
                $_SESSION['user_id'] = $row['id'];
                
                if($isAdmin == "0"){
                    $_SESSION['played_songs'] = array();
                    header("location: home.php");
                }
                else{
                    header("location: admin/admin.php");
                }
                
            }
            else{
                $errMsg = 'Password incorrect';
                $showError = true;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Login</title>
    <link rel="shortcut icon" href="img/icons/purple-play-button.png" type="image/x-icon">
    <link rel="stylesheet" href="master.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <?php
        if($showError){
            echo '
                <div class="alert">
                    <p class="danger"><span>Alert!</span> '.$errMsg.'!</p>
                </div>
            ';
        }
    ?>
    
    <div class="login">
        <div class="logo">
            <a href=""><img src="img/icons/purple-play-button.png" alt=""> Musicly</a>
        </div>
        <form action="" method="post">
            <div class="inputItem">
                <label for="email">Email</label>
                <input type="email" placeholder="email@example.com" name="email">
            </div>
            <div class="inputItem">
                <label for="password">Password</label>
                <input type="password" placeholder="password" name="password">
            </div>
            <!-- <div>
                <input type="checkbox" name="remember">
                <label for="remember">Remember me</label>
            </div>
            <a href="">Forgot Password</a> -->
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>