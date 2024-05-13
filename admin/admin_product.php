<?php 
    include '../connection.php';
    session_start();
    $admin_id = $_SESSION['admin_name'];

    if(!isset($admin_id)){
        header('location:../login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:../login.php');
    }

    // добавление продуктов в бд
    if(isset($_POST['add_product'])){
        $product_name = mysqli_real_escape_string($conn, $_POST['name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['price']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['product_detail']); 
        $product_image = $_FILES['image']['name'];
        $product_image_size = $_FILES['image']['size'];
        $product_image_tmp_name = $_FILES['image']['tmp_name'];
        $product_image_folder = '../uploaded_img/'.$product_image;

        $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$product_name'") or die('query failed');

        if(mysqli_num_rows($select_product_name) > 0){
            $message[] = 'product name already added';
        } else {
            $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, price, product_detail, image) VALUES('$product_name', '$product_price', '$product_detail', '$product_image')") or die('query failed');
            if($insert_product){
                if($product_image_size > 2000000){
                    $message[] = 'image size is too large';
                } else {
                    move_uploaded_file($product_image_tmp_name, $product_image_folder);
                    $message[] = 'product added successfully';
                }
            } else {
                $message[] = 'product could not be added';
            }
        }
    }

    // удаление продуктов
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');

        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('../uploaded_img/'.$fetch_delete_image['image']);

        mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
        mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');

        header('location:../admin/admin_product.php');
    }

    // обновление продуктов
    if(isset($_POST['update_product'])){
        $update_id = $_POST['update_id'];
        $update_name = $_POST['update_name'];
        $update_price = $_POST['update_price'];
        $update_detail = $_POST['update_detail'];
        $update_image = $_FILES['update_image']['name'];
        $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
        $update_image_folder = "../uploaded_img/".$update_image;

        $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', product_detail = '$update_detail', image = '$update_image' WHERE id = '$update_id'") or die('query failed');

        if($update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            header('location:../admin/admin_product.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin.css">
    <title>admin product page</title>
</head>
<body>
     <?php include '../admin/admin_header.php';?>
   <div class="line2">
        <section class="add-products form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <label for="">product name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="input-field">
                    <label for="">product price</label>
                    <input type="text" name="price" required>
                </div>
                <div class="input-field">
                    <label for="">product detail</label>
                    <textarea name="product_detail" required></textarea>
                </div>

                <div class="input-field">
                    <label for="">product image</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <input type="submit" name="add_product" value="add product">
            </form>
        </section>
        <div class="line3">

        </div>
        <div class="line4"></div>
        <section class="show-products">
            <div class="box-container">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
                ?>
                <div class="box">
                    <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>">
                    <p><?php echo $fetch_products['name']; ?></p>
                    <h4>$<?php echo $fetch_products['price']; ?>/-</h4>
                    <details><?php echo $fetch_products['product_detail']; ?></details>
                    <a href="../admin/admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">edit</a>
                    <a href="../admin/admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete"
                     onClick="return confirm('want to delete this product');">delete</a>
                </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">no products added yet!</p>';
                }
                ?>
            </div>
        </section>
        <div class="line"></div>
        <section class="update-container">
            <?php 
            if(isset($_GET['edit'])){
                $edit_id = $_GET['edit'];
                $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$edit_id'") or die('query failed');
                if(mysqli_num_rows($edit_query) > 0){
                    while($fetch_edit = mysqli_fetch_assoc($edit_query)){
                        
                    
                
            
            ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <img src="../uploaded_img"<?php echo $fetch_edit['image'];?>/>
                <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id'];?>">
                <input type="text" name="update_name" value="<?php echo $fetch_edit['name'];?>">
                <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price'];?>">
                <textarea name="update_detail"><?php echo $fetch_edit['product_detail'];?></textarea>
                <input type="file" name="update_image" accept="image/*">
                <input type="submit" name="update_product" value="update" class="edit">
                <input type="reset" name="" value="cancel" class="option-btn btn" id="close-form">
            </form>
            <?php
                    }
            }
            echo "<script>document.querySelector('.update-container').style.display = 'block';</script>";
        }
            ?>
        </section>
   </div>
    <script type="text/javascript" src="../scripts/admin.js"></script>
</body>
</html>