<?php
    session_start();
?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>The Skincare Plug - Login</title>

    <style>
        main {
            text-align: center;
        }

        .login_div {
            max-width: 30%;
            margin: 50px auto;
            padding: 20px;
            border: 5px solid #DFDED8;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        h3{
            margin-bottom: 50px;
        }

        .login_form label, .login_form input {
            text-align: left;
            margin-bottom: 25px;
        }

        .login_form input {
            width: 60%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login_btn{
            padding: 10px 20px;
            margin-bottom: 25px;
            background-color: #85997F;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .login_btn:hover {
            background-color: #36322A;
        }

        /**********************************************************************/
        /**********************************************************************/
        /********************** MOBILE SCREEN RESPONSIVENESS ******************/
        /**********************************************************************/
        /**********************************************************************/


        @media screen and (max-width: 1024px) {
            .login_div {
                max-width: 100%;
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
        <div class="login_div">
            <form action="login.php" method="POST" class="login_form">
            <h3>Login to Your Account</h3>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit" class="login_btn">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
       <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

                try {
                    $pdo = new PDO($dsn, $username, $password, $options);
                    if(isset($_POST['email']) && isset($_POST['password'])) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $sql = "SELECT * FROM User WHERE User_Email = '$email' && User_Password = '$password'";
                        $result = $pdo->query($sql);

                        if($result->rowCount() > 0) {
                            $user = $result->fetch();
                            $_SESSION['user_ID'] = $user['User_ID'];
                            $_SESSION['user_FName'] = $user['User_FName'];
                            $_SESSION['user_LName'] = $user['User_LName'];
                            $_SESSION['user_Gender'] = $user['User_Gender'];
                            $_SESSION['user_Address'] = $user['User_Address'];
                            $_SESSION['user_City'] = $user['User_City'];
                            $_SESSION['user_State'] = $user['User_State'];
                            $_SESSION['user_Country'] = $user['User_Country'];
                            $_SESSION['user_Birthdate'] = $user['User_Birthdate'];
                            $_SESSION['user_Email'] = $user['User_Email'];
                            
                            echo "<script>
                                alert('Login successful! Welcome back, {$user['User_FName']}.');
                                window.location.href = 'index.php';
                            </script>";

                        } else {
                            echo "<p style='color: red;'>Invalid email or password. Please try again.</p>";
                        }
                    }
                } catch (\PDOException $e) {
                    echo "Database error: " . $e->getMessage();
                }
            }
        ?>
        </div>
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