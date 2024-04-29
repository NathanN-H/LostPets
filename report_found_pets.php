<?php
    session_start();

    include("php/connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Found Pets</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
    <link rel="shortcut icon" type="image/x-icon" href="Design-Images/cat_shortcuticon.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Update font family */
        }
        .container{
            padding-top: 10%;
            padding-bottom: 10%;
        }
    </style>
</head>
<body onload = "getLocation();">
    <header>
        <a href="home.php"><img class="logo" src="Design-Images/cat_logo.png" alt="Cat Icon"></a>
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
                        <a href="#" class="active">Report Found Pets</a>
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
                <a href="javascript:void(0);" class="icon">&#9776;</a>
                <div class="right-links" style="float: right">
                    <a href="account.php">Account</a>
                    <a href="php/logout.php"><button class="btn">Log Out</button></a>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="box form-box">
            <?php
                if(isset($_POST['submit'])){
                    $file_name = $_FILES['image']['name'];
                    $tempname = $_FILES['image']['tmp_name'];
                    $folder = 'FoundImages/'. $file_name;
                    $foundpetnametag = $_POST['foundpetnametag'];
                    $foundpetdesc = $_POST['foundpetdesc'];
                    $address = $_POST['address'];

                    $user_id = $_SESSION['id'];

                    // Use prepared statement to prevent SQL injection
                    $sql = "INSERT INTO found_pets (user_id, image, found_pet_nametag, found_pet_description, address, approved) VALUES ('$user_id', '$file_name', '$foundpetnametag', '$foundpetdesc', '$address', 0)";
                    mysqli_query($con, $sql);

                    if(move_uploaded_file($tempname, $folder)){
                        echo "<h2>File uploaded successfully</h2>";
                    } else {
                        echo "<h2>File not uploaded</h2>";
                    }
                }
                else {
            ?>
            <h1>Found Pet Report</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                    <div class="field input">
                        <label for="foundpetnametag">Pets Name</label>
                        <input type="text" name="foundpetnametag" id="foundpetnametag" value="" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="foundpetdesc">Detailed Description</label>
                        <textarea name="foundpetdesc" id="foundpetdesc" autocomplete="off" required rows="20" cols="100">Enter Text Here....</textarea>
                    </div>

                    <div class="field input">
                        <label for="image">Upload Image</label>
                        <p>File had to be 50KB or under</p>
                        <input type="file" name="image" id="image" value="Upload Image" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="address">Pets Sighted Location</label>
                        <input type="text" name="address" placeholder="Enter Address" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Submit">
                    </div>
            </form>
        </div>
        <?php } ?>
    </div>
    <script>
        window.embeddedChatbotConfig = {
        chatbotId: "LaKRJr_-iPekl6Al0xMG6",
        domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="LaKRJr_-iPekl6Al0xMG6" domain="www.chatbase.co" defer></script>
</body>
</html>
