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

    // удаление продуктов
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];

        mysqli_query($conn, "DELETE FROM `order` WHERE id = '$delete_id'") or die('query failed');
        $message[] = 'user deleted successfully';
        header('location:../admin/admin_order.php');
    }
    
    // обновление статуса

    if(isset($_POST['update_payment'])){
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($conn, "UPDATE `order` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/admin.css">
    <title>admin order page</title>
</head>
<body>
     <?php include '../admin/admin_header.php';?>
     <?php 
     if(isset($message)){
        foreach ($message as $message){
        echo `
        <div class="message">
            <span>${message}</span>
            <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
        </div>
        `;
        }
     }
     ?>
   <div class="line4"></div>
   <section class="order-container">
    <h1 class="title">orders</h1>
    <div class="box-container">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                

        ?>
        <div class="box">
            <p>user name: <span><?php echo $fetch_orders['name']; ?></span></p>
            <p>user id: <span><?php echo $fetch_orders['user_id']; ?></span></p>
            <p>placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
            <p>number: <span><?php echo $fetch_orders['number']; ?></span></p>
            <p>email: <span><?php echo $fetch_orders['email']; ?></span></p>
            <p>total price: <span><?php echo $fetch_orders['total_price']; ?></span></p>
            <p>method: <span><?php echo $fetch_orders['method']; ?></span></p>
            <p>address: <span><?php echo $fetch_orders['address']; ?></span></p>
            <p>total product: <span><?php echo $fetch_orders['total_products']; ?></span></p>
            <form action="" method="post">
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                <select name="update_payment" id="">
                    <option value="" disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                    <option value="pending">Pending</option>
                    <option value="complete">Completed</option>
                </select>
                <input type="submit" name="update_order" value="update payment" class="btn">
                <a href="../admin/admin_order.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this message?');">delete</a>
            </form>
        </div>
        <?php
         }
         
        }
        else {
            echo "
            <div class='empty'>
                <p>no order placed yet</p>
            </div>
            ";
        }        
        ?>
    </div>
   </section>
   <div class="line2"></div>
    <script type="text/javascript" src="../scripts/admin.js"></script>
</body>
</html>