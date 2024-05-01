<?php
session_start();
include("php/connection.php");
if(!isset($_SESSION['valid'])){
    header("Location: login.php");
}


// Check if the logged-in user is admin
if ($_SESSION['password'] !== "adminpassword") {
    header("Location: home.php"); 
    exit();
}

// Approve or reject reports
if (isset($_POST['approve'])) {
    $report_id = $_POST['report_id'];
    $sql = "UPDATE missing_pets SET approved = 1 WHERE id = $report_id";
    mysqli_query($con, $sql);
}
// Approve found pets
if (isset($_POST['approve'])) {
    $report_id = $_POST['report_id'];
    $sql = "UPDATE found_pets SET approved = 1 WHERE id = $report_id";
    if(mysqli_query($con, $sql)) {
        // Redirect back to the admin page after approval
        header("Location: admin_page.php");
        exit();
    } else {
        // Handle approval error
        echo "Error approving record: " . mysqli_error($con);
    }
}

// Fetch pending reports for missing pets with user information
$queryPendingMissingPets = "SELECT missing_pets.*, user.Username AS creator_username FROM missing_pets LEFT JOIN user ON missing_pets.user_id = user.Id WHERE missing_pets.approved = 0";
$resultPendingMissingPets = mysqli_query($con, $queryPendingMissingPets);

// Fetch approved reports for missing pets with user information
$queryApprovedMissingPets = "SELECT missing_pets.*, user.Username AS creator_username FROM missing_pets LEFT JOIN user ON missing_pets.user_id = user.Id WHERE missing_pets.approved = 1";
$resultApprovedMissingPets = mysqli_query($con, $queryApprovedMissingPets);

// Fetch pending reports for found pets with user information
$queryPendingFoundPets = "SELECT found_pets.*, user.Username AS creator_username FROM found_pets LEFT JOIN user ON found_pets.user_id = user.Id WHERE found_pets.approved = 0";
$resultPendingFoundPets = mysqli_query($con, $queryPendingFoundPets);

