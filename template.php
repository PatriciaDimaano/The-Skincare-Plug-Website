<?php
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>The Skincare Plug - </title>
</head>

<body>
    <header>
        <div class = "topnav">
        <a href = "index.php"><img class = "logo" src="images/logo.png" alt="The Skincare Plug logo"></a>
        <form class = "search-form" action="search.php" method="GET">
            <div class = "search">
                <img class = "search_icon" src="images/icon_search.png" alt="Search Button">
                <input class="search-input" type="search" placeholder="Search for a product" name="keyword">
            </div>
        </form>
        <div class = "user-actions">
            <?php if (isset($_SESSION['user_ID'])): ?>
                <a href="user_account.php"><img class="user_icon" src="images/icon_user.png" alt="User Account Icon"></a>
            <?php else: ?>
                <a href="login.php"><img class="user_icon" src="images/icon_user.png" alt="User Account Icon"></a>
            <?php endif; ?>
                <a href = "favorites.php"><img class = "heart_icon" src="images/icon_heart.png" alt="Favorites Icon"></a>
                <a href = "cart.php"><img class = "cart_icon" src="images/icon_cart.png" alt="Shopping Cart Icon"></a>
        </div>
        </div>
        <div class = "menu_nav">
            <ul>
                <li><a href = "all_products.php">All Products</a></li>
                <li><a href = "skincare.php">Skincare</a></li>
                <li><a href = "hair_body_makeup.php">Hair, Body, & Makeup</a></li>
            </ul>
        </div>
    </header>

    <main>

    </main>

    <div class = "social_media">
            <span> Follow us to earn 50 reward points! </span>
            <a href = "https://www.instagram.com"><img class = "icon_ig" src="images/icon_ig.png" alt="Instagram Icon"></a>
            <a href = "https://www.facebook.com"><img class = "icon_fb" src="images/icon_fb.png" alt="Facebook Icon"></a>
            <a href = "https://www.tiktok.com"><img class = "icon_tiktok" src="images/icon_tiktok.png" alt="TikTok Icon"></a>
    </div>
    <footer>
        <div class = "sub_info">
            <img class = "email_banner" src="images/email_banner.jpeg" alt="Newletter Signup Banner">
            <div class = "sub_form">
                <input class="sub_email" name="sub_email" type="text" autocomplete="email" placeholder="Enter your email address here">
                <img class = "sub_icon" src="images/icon_subscribe.png" alt="Email Subscription Button">
            </div>
        </div>
        <div class = "other_links">
            <div>
                <h2>Customer Support</h2>
                <ul>
                    <li><a href = "tracking.php">Order Tracking</a></li>
                    <li><a href = "return_exchange.php">Returns & Exchanges</a></li>
                    <li><a href = "shipping.php">Shipping Information</a></li>
                    <li><a href = "contact_us.php">Contact Us</a></li>
                    <li>FAQs</li>
                </ul>
            </div>
            <div>
                <h2>About Us</h2>
                <ul>
                    <li><a href = "about_us.html">About The Skincare Plug</a></li>
                    <li>Careers</li>
                    <li>Press & Media</li>
                    <li>Affiliate Program</li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>