<?php
    session_start();

    include("php/connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    function checkApprovedOrders($userId, $con) {
        $queryApprovedOrders = "SELECT COUNT(*) AS total_approved FROM user_items WHERE user_id = $userId AND approved = 1";
        $resultApprovedOrders = mysqli_query($con, $queryApprovedOrders);

        if($resultApprovedOrders) {
            $row = mysqli_fetch_assoc($resultApprovedOrders);
            return $row['total_approved'];
        } else {
            return 0;
        }
    }
    $userId = $_SESSION['id'];
    $totalApprovedOrders = checkApprovedOrders($userId, $con);

    if(!isset($_SESSION['order_approved_message_count'])) {
        $_SESSION['order_approved_message_count'] = 0;
    }

    $orderApprovedMessageCount = $_SESSION['order_approved_message_count'];
    if($totalApprovedOrders > 0 && $orderApprovedMessageCount < 3) {
        $orderApprovedMessage = true;
        $_SESSION['order_approved_message_count']++;
    } else {
        $orderApprovedMessage = false;
    }
?>
<!DOCTYPE html>
<html land="en">
    <head>
        <meta charset="UTF-8">
        <title>Lost Pets</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
        <link rel="shortcut icon" type="image/x-icon" href="Design-Images/cat_shortcuticon.png">
        <style>
            .info {
                margin: 20px auto;
                max-width: 600px;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                align-items: center;
            }
            .info strong {
                font-weight: bold;
                margin-top: 10px;
                display: block;
                text-align: center;
                border-bottom: 1px solid #ccc;
                padding-bottom: 5px;
            }
            .info p {
                margin: 5px 0;
                text-align: center;
            }
            .info h1 {
                text-align: center;
                padding: 10px;
            }
            iframe {
                border: none;
                margin-top: 10px;
            }
            .butn {
                text-align: center;
                display: block;
                margin: 0 auto;
                height: 30px;
                background: #7aa3fc88;
                text-decoration: none;
                border: 0;
                border-radius: 5px;
                color: #000000;
                font-size: 20px;
                cursor: pointer;
                transition: all .3s;
            }
            .delete-btn {
                display: block;
                margin: 10px auto;
                width: fit-content;
                padding: 10px 20px;
                background-color: #ff6b6b;
                border: none;
                border-radius: 5px;
                color: #fff;
                font-size: 18px;
                cursor: pointer;
                text-decoration: none;
                transition: background-color 0.3s ease;
            }

            .delete-btn:hover {
                background-color: #e74c3c;
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
                            <a href="shop.php">Shop</a>
                            <a href="help_advice.php">Help & Advice</a>
                            <a href="contact.html">Contact Us</a>
                            <a href="admin_page.php">Admin</a>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
                    <div class="right-links" style="float: right">
                        <a href="#">Account</a>
                        <?php

                            $id = $_SESSION['id'];
                            $query = mysqli_query($con, "SELECT * FROM user WHERE Id=$id");

                            while($result = mysqli_fetch_assoc($query)){
                                $res_Uname = $result['Username'];
                                $res_Email = $result['Email'];
                                $res_Age = $result['Age'];
                                $res_petdescription = $result['petdescription'];
                                $res_address = $result['address'];
                                $res_id = $result['Id'];
                        
                            

                        ?>
                        <a href="php/logout.php"> <buttom class="btn" style="">Log Out</buttom></a>
                    </div>
                </div>
            </nav>
        </header>
            <div class="info">
                <h1>Account Details</h1>
                <strong>Username</strong>
                <p><?php echo $res_Uname?></p>
                <strong>Email</strong>
                <p><?php echo $res_Email?></p>
                <strong>Age</strong>
                <p><?php echo $res_Age?></p>
                <strong>Pet Description</strong>
                <p><?php echo $res_petdescription?></p>
                <strong>Current Location</strong>
                <iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php
                echo $res_address?>&output=embed"></iframe>
                
                <?php if ($orderApprovedMessage): ?>
                    <p>Your order has been approved and is on the way!</p>
                <?php endif; ?>

                <a href="edit.php" class="butn">Edit Profile</a>
                <a href="php/delete_account.php?delete_id=<?php echo $res_id; ?>" class="delete-btn">Delete Account</a>
            </div> 
        
        <?php
            }
        ?>
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