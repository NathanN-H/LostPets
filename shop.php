<?php
    session_start();

    include("php/connection.php");
    if (!isset($_SESSION['valid'])) {
        header("Location: login.php");
    }
    $userId = $_SESSION['id'];
    $query = "SELECT points FROM user WHERE Id = $userId";
    $result = mysqli_query($con, $query);
    $userData = mysqli_fetch_assoc($result);
    $userPoints = $userData['points'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lost Pets</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
        <link rel="shortcut icon" type="image/x-icon" href="Design-Images/cat_shortcuticon.png">
        <style>
            body {
                font-family: 'Poppins', sans-serif; /* Update font family */
            }
            .box {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 30px;
                background-color: #f9f9f9;
                border-radius: 15px;
                box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
                z-index: 9999;
                width: 40%; /* Adjust the maximum width */
                height: 90%; /* Adjust the maximum height */
                overflow-y: auto; /* Enable vertical scroll if content exceeds height */
            }
            .background h2 {
                text-align: center;
                font-size: 50px;
            }
            .background h3 {
                text-align: center;
            }
            .background {
                margin: 20px auto;
                max-width: 90%;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                align-items: center;
            }
            .column{
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
            }
            
            .column p{
                padding: 30px;
                font-size: 15px;
            }
            .column h3 {
                font-size: 30px;
            }
            .row{
                padding-top: 50px;
                text-align: center;
            }
            .row::after{
                content: "";
                clear: both;
                display: table;
            }
            .lostpet-item-img{
                padding: 5px;
                width: 400px;
                height: 500px;
                border-radius: 10px;
                cursor: pointer;
            }
            .lostpet-voucher-img{
                padding: 5px;
                width: 400px;
                height: 250px;
                border-radius: 10px;
                cursor: pointer;
            }
            .lostpet-item {
                width: 30%;
                margin-bottom: 20px;
                text-align: center;
            }
            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <header>
            <a href="home.php"><img class="logo"src="Design-Images/cat_logo.png" alt="Cat Icon"></a>
            <h1 class="title">Lost Pets</h1>
            <p class="quote">"Help us, to help you!"</p>
            <nav>
                <div class="topnav" id="myTopnav">
                    <div class="dropdown">
                        <button class="dropbtn">
                            Missing Pets
                        </button>
                        <div class="dropdown-content">
                            <a href="report_missing_pet.php">Report Missing Pets</a>
                            <a href="missing_pets.php">View Missing Pets</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">
                            Found Pets
                        </button>
                        <div class="dropdown-content">
                            <a href="report_found_pets.php">Report Found Pets</a>
                            <a href="found_pets.php">View Found Pets</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"> <img src="">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="shop.php" class="active">Shop</a>
                            <a href="help_advice.php">Help & Advice</a>
                            <a href="contact">Contact Us</a>
                            <a href="admin_page.php">Admin</a>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
                    <div class="right-links" style="float: right">
                        <a href="account.php">Account</a>
                        <a href="php/logout.php"> <buttom class="btn">Log Out</buttom></a>
                    </div>
                </div>
            </nav>
        </header>
        <script>
            function openPopup(id) {
                var popup = document.getElementById(id);
                popup.style.display = "block";
            }

            function closePopup(id) {
                var popup = document.getElementById(id);
                popup.style.display = "none";
            }
            function getReward(rewardId, rewardPrice) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "get_reward.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("reward_id=" + rewardId + "&reward_price=" + rewardPrice);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert(xhr.responseText);
                    }
                };
            }
        </script>
        <div class="background">
            <p><strong>Points: </strong><?php echo $userPoints; ?></p>
            <h2>Lost Pets Shop</h2>
            <h3>Look around and order the goods!</h3>
            <div class="row">
                <div class="column">
                <?php
                    $query = "SELECT * FROM shop_items";
                    $result = mysqli_query($con, $query);

                    while ($data = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="lostpet-item">
                        <img class="lostpet-item-img" src="ShopImages\<?php echo $data['image'];?>" alt="Item" onclick="openPopup('<?php echo $data['id'] ?>')">
                        <div class="box" id="<?php echo $data['id'];?>">
                            <span class="close-btn" onclick="closePopup('<?php echo $data['id']; ?>')">&times;</span>
                            <img src="ShopImages\<?php echo $data['image']; ?>">
                            <h2><?php echo $data['item_name'] ?></h2>
                            <p><?php echo $data['item_description'] ?></p>
                            <p>Points: <?php echo $data['price'] ?></p>
                            <button onclick="getReward(<?php echo $data['id'];?>, <?php echo $data['price'];?>)">Get Reward</button>
                        </div>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>
            <h2>Point Gifts</h2>
            <div class="row">
                <div class="column">
                    <?php
                        $query = "SELECT * FROM shop_vouchers";
                        $result = mysqli_query($con, $query);

                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="lostpet-item">
                            <img class="lostpet-voucher-img" src="VoucherImages\<?php echo $data['image'];?>" alt="Voucher" onclick="openPopup('<?php echo $data['id'] ?>')">
                            <div class="box" id="<?php echo $data['id']; ?>">
                                <span class="close-btn" onclick="closePopup('<?php echo $data['id']; ?>')">&times;</span>
                                <img src="VoucherImages\<?php echo $data['image']; ?>">
                                <h2><?php echo $data['voucher_name'] ?></h2>
                                <p><?php echo $data['voucher_description'] ?></p>
                                <p>Points: <?php echo $data['price'] ?></p>
                                <button onclick="getReward(<?php echo $data['id'];?>, <?php echo $data['price'];?>)">Get Reward</button>
                            </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <script>
            window.embeddedChatbotConfig = {
            chatbotId: "LaKRJr_-iPekl6Al0xMG6",
            domain: "www.chatbase.co"
            }
        </script>
        <script
            src="https://www.chatbase.co/embed.min.js"
            chatbotId="LaKRJr_-iPekl6Al0xMG6"
            domain="www.chatbase.co"
            defer>
        </script>
    </body>
</html>