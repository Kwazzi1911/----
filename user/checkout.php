<?php 
include '../connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:../login.php');
}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:../login.php');
}

if(isset($_POST['order_btn'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $method = mysqli_real_escape_string($conn, 'flat no. '.$_POST['flate'].' '.$_POST['city'].' '.$_POST['state'].' '.$_POST['country'].' '.$_POST['pin_code']);
    $placed_on = date('m-d-y');
    $cart_total = 0;
    $cart_product = array();

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_product[] = $cart_item['name'];
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(',', $cart_product);
    mysqli_query($conn, "INSERT INTO `order` (`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`)
     VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    $message = 'order placed successfully!';
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
    <div class="checkout">
        <h1 class="title">payment process</h1>
        <?php
        if(isset($message)){
            echo '<p class="message">'.$message.'</p>';
        }
        ?>
        <div class="display-order">
        <div class="box-container">
            <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $total = 0;
                $grand_total = 0;
                $item_index = 1;

                if(mysqli_num_rows($select_cart) > 0){
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                        $grand_total += $total_price;
            ?>
                <div class="box">
                    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                    <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                </div>
            <?php
                        $item_index++;
                    }
                }
            ?>
            </div>  
            <span class="grand-total">Total Amount Payable : $ <?= $grand_total; ?></span>
        </div>
        <form action="" method="post">
            <div class="input-field">
                <label>your name</label>
                <input type="text" name="name" placeholder="enter your name">
            </div>
            <div class="input-field">
                <label>number</label>
                <input type="number" name="number" placeholder="enter your number">
            </div>
            <div class="input-field">
                <label>your email</label>
                <input type="text" name="email" placeholder="enter your email">
            </div>
            <div class="input-field">
                <label>select payment method</label>
               <select name="method" id="">
                <option value="" selected disabled>select payment method</option>
                <option value="cash on delivery">cash on delivery</option>
                <option value="credit card">credit card</option>
                <option value="paypal">paypal</option>
                <option value="paytm">paytm</option>
               </select>
            </div>
            <div class="input-field">
                <label>address line 1 </label>
                <input type="text" name="flate" placeholder="e.g flate no.">
            </div>
            <div class="input-field">
                <label>address line 2 </label>
                <input type="text" name="flate" placeholder="e.g street name">
            </div>
            <div class="input-field">
                <label>city</label>
                <input type="text" name="city" placeholder="e.g delhi">
            </div>
            <div class="input-field">
                <label>state</label>
                <input type="text" name="state" placeholder="e.g delhi">
            </div>
            <div class="input-field">
                <label>country</label>
                <input type="text" name="country" placeholder="e.g Russia">
            </div>
            <div class="input-field">
                <label>pin code</label>
                <input type="text" name="pin_code" placeholder="e.g 345678">
            </div>
            <input type="submit" name="order_btn" value="order now">
        </form>
    </div>
    <?php include 'footer.php'; ?>
    <script type="" src="./scripts/user.js"></script>
</body>
</html>
