<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="../index.php" class="logo"><img src="img/logo.png" alt="logo"></a>
            <nav class="navbar">
                <a href="../index.php">home</a>
                <a href="../user/about.php">about us</a>
                <a href="../user/shop.php">shop</a>
                <a href="../user/order.php">order</a>
                <a href="../user/contact.php">contact</a>
            </nav>
            <div class="icons">
                <i class="bx bxs-user" id="user-btn"></i>
                <?php
                $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist)
                ?>
                <a href="./wishlist.php"><i class="bx bx-heart"></i><sup><?php echo $wishlist_num_rows; ?></sup></a>
                <?php
                $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart); // Исправлено здесь
                ?>
                <a href="./cart.php"><i class="bx bx-cart"></i><sup><?php echo $cart_num_rows; ?></sup></a> <!-- Исправлено здесь -->
                <i class="bx bx-list-ul" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <form action="" method="post">
                    <button type="submit" name="logout" class="logout_btn">logout</button>
                </form>
            </div>
        </div>
    </header>
    <script src="../scripts/user.js"></script>
</body>
</html>
