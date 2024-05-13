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
    if(isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_image'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $select_wishlist = mysqli_prepare($conn, "SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
        mysqli_stmt_bind_param($select_wishlist, "si", $product_name, $user_id);
        mysqli_stmt_execute($select_wishlist);
        mysqli_stmt_store_result($select_wishlist);

        if(mysqli_stmt_num_rows($select_wishlist) > 0) {
            $message[] = 'already added to wishlist';
        } 
        else {
            $insert_wishlist = mysqli_prepare($conn, "INSERT INTO `wishlist` (user_id, name, price, image) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_wishlist, "isss", $user_id, $product_name, $product_price, $product_image);
            mysqli_stmt_execute($insert_wishlist);
            $message[] = 'added to wishlist';
        }
    }
}

if(isset($_POST['add_to_cart'])){
    if(isset($_POST['product_id'], $_POST['product_name'], $_POST['product_price'], $_POST['product_image'], $_POST['product_quantity'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $select_cart = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        mysqli_stmt_bind_param($select_cart, "si", $product_name, $user_id);
        mysqli_stmt_execute($select_cart);
        mysqli_stmt_store_result($select_cart);

        if(mysqli_stmt_num_rows($select_cart) > 0){
            $message[] = 'already added to cart';
        }
        else {
            $insert_cart = mysqli_prepare($conn, "INSERT INTO `cart` (user_id, name, price, image, quantity) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_cart, "isssi", $user_id, $product_name, $product_price, $product_image, $product_quantity);
            mysqli_stmt_execute($insert_cart);
            $message[] = 'added to cart';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="stylesheet" type="text/css" href="../styles/user.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Product Detail</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">Home</a><span>/ About Us</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <section class="view_page">
        <h1 class="title">Shop Best Sellers</h1>
        <div class="box-container">
            <?php
            // Проверяем, передан ли параметр pid в URL
            if(isset($_GET['pid'])){
                $pid = $_GET['pid'];
                // Запрос к базе данных для получения информации о товаре с заданным идентификатором
                $select_products = mysqli_prepare($conn, "SELECT * FROM `products` WHERE id = ?");
                mysqli_stmt_bind_param($select_products, "i", $pid);
                mysqli_stmt_execute($select_products);
                $result = mysqli_stmt_get_result($select_products);
                // Проверяем, есть ли такой товар
                if(mysqli_num_rows($result) > 0){
                    $fetch_products = mysqli_fetch_assoc($result); 
            ?>
            <form method="post">
                <div class="box">
                    <div class="detail">
                        <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="price">$<?php echo $fetch_products['price']; ?></div>
                        <div class="name"><?php echo $fetch_products['name']; ?></div>
                        <div class="detail"><?php echo $fetch_products['product_detail']; ?></div>

                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <div class="icon">
                            <button type="submit" name="add_to_wishlist" class="bx bx-heart"></button>
                            <input type="number" name="product_quantity" value="1" min="0" class="quantity">
                            <button type="submit" name="add_to_cart" class="bx bx-cart"></button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                    } else {
                        // В случае, если товар с заданным id не найден
                        echo "<p>Product not found</p>";
                    }
                } else {
                    // В случае, если параметр pid не передан в URL
                    echo "<p>Product ID not provided</p>";
                }
            ?>
        </div>
    </section>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="" src="../scripts/user.js"></script>
</body>
</html>
