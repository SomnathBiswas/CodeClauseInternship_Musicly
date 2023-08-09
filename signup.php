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
    $showSuccess = false;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $sql="SELECT * FROM users WHERE email='$email'";              //write query here
        $result=mysqli_query($conn,$sql);                               // Execute the query
        $numOfRows = mysqli_num_rows($result);                          // returns num of rows from the result
        $row=mysqli_fetch_assoc($result);                               //returns rows in array

        if($numOfRows > 0)
        {
            $showError = true;
            $errMsg = 'User name already registered';
        }
        else
        {
            if ($cpassword==$password)
            {
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $sql="INSERT INTO users (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $showSuccess = true;
                    $errMsg = 'Successfully registered';
                    header("location: login.php");
                }
                else{
                    $showError = true;
                    $errMsg = 'Server error!';
                }
            }
            else{
                $showError = true;
                $errMsg = 'Password doesn\'t match';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicly - Signup</title>
    <link rel="shortcut icon" href="img/icons/purple-play-button.png" type="image/x-icon">
    <link rel="stylesheet" href="master.css">
    <link rel="stylesheet" href="css/signup.css">
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
        if($showSuccess){
            echo '
                <div class="alert">
                    <p class="success"><span>Alert!</span> '.$errMsg.'!</p>
                </div>
            ';
        }
    ?>
    <div class="signup">
        <div class="logo">
            <a href=""><img src="img/icons/purple-play-button.png" alt=""> Musicly</a>
        </div>
        <form action="" method="post">
            <div class="inputItem">
                <label for="fname">First Name</label>
                <input type="text" placeholder="first name" name="fname">
            </div>
            <div class="inputItem">
                <label for="lname">Last Name</label>
                <input type="text" placeholder="last name" name="lname">
            </div>
            <div class="inputItem">
                <label for="email">Email</label>
                <input type="email" placeholder="email@example.com" name="email">
            </div>
            <div class="inputItem">
                <label for="password">Password</label>
                <input type="password" placeholder="password" name="password">
            </div>
            <div class="inputItem">
                <label for="cpassword">Confirm Password</label>
                <input type="password" placeholder="confirm password" name="cpassword">
            </div>
            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>