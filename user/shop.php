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

    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['add_to_wishlist'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_wishlist) > 0) {
            $message[] = 'already added to wishlist';
        } 
        else {
            mysqli_query($conn, "INSERT INTO `wishlist`(user_id, name, price, image) VALUES('$user_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
            $message[] = 'added to wishlist';
        }
    }

    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['add_to_cart'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($cart_num) > 0){
            $message[] = 'already added to cart';
        }
        else {
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
            $message[] = 'added to cart';
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
    <title>Document</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>our shop</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">home</a><span>/ about us</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <section class="shop">
        <h1 class="title">shop best sellers</h1>
        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 4") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="box">
                <div class="box-container">
                    <div class="box">
                        <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="price">$<?php echo $fetch_products['price']; ?></div>
                        <div class="name"><?php echo $fetch_products['name']; ?></div>

                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_quantity" value="1" min="1">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <div class="icon">
                            <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bx-low-vision"></a>
                            <button type="submit" name="add_to_wishlist" value="<?php echo $fetch_products['id']; ?>" class="bx bx-heart"></button>
                            <button type="submit" name="add_to_cart" value="<?php echo $fetch_products['id']; ?>" class="bx bx-cart"></button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                    }
                } else {
                    echo '<p class="empty">no product added yet</p>';
                }
            ?>
        </div>
    </section>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="" src="../scripts/user.js"></script>
</body>
</html>
