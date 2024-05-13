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
            <a href="../admin/admin_panel.php" class="logo"><img src="img/logo.png" alt="logo"></a>
            <nav class="navbar">
                <a href="../admin/admin_panel.php">home</a>
                <a href="../admin/admin_product.php">products</a>
                <a href="../admin/admin_order.php">orders</a>
                <a href="../admin/admin_user.php">users</a>
                <a href="../admin/admin_message.php">message</a>
            </nav>
            <div class="icons">
                <i class="bx bxs-user" id="user-btn"></i>
                <i class="bx bx-list-ul" id="menu-btn"></i>
            </div>
            <div class="user-box">
                <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form action="" method="post">
                    <button type="submit" name="logout" class="logout_btn">logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
    </div>
    <div class="line"></div>
    <script src="../scripts/admin.js"></script>
</body>
</html>
