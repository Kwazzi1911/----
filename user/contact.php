<?php 
    include '../connection.php';
    session_start();
    $user_id = $_SESSION['user_id']; // Fixing variable name

    if(!isset($user_id)){ // Fixing variable name
        header('location:../login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:../login.php');
    }

    if(isset($_POST['submit-btn'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$message'") or die('query failed');
        if(mysqli_num_rows($select_message) > 0){
            echo 'message already sent';
        } else {
            mysqli_query($conn, "INSERT INTO `message` (user_id, name, email, number, message) VALUES ('$user_id', '$name', '$email', '$number', '$message')") or die('query failed');
        }
    }
?>
<style>
     <?php include '../styles/user.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Contact</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">home</a><span>/ contact</span>
        </div>
    </div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="" alt="">
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="box">
                <img src="" alt="">
                <div>
                    <h1>miney back & guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="box">
                <img src="" alt="">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <div class="form-container">
        <h1 class="title">Leave a Message</h1>
        <form action="" method="post">
            <div class="input-field">
                <label>Your Name</label>
                <input type="text" name="name">
            </div>
            <div class="input-field">
                <label>Your Email</label>
                <input type="text" name="email">
            </div>
            <div class="input-field">
                <label>Number</label>
                <input type="text" name="number">
            </div>
            <div class="input-field">
                <label>Your Message</label>
                <textarea name="message"></textarea>
            </div>
            <button type="submit" name="submit-btn">Send Message</button>
        </form>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="address">
        <h1 class="title">Our Contact</h1>
        <div class="row">
            <div class="box">
                <i class="bx bx-map"></i>
                <div>
                    <h4>Address</h4>
                    <p>Moscow</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bx-phone"></i>
                <div>
                    <h4>Phone Number</h4>
                    <p>456789</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bx-envelope"></i>
                <div>
                    <h4>Email</h4>
                    <p>tarverdans15@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="" src="./scripts/user.js"></script>
</body>
</html>
