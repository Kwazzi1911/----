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

if(isset($_POST['update_qty_btn'])){
    $update_qty_id = $_POST['update_qty_id'];
    $update_qty = $_POST['update_quantity'];

    $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_qty' WHERE id = '$update_qty_id'") or die('query failed');

    if($update_query){
        header('location:cart.php');
    }
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
}

$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <?php include '../styles/user.css'; ?>
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>my cart</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">home</a><span>/ cart</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <section class="shop">
        <h1 class="title">products added in cart</h1>
        <div class="box-container">
            <?php
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
                    $grand_total += $sub_total;
                    ?>
                    <div class="box">
                        <div class="box-container">
                            <div class="icon">
                                <a href="view_page.php?pid=<?php echo $fetch_cart['id']; ?>" class="bx bx-search"></a>
                                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bx bx-x" onclick="return confirm('delete this from cart?');"></a>
                                <button type="submit" name="add_to_cart" class="bx bx-cart"></button>
                            </div>
                            <img src="../uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="">
                            <div class="price">$<?php echo $fetch_cart['price']; ?></div>
                            <div class="name"><?php echo $fetch_cart['name']; ?></div>
                            <form action="" method="post">
                                <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
                                <div class="qty">
                                    <input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                                    <input type="submit" value="update" name="update_qty_btn">
                                </div>
                            </form>
                            <div class="total-amt">
                                Total Amount : <span><?php echo $sub_total; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p class="empty">your cart is empty</p>';
            }
            ?>
        </div> 
        <div class="dlt">
            <a href="cart.php?delete_all" class="btn2" onclick="return confirm('delete all from cart?');">delete all</a>
        </div>
        <div class="wishlist_total">
            <p>total amount : <span>$<?php echo $grand_total; ?>/-</span></p>
            <a href="shop.php" class="btn">continue shopping</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>" onclick="return confirm('proceed to checkout?');">proceed to checkout</a>
        </div>
    </section>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script src="./scripts/user.js"></script>
</body>
</html>