// Fetch approved reports for found pets with user information
$queryApprovedFoundPets = "SELECT found_pets.*, user.Username AS creator_username FROM found_pets LEFT JOIN user ON found_pets.user_id = user.Id WHERE found_pets.approved = 1";
$resultApprovedFoundPets = mysqli_query($con, $queryApprovedFoundPets);

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
            width: 80%; /* Adjust the maximum width */
            height: 80%; /* Adjust the maximum height */
            overflow-y: auto; /* Enable vertical scroll if content exceeds height */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .show-tables-btn {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .show-tables-btn:hover {
            background-color: #45a049;
        }
        .main-header {
            text-align: center;
            padding: 40px;
        }
        .column{
            float: left;
            width: 33.33%;
            padding-bottom: 5%;
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
        .adminintro {
            max-width: 80%;
            margin: 0 auto;
            padding: 20px;
            text-align: left;
        }
        .adminintro h2 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .adminintro p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .adminintro h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .adminintro strong {
            font-weight: bold;
        }
        .shop-title{
            padding-top: 50px;
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
                        <a href="#" class="active">Admin</a>
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
    </script>
    <div class="adminintro">
        <h2 class="main-header">Welcome Admin</h2>
        <p>
            The <strong>Admin Page</strong> serves as the command center, the nerve center, and the control hub of a digital ecosystem. It's the backstage of a website, application, or system, where administrators 
            wield their power to manage, monitor, and maintain the platform's functionality, security, and content.
        </p>
        <h3>Why is it Needed?</h3>
        <strong>1. Management</strong>
        <p>
            The Admin Page provides tools for managing users, content, and settings. Administrators can create, edit, or delete accounts, update information, and configure various aspects of the 
            platform to meet the needs of its users.
        </p>
        <strong>2. Monitoring</strong>
        <p>
            It allows administrators to monitor the performance and usage of the system. They can track user activity, analyze traffic patterns, and gather insights to optimize the platform's 
            performance and user experience.
        </p>
        <strong>3. Security</strong>
        <p>
            Admin Pages are crucial for maintaining the security of the platform. Administrators can set access controls, enforce security policies, and detect and respond to security threats to 
            safeguard sensitive information and protect against unauthorized access.
        </p>
        <strong>4. Content Management</strong>
        <p>
            Content creation, editing, and moderation are essential functions of the Admin Page. Administrators can publish, update, or remove content, manage media files, and ensure that the 
            platform's content aligns with its goals and standards.
        </p>
        <strong>5. Customization</strong>
        <p>
            The Admin Page often offers customization options to tailor the platform to specific requirements. Administrators can customize layouts, design elements, and features to create a 
            unique and engaging user experience.
        </p>
        <strong>6. Troubleshooting</strong>
        <p>
            In the event of technical issues or errors, the Admin Page provides diagnostic tools and logs to identify and resolve problems efficiently. Administrators can troubleshoot issues, 
            apply fixes, and maintain the platform's reliability and availability.
        </p>
    </div>
    <div class="row">
        <div class="column">
            <h1>Missing and Found Pets</h1>
            <button class="show-tables-btn" onclick="openPopup('popup1')">Show tables</button>
            <div class="box" id="popup1">
                <span class="close-btn" onclick="closePopup('popup1')">&times;</span>
                <h2>Missing Pets Approval Requests</h2>
                <h3>Pending Requests</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Creator Username</th>
                            <th>Pet Name</th>
                            <th>Age</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display each pending report for missing pets as a table row
                        while ($row = mysqli_fetch_assoc($resultPendingMissingPets)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['creator_username'] . "</td>";
                            echo "<td>" . $row['lost_pet_name'] . "</td>";
                            echo "<td>" . $row['lost_pet_age'] . "</td>";
                            echo "<td>" . $row['lost_pet_description'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td><img src='MissingImages/" . $row['image'] . "'></td>";
                            echo "<td>
                                    <form method='post'>
                                        <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                        <input type='submit' name='approve' value='Approve'>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <h3>Missing Pets Approved Requests</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Creator Username</th>
                            <th>Pet Name</th>
                            <th>Age</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        // Display each approved report for missing pets as a table row
                        while ($row = mysqli_fetch_assoc($resultApprovedMissingPets)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['creator_username'] . "</td>";
                            echo "<td>" . $row['lost_pet_name'] . "</td>";
                            echo "<td>" . $row['lost_pet_age'] . "</td>";
                            echo "<td>" . $row['lost_pet_description'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td><img src='MissingImages/" . $row['image'] . "'></td>";
                            // Add a delete button for approved requests
                            echo "<td>
                                    <form method='post' action='admin_delete_missing.php'> <!-- Assuming admin_delete.php contains the logic to delete the record -->
                                        <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                        <button type='submit' name='delete'>Delete</button>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <h2>Found Pets Approval Requests</h2>
                <h3>Pending Requests</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Creator Username</th>
                            <th>Pet Name</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Display each pending report for found pets as a table row
                        while ($row = mysqli_fetch_assoc($resultPendingFoundPets)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['creator_username'] . "</td>";
                            echo "<td>" . $row['found_pet_nametag'] . "</td>";
                            echo "<td>" . $row['found_pet_description'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td><img src='FoundImages/" . $row['image'] . "'></td>";
                            echo "<td>
                                <form method='post'>
                                    <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                    <input type='submit' name='approve' value='Approve'>
                                </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <h3>Found Pets Approved Requests</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Creator Username</th>
                            <th>Pet Name</th>
                            <th>Description</th>
                            <th>Address</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Display each approved report for found pets as a table row
                        while ($row = mysqli_fetch_assoc($resultApprovedFoundPets)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['creator_username'] . "</td>";
                            echo "<td>" . $row['found_pet_nametag'] . "</td>";
                            echo "<td>" . $row['found_pet_description'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td><img src='FoundImages/" . $row['image'] . "'></td>";
                            // Add a delete button for approved requests
                            echo "<td>
                                <form method='post' action='admin_delete_found.php'> <!-- Assuming admin_delete.php contains the logic to delete the record -->
                                    <input type='hidden' name='report_id' value='" . $row['id'] . "'>
                                    <button type='submit' name='delete'>Delete</button>
                                </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="column">
            <h1>User Management</h1>
            <!-- Button to open the user management popup -->
            <button class="show-tables-btn" onclick="openPopup('popup2')">Show users</button>
            <div class="box" id="popup2">
                <span class="close-btn" onclick="closePopup('popup2')">&times;</span>
                <h1>User Management</h1>
                <h3>Ban Users</h3>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryUsers = "SELECT * FROM user";
                        $resultUsers = mysqli_query($con, $queryUsers);
                        // Display each user as a table row
                        while ($row = mysqli_fetch_assoc($resultUsers)) {
                            echo "<tr>";
                            echo "<td>" . $row['Id'] . "</td>";
                            echo "<td>" . $row['Username'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['Age'] . "</td>";
                            echo "<td>
                                    <form method='post' action='admin_user_delete.php'>
                                        <input type='hidden' name='user_id' value='" . $row['Id'] . "'>
                                        <input type='submit' name='delete_user' value='Ban' style='background: red; cursor: pointer;'>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <h3>Reward Users Points</h3>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Address</th>
                            <th>Points</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $queryPointsUsers = "SELECT * FROM user";
                            $resultPointsUsers = mysqli_query($con, $queryPointsUsers);

                            while ($row = mysqli_fetch_assoc($resultPointsUsers))
                            {
                                echo "<tr>";
                            echo "<td>" . $row['Id'] . "</td>";
                            echo "<td>" . $row['Username'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['Age'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['points'] . "</td>";
                            echo "<td>
                                    <form method='post' action='admin_user_points.php'>
                                        <input type='hidden' name='user_points_id' value='" . $row['Id'] . "'>
                                        <input type='submit' name='points_user' value='Reward' style='background: green; cursor: pointer;'>
                                    </form>
                                </td>";
                            echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <h2>User Items</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Description</th>
                            <th>Item Price</th>
                            <th>Item Image</th>
                            <th>Purchase Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Display each user item as a table row
                        $queryUserItems = "SELECT user_items.*, user.Username AS user_username, user.Email AS user_email, user.address AS user_address, shop_items.item_name, shop_items.item_description, shop_items.price, shop_items.image AS item_image 
                                        FROM user_items 
                                        INNER JOIN user ON user_items.user_id = user.Id 
                                        INNER JOIN shop_items ON user_items.item_id = shop_items.id 
                                        ORDER BY user_items.id"; // Order by user_items.id
                        $resultUserItems = mysqli_query($con, $queryUserItems);

                        if (!$resultUserItems) {
                            // Display error message if query fails
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Display user items
                            while ($row = mysqli_fetch_assoc($resultUserItems)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['user_username'] . "</td>";
                                echo "<td>" . $row['user_email'] . "</td>";
                                echo "<td>" . $row['user_address'] . "</td>";
                                echo "<td>" . $row['item_id'] . "</td>";
                                echo "<td>" . $row['item_name'] . "</td>";
                                echo "<td>" . $row['item_description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td><img src='ShopImages/" . $row['item_image'] . "'></td>";
                                echo "<td>" . $row['purchase_date'] . "</td>";
                                echo "</tr>";
                            }
                        }

                        ?>

                    </tbody>
                </table>
                <h2>User Vouchers</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Voucher ID</th>
                            <th>Voucher Name</th>
                            <th>Voucher Description</th>
                            <th>Voucher Price</th>
                            <th>Voucher Image</th>
                            <th>Purchase Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // Display each user voucher as a table row
                        $queryUserVouchers = "SELECT user_items.*, user.Username AS user_username, user.Email AS user_email, user.address AS user_address, shop_vouchers.voucher_name, shop_vouchers.voucher_description, shop_vouchers.price, shop_vouchers.image AS voucher_image 
                                        FROM user_items 
                                        INNER JOIN user ON user_items.user_id = user.Id 
                                        INNER JOIN shop_vouchers ON user_items.item_id = shop_vouchers.id 
                                        ORDER BY user_items.id"; // Order by user_items.id
                        $resultUserVouchers = mysqli_query($con, $queryUserVouchers);

                        if (!$resultUserVouchers) {
                            // Display error message if query fails
                            echo "Error: " . mysqli_error($con);
                        } else {
                            // Display user vouchers
                            while ($row = mysqli_fetch_assoc($resultUserVouchers)) {
                                echo "<tr>";
                                echo "<td>" . $row['user_id'] . "</td>";
                                echo "<td>" . $row['user_username'] . "</td>";
                                echo "<td>" . $row['user_email'] . "</td>";
                                echo "<td>" . $row['user_address'] . "</td>";
                                echo "<td>" . $row['item_id'] . "</td>";
                                echo "<td>" . $row['voucher_name'] . "</td>";
                                echo "<td>" . $row['voucher_description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td><img src='VoucherImages/" . $row['voucher_image'] . "'></td>";
                                echo "<td>" . $row['purchase_date'] . "</td>";
                                echo "</tr>";
                            }
                        }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="column">
            <h1>Shop Items</h1>
            <button class="show-tables-btn" onclick="openPopup('popup3')">Show Shop</button>
            <div class="box" id="popup3">
            <span class="close-btn" onclick="closePopup('popup3')">&times;</span>
                <?php
                    if (isset($_POST['submit_item'])) {
                        $file_name = $_FILES['image']['name'];
                        $tempname = $_FILES['image']['tmp_name'];
                        $folder = 'ShopImages/' . $file_name;
                        $item_name = $_POST['item_name'];
                        $item_description = $_POST['item_description'];
                        $price = $_POST['price'];
                        $stock_quantity = $_POST['stock_quantity'];
                
                        // Insert the item into the shop_items table
                        $sql = "INSERT INTO shop_items (item_name, item_description, image, price, stock_quantity) VALUES ('$item_name', '$item_description', '$file_name', $price, $stock_quantity)";
                        mysqli_query($con, $sql);
                
                        if (move_uploaded_file($tempname, $folder)) {
                            echo "<h2>File uploaded successfully</h2>";
                        } else {
                            echo "<h2>File not Uploaded</h2>";
                        }
                    } 
                ?>
                <h1 class="shop-title" onclick="toggleAddItemForm()" style="cursor: pointer;">Add Item to Shop</h1>
                <div class="box form-box" id="addItemForm" style="display: none;">
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <div class="field input">
                            <label for="item_name">Item Name:</label><br>
                            <input type="text" id="item_name" name="item_name" required><br>
                        </div>
                        
                        <div class="field input">
                            <label for="item_description">Item Description:</label><br>
                            <textarea id="item_description" name="item_description" rows="4" required></textarea><br>
                        </div>
                        
                        <div class="field input">
                            <label for="image">Upload Image</label><br>
                            <p>File has to be 50KB or under</p>
                            <input type="file" id="image" name="image" value="Upload Image" autocomplete="off" required><br>
                        </div>
                        
                        <div class="field input">
                            <label for="price">Price:</label><br>
                            <input type="number" id="price" name="price" step="0.01" min="0" required><br>
                        </div>
                        
                        <div class="field input">
                            <label for="stock_quantity">Stock Quantity:</label><br>
                            <input type="number" id="stock_quantity" name="stock_quantity" min="0" required><br>
                        </div>
                        
                        <div class="field">
                            <input type="submit" name="submit_item" value="Add Item">
                        </div>
                    </form>
                </div>
                

                <?php
                    // Check if the form for submitting a voucher is submitted
                    if (isset($_POST['submit_voucher'])) {
                        $file_name = $_FILES['image']['name'];
                        $tempname = $_FILES['image']['tmp_name'];
                        $folder = 'VoucherImages/' . $file_name;
                        $voucher_name = $_POST['voucher_name'];
                        $voucher_description = $_POST['voucher_description'];
                        $price = $_POST['price'];

                        // Insert the item into the shop_vouchers table
                        $sql = "INSERT INTO shop_vouchers (voucher_name, voucher_description, image, price) VALUES ('$voucher_name', '$voucher_description', '$file_name', $price)";
                        mysqli_query($con, $sql);

                        if (move_uploaded_file($tempname, $folder)) {
                            echo "<h2>File uploaded successfully</h2>";
                        } else {
                            echo "<h2>File not Uploaded</h2>";
                        }
                    }
                ?>

                <h1 class="shop-title" onclick="toggleAddVoucherForm()" style="cursor: pointer;">Add Voucher to Shop</h1>
                <div class="box form-box" id="addVoucherForm" style="display: none;">
                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="field input">
                            <label for="voucher_name">Item Name:</label><br>
                            <input type="text" id="voucher_name" name="voucher_name" required><br>
                        </div>
                        
                        <div class="field input">
                            <label for="voucher_description">Item Description:</label><br>
                            <textarea id="voucher_description" name="voucher_description" rows="4" required></textarea><br>
                        </div>

                        <div class="field input">
                            <label for="image">Upload Image</label><br>
                            <p>File has to be 50KB or under</p>
                            <input type="file" id="image" name="image" value="Upload Image" autocomplete="off" required><br>
                        </div>

                        <div class="field input">
                            <label for="price">Price:</label><br>
                            <input type="number" id="price" name="price" step="0.01" min="0" required><br>
                        </div>

                        <div class="field">
                            <input type="submit" name="submit_voucher" value="Add Voucher">
                        </div>
                    </form>
                </div>
                

                <h1 class="shop-title" onclick="toggleRemoveItem()" style="cursor: pointer;">Remove Item</h1>
                    <table id="removeItem" style="display: none;">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Item Description</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock Quantity</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryItems = "SELECT * FROM shop_items";
                            $resultItems = mysqli_query($con, $queryItems);
                            // Display each user as a table row
                            while ($row = mysqli_fetch_assoc($resultItems)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['item_name'] . "</td>";
                                echo "<td>" . $row['item_description'] . "</td>";
                                echo "<td><img src='ShopImages/" . $row['image'] . "'></td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['stock_quantity'] . "</td>";
                                echo "<td>" . $row['created_at'] , "</td>";
                                echo "<td>
                                        <form method='post' action='admin_delete_item.php'>
                                            <input type='hidden' name='item_id' value='" . $row['id'] . "'>
                                            <input type='submit' name='delete_item' value='Delete'>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                
                <h1 class="shop-title" onclick="toggleRemoveVoucher()" style="cursor: pointer;">Remove Voucher</h1>
                <table id="removeVoucher" style="display: none;">
                    <thead>
                        <tr>
                            <th>Voucher ID</th>
                            <th>Voucher Name</th>
                            <th>Voucher Description</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryItems = "SELECT * FROM shop_vouchers";
                        $resultItems = mysqli_query($con, $queryItems);
                        // Display each user as a table row
                        while ($row = mysqli_fetch_assoc($resultItems)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['voucher_name'] . "</td>";
                            echo "<td>" . $row['voucher_description'] . "</td>";
                            echo "<td><img src='VoucherImages/" . $row['image'] . "'></td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td>" . $row['created_at'] , "</td>";
                            echo "<td>
                                    <form method='post' action='admin_delete_voucher.php'>
                                        <input type='hidden' name='voucher_id' value='" . $row['id'] . "'>
                                        <input type='submit' name='delete_voucher' value='Delete'>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>

                <h1 class="shop-title" onclick="toggleEditItem()" style="cursor: pointer;">All Items</h1>
                <table id="editItem" style="display: none;">
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Item Description</th>
                            <th>Price</th>
                            <th>Stock Quantity</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM shop_items";
                            $result = $con->query($sql);
                    
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["item_name"] . "</td>";
                                    echo "<td>" . $row["item_description"] . "</td>";
                                    echo "<td>" . $row["price"] . "</td>";
                                    echo "<td>" . $row["stock_quantity"] . "</td>";
                                    echo "<td><a href='edit_item.php?id=" . $row["id"] . "'>Edit</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No items found</td></tr>";
                            }
                        ?>
                </table>

                <h1 class="shop-title" onclick="toggleEditVoucher()" style="cursor: pointer;">All Vouchers</h1>
                <table id="editVoucher" style="display: none;">
                        <tr>
                            <th>ID</th>
                            <th>Voucher Name</th>
                            <th>Voucher Description</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            $sql = "SELECT * FROM shop_vouchers";
                            $result = $con->query($sql);
                    
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["voucher_name"] . "</td>";
                                    echo "<td>" . $row["voucher_description"] . "</td>";
                                    echo "<td>" . $row["price"] . "</td>";
                                    echo "<td><a href='edit_voucher.php?id=" . $row["id"] . "'>Edit</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No items found</td></tr>";
                            }
                        ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        function toggleAddItemForm(){
            var addItemForm = document.getElementById('addItemForm');
            if (addItemForm.style.display === 'none') {
                addItemForm.style.display = 'block';
            } else {
                addItemForm.style.display = 'none';
            }
        }
        function toggleRemoveItem(){
            var removeItem = document.getElementById('removeItem');
            if (removeItem.style.display === 'none') {
                removeItem.style.display = 'block';
            } else {
                removeItem.style.display = 'none';
            }
        }
        function toggleEditItem(){
            var editItem = document.getElementById('editItem');
            if (editItem.style.display === 'none') {
                editItem.style.display = 'block';
            } else {
                editItem.style.display = 'none';
            }
        }
        function toggleAddVoucherForm(){
            var addVoucherForm = document.getElementById('addVoucherForm');
            if (addVoucherForm.style.display === 'none') {
                addVoucherForm.style.display = 'block';
            } else {
                addVoucherForm.style.display = 'none';
            }
        }
        function toggleRemoveVoucher(){
            var removeVoucher = document.getElementById('removeVoucher');
            if (removeVoucher.style.display === 'none') {
                removeVoucher.style.display = 'block';
            } else {
                removeVoucher.style.display = 'none';
            }
        }
        function toggleEditVoucher(){
            var editVoucher = document.getElementById('editVoucher');
            if (editVoucher.style.display === 'none') {
                editVoucher.style.display = 'block';
            } else {
                editVoucher.style.display = 'none';
            }
        }
    </script>
    <script>
        window.embeddedChatbotConfig = {
        chatbotId: "LaKRJr_-iPekl6Al0xMG6",
        domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="LaKRJr_-iPekl6Al0xMG6" domain="www.chatbase.co" defer></script>
</body>
</html>