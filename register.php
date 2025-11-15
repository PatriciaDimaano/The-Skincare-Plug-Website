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

    <style>
        main {
            text-align: center;
        }

        .register_div {
            max-width: 30%;
            margin: 50px auto;
            padding: 20px;
            border: 5px solid #DFDED8;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        h3{
            margin-bottom: 40px;
        }

        h4{
            margin-bottom: 20px;
        }

        .register_form label, .register_form input, .register_form select {
            text-align: left;
            margin-bottom: 15px;
        }

        .register_form input, .register_form select {
            width: 60%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .register_btn{
            padding: 10px 20px;
            margin-bottom: 25px;
            background-color: #85997F;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .register_btn:hover {
            background-color: #36322A;
        }

        /**********************************************************************/
        /**********************************************************************/
        /********************** MOBILE SCREEN RESPONSIVENESS ******************/
        /**********************************************************************/
        /**********************************************************************/


        @media screen and (max-width: 1024px) {
            .register_div {
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
        <div class="register_div">
            <form action="register.php" method="POST" class="register_form">
                <h3>Create Your Account</h3>
                <h4>Personal Information:</h4>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <br>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <br>
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <br>
                <label for ="birthdate">Date of Birth:</label>
                <input type="date" id="birthdate" name="birthdate" required>
                <br>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="" disabled selected  >Select your gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="Non_binary">Non-binary</option>
                    <option value="Prefer_not_to_say">Prefer not to say</option>
                </select>
                <br>
                <h4>Shipping Information:</h4>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
                <br>
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
                <br>
                <label for="state">State/Province:</label>
                <input type="text" id="state" name="state" required>
                <br>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
                <br>
                <button type="submit" class="register_btn">Register</button>
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </form>
            <?php
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
                    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'], $_POST['birthdate'], $_POST['gender'], 
                    $_POST['address'], $_POST['city'], $_POST['state'], $_POST['country'])) {
                        $first_name = $_POST['first_name'];
                        $last_name = $_POST['last_name'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        $birthdate = $_POST['birthdate'];
                        $gender = $_POST['gender'];
                        $address = $_POST['address'];
                        $city = $_POST['city'];
                        $state = $_POST['state'];
                        $country = $_POST['country'];
                        
                        $sql = "INSERT INTO User (User_FName, User_LName, User_Email, User_Password, User_Birthdate, User_Gender, 
                            User_Address, User_City, User_State, User_Country)
                                VALUES (:first_name, :last_name, :email, :password, :birthdate, :gender, :address, :city, :state, :country)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':first_name' => $first_name,
                            ':last_name' => $last_name,
                            ':gender' => $gender,
                            ':address' => $address,
                            ':city' => $city,
                            ':state' => $state,
                            ':country' => $country,
                            ':birthdate' => $birthdate,
                            ':email' => $email,
                            ':password' => $password
                        ]);
                        echo "<p style='color: green;'>Registration successful! You can now <a href='login.php'>login</a>.</p>";
                    } else{
                        //echo "<p style='color: red;'>Please fill in all fields.</p>";
                    }
                } catch (\PDOException $e) {
                    echo "Database error: " . $e->getMessage();
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