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
            font-family: 'Poppins', sans-serif;
        }
        tbody td {
            background-color: rgba(255,255,255,0);
            transition: all 0.2s linear; 
            transition-delay: 0.3s, 0s;
            opacity: 0.6;
        }
        tbody tr:hover td {
            background-color: rgba(255,255,255,1);
            transition-delay: 0s, 0s;
            opacity: 1;
            font-size: 2em;
        }
        thead{
            z-index: 1;
        }
        td {
            transform-origin: center left;
            transition-property: transform;
            transition-duration: 10s;
            transition-timing-function: ease-in-out;
        }
        tr:hover td {
            transform: scale(1.1);
        }
        * { box-sizing: border-box }
        table {
            width: 1700px;
            text-align: left;
        }
        th, td {
            padding: 50px;
        }
        body > *  {
            margin: auto;
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
                        <a href="#" class="active">View Found Pets</a>
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
                    <a href="php\logout.php"><button class="btn">Log Out</button></a>
                </div>
            </div>
        </nav>
    </header>
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Found Pet Image</th>
                <th>Found Pet Name</th>
                <th>Found Pet Description</th>
                <th>Sighted Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT found_pets.*, user.Username FROM found_pets JOIN user ON found_pets.user_id = user.Id WHERE found_pets.approved = 1";
                $result = mysqli_query($con, $query);

                while($data = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $data['Username'] ?></td>
                <td><img src="FoundImages/<?php echo $data['image']; ?>"></td>
                <td><p><?php echo $data['found_pet_nametag']?></p></td>
                <td><p><?php echo $data['found_pet_description']?></p></td>
                <td><iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php echo $data['address'];?>&output=embed"></iframe></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <script>
        window.embeddedChatbotConfig = {
        chatbotId: "LaKRJr_-iPekl6Al0xMG6",
        domain: "www.chatbase.co"
        }
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="LaKRJr_-iPekl6Al0xMG6" domain="www.chatbase.co" defer></script>
</body>
</html>
