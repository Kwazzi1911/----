
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/slick.css">
    <link rel="stylesheet" href="../styles/user.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <title>Document</title>
</head>
<body>
  <section class="popular-brands">
      <h2>POPULAR BRANDS</h2>
      <div class="controls">
            <i class="bx bx-chevron-left left"></i>
            <i class="bx bx-chevron-right right"></i>
      </div>
        <div class="popular-brands-content">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 4") or die('query failed');
                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form method="post" class="card">
              <div class="box-container">
              <div class="box">
                    <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                    <div class="price">$<?php echo $fetch_products['price']; ?></div>
                    <div class="name"><?php echo $fetch_products['name']; ?></div>

                    <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_quantity" value="1" min="1">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                    <div class="icon">
                        <a href="./user/view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bx bx-low-vision"></a>
                        <button type="submit" name="add_to_wishlist" class="bx bx-heart"></button>
                        <button type="submit" name="add_to_cart" class="bx bx-cart"></button>
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
        </div> <!-- Здесь закрывается <div class="popular-brands-content"> -->
  </section>
  
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript">
        $('.popular-brands-content').slick({
            lazyLoad: 'ondemand',
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: $('.left'),
            prevArrow: $('.right'),
            responsive: [
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                  infinite: true,
                  dots: true
                }
              },
              {
                breakpoint: 600,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
            ]
        });
    </script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
</body>
</html>
