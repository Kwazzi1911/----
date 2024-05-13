<?php 
    include 'connection.php';
    session_start();
    $user_id = $_SESSION['user_id']; 

    if(!isset($user_id)){ 
        header('location:login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:login.php');
    }

    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
        $cart_num = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_wishlist) > 0) {
            $message[] = 'already added to wishlist';
        } 
        else {
            mysqli_query($conn, "INSERT INTO `wishlist`(user_id, name, price, image) VALUES('$user_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
            $message[] = 'added to wishlist';
        }
    }

    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['product_id'];
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
    <?php include './styles/user.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include './user/header_for_index.php'; ?>
    <!-- home section starts -->
    <div class="container-fluid">
        <div class="hero-slider">
            <div class="slider-item">
                <img src="./img/slider.jpg" alt="" srcset="">
                <div class="slider-caption">
                    <span>test the quality</span>
                    <h1>organic premium <br>Honey</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe vitae nisi fuga dicta eos, vero dolores? Quas, maiores a dolore quae iste, aperiam doloribus hic quaerat est impedit magni provident?</p>
                    <a href="./user/shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="slider-item">
                <img src="./img/slider2.jpg" alt="" srcset="">
                <div class="slider-caption">
                    <span>test the quality</span>
                    <h1>organic premium <br>copiratedddddd</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe vitae nisi fuga dicta eos, vero dolores? Quas, maiores a dolore quae iste, aperiam doloribus hic quaerat est impedit magni provident?</p>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>
            <div class="controls">
                <i class="bx bx-chevron-left prev"></i>
                <i class="bx bx-chevron-right next"></i>
            </div>
        </div>
    </div>

    <div class="line"></div>
    <div class="services">
        <div class="row">
            <div class="box">
                <img src="" alt="">
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="box">
                <img src="" alt="">
                <div>
                    <h1>miney back & guarantee</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="box">
                <img src="" alt="">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line2"></div>
    <div class="story">
        <div class="row">
            <div class="box">
                <span>our story</span>
                <h1>production of natural honey since 1998</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab corporis tempore voluptate aliquid minima qui in! Dolor eaque laborum pariatur quas doloribus quae molestiae similique sit expedita, modi nemo aperiam!</p>
                <a href="./user/shop.php" class="btn">show now</a>
            </div>
            <div class="box">
                <img src="" alt="">
            </div>
        </div>
    </div>
    <div class="line4"></div>
    <!-- testimonial section starts -->
    <div class="testimonial-fluid">
        <h1 class="title">what our customers say's</h1>
        <div class="testimonial-slider">
            <div class="testimonial-item">
                <img src="" alt="">
                <div class="testimonial-caption">
                    <span>test the quantity</span>
                    <h1>organic premium honey</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus vitae beatae perspiciatis modi magnam sit, fugiat mollitia assumenda qui officiis, minus, voluptates at. Eveniet similique neque inventore, architecto asperiores rem.</p>         
                </div>
            </div>
            <div class="testimonial-item">
                <img src="" alt="">
                <div class="testimonial-caption">
                    <span>test the quantity</span>
                    <h1>organic premium honey</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus vitae beatae perspiciatis modi magnam sit, fugiat mollitia assumenda qui officiis, minus, voluptates at. Eveniet similique neque inventore, architecto asperiores rem.</p>         
                </div>
            </div>
            <div class="testimonial-item">
                <img src="" alt="">
                <div class="testimonial-caption">
                    <span>test the quantity</span>
                    <h1>organic premium honey</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus vitae beatae perspiciatis modi magnam sit, fugiat mollitia assumenda qui officiis, minus, voluptates at. Eveniet similique neque inventore, architecto asperiores rem.</p>         
                </div>
            </div>
        </div>
                <div class="controls">
                    <i class="bx bx-chevron-left prev1"></i>
                    <i class="bx bx-chevron-right next2"></i>
                </div>
    </div>
    <div class="line4"></div>
    <!-- discount section starts -->
    <div class="line2"></div>
    <div class="discover">
        <div class="detail">
            <h1 class="title">organic money be healthy</h1>
            <span>buy now and save 30% off!</span>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus animi, neque molestiae quae a ut nemo ipsam adipisci voluptate esse, cupiditate eaque ullam cumque officiis laudantium ad magnam aspernatur. Provident!</p>
            <a href="./user/shop.php" class="btn">discover now</a>
        </div>
        <div class="img-box">
            <img src="" alt="">
        </div>
    </div>
    <div class="line3"></div>
    <?php include './user/homeshop.php'; ?>
    <div class="line2"></div>
    <div class="newslatter">
        <h1 class="title">Join Our To Newslatter</h1>
        <p>Lorem ipsum dolor sit amet consectetur</p>
        <input type="text" name="" placeholder="enter your email">
        <button>subscribe now</button>
    </div>
    <div class="line3"></div>
    <div class="client">
        <div class="box">
            <img src="" alt="">
        </div>
        <div class="box">
            <img src="" alt="">
        </div>
        <div class="box">
            <img src="" alt="">
        </div>
        <div class="box">
            <img src="" alt="">
        </div>
        <div class="box">
            <img src="" alt="">
        </div>
    </div>
    <?php include './user/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script type="" src="./scripts/user.js"></script>
</body>
</html>