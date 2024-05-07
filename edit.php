<?php
    session_start();

    include("php\connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lost Pets - Change Profile</title>
        <link rel="stylesheet" type="text/css" href="css\style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
        <link rel="shortcut icon" type="image/x-icon" href="Design-Images\cat_shortcuticon.png">
        <style>
            body {
                font-family: 'Poppins', sans-serif; /* Update font family */
            }
        </style>
    </head>
    <body>
        <header>
            <a href="home.php"><img class="logo"src="Design-Images\cat_logo.png" alt="Cat Icon"></a>
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
                        <a href="account.php">Account</a>
                        <a href="php\logout.php"> <buttom class="btn">Log Out</buttom></a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="container">
            <div class="box form-box">
                <?php
                    if(isset($_POST['submit']))
                    {
                        /*
                        $file_name = $_FILES['image']['name'];
                        $tempname = $_FILES['image']['tmp_name'];
                        $folder = 'ProfileImages/'.$file_name;
                        */
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $age = $_POST['age'];
                        $petdescription = $_POST['petdescription'];
                        $address = $_POST['address'];

                        $id = $_SESSION['id'];

                        $edit_query = mysqli_query($con, "UPDATE user SET Username = '$username', Email='$email', Age='$age', petdescription='$petdescription', address='$address' WHERE Id=$id");

                        if($edit_query){
                            echo "<div class='message'>
                                        <p>Update Successful!</p>
                                  </div> <br>";
                             echo "<a href='home.php'><button class='btn'>Go Home</buttton>";
                        }
                    }
                    else{

                        $id = $_SESSION['id'];
                        $query = mysqli_query($con, "SELECT * FROM user WHERE Id = $id");
                        
                        while($result = mysqli_fetch_assoc($query)){
                            $res_Uname = $result['Username'];
                            $res_Email = $result['Email'];
                            $res_Age = $result['Age'];
                            $res_petdescription = $result['petdescription'];
                            $res_address = $result['address'];
                            /*$res_Image = $result['Image'];*/
                            
                        }
                        
                ?>
                <h1>Change or Edit Profile</h1>
                <form action="" method="post">

                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" >
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" >
                    </div>

                    <div class="field input">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" >
                    </div>
                    
                    <div class="field input">
                        <label for="petdescription">Pet Description</label>
                        <input type="text" name="petdescription" id="petdescription" value="<?php echo $res_petdescription; ?>" autocomplete="off" >
                    </div>
                    
                    <div class="field input">
                        <label for="address">Current Address</label>
                        <input type="text" name="address" placeholder="Enter Current Address">
                    </div>
                    <!--
                    <div class="field input">
                            <label for="image">Upload Image</label>
                            <p>File had to be 50KB or under</p>
                            <input type="file" name="image" id="image" value="Uploaded Image" autocomplete="off" >
                    </div>
                    -->

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Update" required>
                    </div>
                   
                </form>
            </div>
            <?php } ?>
        </div>
        <footer>
            
        </footer>
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