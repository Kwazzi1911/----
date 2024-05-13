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
        if(mysli_num_rows($select_message) > 0 ){
            echo 'message already send';
        } else {
            mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$message')") or die('query failed');
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
    <title>contact</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>order</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">home</a><span>/ order</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="order">
        <div class="order-section">
            <div class="box-container">
                <?php 
                $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                        
                   
                ?>
                <div class="box">
                    <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                    <p>name: <span><?php echo $fetch_orders['name']; ?></span></p>
                    <p>number: <span><?php echo $fetch_orders['number']; ?></span></p>
                    <p>email: <span><?php echo $fetch_orders['email']; ?></span></p>
                    <p>address: <span><?php echo $fetch_orders['address']; ?></span></p>
                    <p>payment method <span><?php echo $fetch_orders['method']; ?></span></p>
                    <p>your order: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                    <p>total price: <span><?php echo $fetch_orders['total_price']; ?></span></p>
                    <p>paymnet status <span><?php echo $fetch_orders['payment_status']; ?></span></p>
                    
                </div>
                <?php
                 }
                } else {
                    echo '<div class="empty">no orders placed yet!</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script type="" src="../scripts/user.js"></script>
</body>
</html>