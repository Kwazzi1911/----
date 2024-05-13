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

    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = 1;

        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($cart_num) > 0){
            $message[] = 'already added to cart';
        }
        else {
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
            $message[] = 'added to cart';
        }
    }

    // удаление продуктов из wishlist
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$delete_id'") or die('query failed');
        header('location:wishlist.php');
    }

    // удаление всех продуктов из wishlist для данного пользователя
    if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
        header('location:wishlist.php');
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
            <h1>my wishlist</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">home</a><span>/ wishlist</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <section class="shop">
      <h1 class="title">products added in wishlist</h1>
        <div class="box-container">
            <?php
            $grand_total=0;
            // Выборка товаров из wishlist для данного пользователя
            $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_wishlist) > 0){
                while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
            ?>
            <form method="post">
                <div class="box">
                    <div class="detail">
                        <img src="../uploaded_img/<?php echo $fetch_wishlist['image']; ?>" alt="">
                        <div class="price">$<?php echo $fetch_wishlist['price']; ?></div>
                        <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
                        <!-- Вывод дополнительной информации о товаре (например, product_detail) требует соответствующего поля в базе данных -->
                        <!-- <div class="detail"><?php echo $fetch_wishlist['product_detail']; ?></div> -->

                        <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">

                        <div class="icon">
                            <a href="view_page.php?pid=<?php echo $fetch_wishlist['id']; ?>" class="bx bx-search"></a>
                            <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="bx bx-x" onclick="return confirm('delete this from wishlist?');"></a>
                            <button type="submit" name="add_to_cart" class="bx bx-cart"></button>
                        </div>
                    </div>
                </div>
            </form>
            <?php
                    $grand_total += $fetch_wishlist['price'];
                }
            } else {
                echo '<p class="empty">your wishlist is empty</p>';
            }
            ?>
        </div> 
        <div class="wishlist_total">
            <p>total amount : <span>$<?php echo $grand_total; ?>/-</span></p>
            <a href="shop.php" class="btn">continue shopping</a>
            <a href="wishlist.php?delete_all" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>"
             onclick="return confirm('delete all from wishlist?');">delete all</a>
        </div>
  </section>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="" src="../scripts/user.js"></script>
</body>
</html>
