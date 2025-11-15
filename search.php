<?php
    session_start();

    $host = 'localhost';
    $db_name = 'TheSkincarePlug';
    $username = 'root';
    $password = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
    $options =
        [PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false];
 
?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>The Skincare Plug - Search Results</title>

    <style>
        main {
            text-align: center;
        }

        .product_table {
            display: flex;
            flex-wrap: wrap;
            width: 100%;
        }

        .table_item {
            flex-basis: 25%;
            padding: 15px;
            box-sizing: border-box;
        }

        .product_image_container {
            position: relative;
            display: block;
        }

        .product_image {
            width: 100%;
            height: auto;
            border-radius: 5%;
        }

        .favorite {
            display: block;
            width: 30px;
            height: 30px;
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background-image: url('images/unfavorite.png');
            background-size: 30px 30px;
            background-repeat: no-repeat;
            background-position: center;
        }

        .favorite:hover, .favorite:active {
            background-image: url('images/favorite.png');
        }

        .product_name, .product_price, .cart_btn {
            font-weight: bold;
            font-size: 1rem;
        }

        .cart_btn{
            padding: 10px 50px;
            color: #F3EFE5;
            text-decoration: none;
            border-radius: 5px;
            background-color: #85997F;
        }

        .cart_btn:hover{
            background-color: #426C36;
        }


        /**********************************************************************/
        /**********************************************************************/
        /********************** MOBILE SCREEN RESPONSIVENESS ******************/
        /**********************************************************************/
        /**********************************************************************/


        @media screen and (max-width: 1024px) {
            .table_item {
                flex-basis: 50%;
            }

            .product_name, .product_price, .cart_btn {
            font-weight: bold;
            font-size: 13px;
            }

            .cart_btn{
                padding: 8px 30px;
            }
        }
    </style>

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
                <a href="favorites.php"><img class="heart_icon" src="images/icon_heart.png" alt="Favorites Icon"></a>
                <a href="cart.php"><img class="cart_icon" src="images/icon_cart.png" alt="Shopping Cart Icon"></a>
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

        <?php
            if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
                $search_term = htmlspecialchars($_GET['keyword']);

                echo "<h3>Search Results for \"" . $search_term . "\"</h3>";

                try {
                $pdo = new PDO($dsn, $username, $password, $options);
                $sql = "SELECT Product_Name, Product_Price, Product_Image_Link, Product_Page_Link FROM Product 
                    WHERE Product_Name LIKE ? OR Product_Description LIKE ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["%" . $search_term . "%", "%" . $search_term . "%"]);
                $products = $stmt->fetchAll();

                if ($products) { ?>
                    <div class="product_table">
                        <?php foreach ($products as $product): ?>
                            <div class = "table_item">
                                <div class = "product_image_container">
                                    <a href="<?= htmlspecialchars($product['Product_Page_Link']) ?>">
                                    <img class="product_image" src="<?= htmlspecialchars($product['Product_Image_Link']) ?>" alt="<?= htmlspecialchars($product['Product_Name']) ?>">
                                    </a>
                                    <a href = "favorites.php?id=<?= $product['Product_ID'] ?>" class = "favorite" alt="Add to Favorites"></a>
                                </div>
                                <p class="product_name"><?= htmlspecialchars($product['Product_Name']) ?></p>
                                <p class="product_price"><span style = "color: #F55A51; text-decoration-line: line-through;">$<?= number_format($product['Product_Price'], 2) ?></span>
                                    $<?= number_format(($product['Product_Price'])/2, 2) ?></p>
                                <a class="cart_btn" href = "">Add to Cart</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php
                } 
                    else {
                        echo "<h3>Sorry, there are no products matching '" . $search_term . "'.</h3>";
                    }
                } 
                catch (PDOException $e) {
                    echo "<h3>DATABASE ERROR:</h3><pre>" . $e->getMessage() . "</pre>";
                }
            } else {
                echo "<h3>Please enter a search term in the box above.</h3>";
            }
        ?>

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