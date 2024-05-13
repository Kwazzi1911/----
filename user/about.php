<?php 
    include '../connection.php';
    session_start();
    $user_id = $_SESSION['user_id']; // Fixing variable name

    if(!isset($user_id)){ // Fixing variable name
        header('location:../login.php');
    }

    if(isset($_POST['logout'])){
        session_destroy();
        header('location:../login.php');
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
            <h1>about us</h1>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eius consectetur, voluptates natus</p>
            <a href="index.php">home</a><span>/ about us</span>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <div class="about-us">]
        <div class="row">
            <div class="box">
                <div class="title">
                    <span>ABOUT OUR ONLINE STORE</span>
                    <h1>hello, with 25 years of experiance</h1>
                </div>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem quam modi 
                    fugit, saepe corporis natus libero voluptatibus iste nam sapiente quos eum quis repellendus, 
                    aspernatur deleniti. Temporibus delectus in consequatur.</p>
                
            </div>
            <div class="img-box">
                <img src="" alt="">
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <!-- features -->
    <div class="line4">
        <div class="features">
            <div class="title">
                <h1>Complete Customer Ideas</h1>
                <span>best features</span>
            </div>
            <div class="row">
                <div class="box">
                    <img src="" alt="">
                    <h4>Money Back Guarantee</h4>
                    <p>100% secure payment</p>
                </div>
                <div class="box">
                    <img src="" alt="">
                    <h4>Special Gift Card</h4>
                    <p>Give The Perfect Gift</p>
                </div>
                <div class="box">
                    <img src="" alt="">
                    <h4>Worldwide Shipping</h4>
                    <p>On Order Over $100</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <!-- team section -->
    <div class="line3"></div>
    <div class="team">
        <div class="title">
            <h1>Our Workable Team</h1>
            <span>best team</span>
        </div>
        <div class="row">
            <div class="box">
                <div class="img-box">
                    <img src="" alt="">
                </div>
                <div class="detail">
                    <span>Finance Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="icons">
                        <i class='bx bx-instagram'></i>
                        <i class="bx bx-youtube"></i>
                        <i class="bx bx-twitter"></i>
                        <i class="bx bx-behance"></i>
                        <i class="bx bx-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="" alt="">
                </div>
                <div class="detail">
                    <span>Finance Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="icons">
                        <i class='bx bx-instagram'></i>
                        <i class="bx bx-youtube"></i>
                        <i class="bx bx-twitter"></i>
                        <i class="bx bx-behance"></i>
                        <i class="bx bx-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="" alt="">
                </div>
                <div class="detail">
                    <span>Finance Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="icons">
                        <i class='bx bx-instagram'></i>
                        <i class="bx bx-youtube"></i>
                        <i class="bx bx-twitter"></i>
                        <i class="bx bx-behance"></i>
                        <i class="bx bx-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="" alt="">
                </div>
                <div class="details">
                    <span>Finance Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="icons">
                        <i class='bx bx-instagram'></i>
                        <i class="bx bx-youtube"></i>
                        <i class="bx bx-twitter"></i>
                        <i class="bx bx-behance"></i>
                        <i class="bx bx-whatsapp"></i>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="img-box">
                    <img src="" alt="">
                </div>
                <div class="details">
                    <span>Finance Manager</span>
                    <h4>Miguel Rodrigez</h4>
                    <div class="icons">
                        <i class='bx bx-instagram'></i>
                        <i class="bx bx-youtube"></i>
                        <i class="bx bx-twitter"></i>
                        <i class="bx bx-behance"></i>
                        <i class="bx bx-whatsapp"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <div class="line4"></div>
    <!-- project section  -->
    <div class="project">
        <div class="title">
            <h1>Our Best Projectt</h1>
            <span>how it works</span>
        </div>
        <div class="row">
            <div class="box">
                <img src="" alt="">
            </div>
            <div class="box">
                <img src="" alt="">
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="line2"></div>
    <!-- ideas section  -->
    <div class="ideas">
        <div class="title">
            <h1>We And Our Clients Are Happy To Cooperate With Our Company</h1>
            <span>happy clients</span>
        </div>
        <div class="row">
            <div class="box">
                <i class="bx bx-stack"></i>
                <div class="detail">
                    <h2>What We Really Do</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bx-grid-1x2-fill"></i>
                <div class="detail">
                    <h2>History of Beginning</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="box">
                <i class="bx bx-tropic-storm"></i>
                <div class="detail">
                    <h2>Our Vision</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="line3"></div>
    <?php include 'footer.php'; ?>
    <script type="" src="./scripts/user.js"></script>
</body>
</html>