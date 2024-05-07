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
        <title>Lost Pets</title>
        <link rel="stylesheet" type="text/css" href="css\style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
        <link rel="shortcut icon" type="image/x-icon" href="Design-Images\cat_shortcuticon.png">
        <style>
            .column{
                float: left;
                width: 33.33%;
                padding-bottom: 5%;
            }
            
            .column p{
                padding: 30px;
                font-size: 20px;
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
            .hna {
                margin: 20px auto;
                max-width: 600px;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                align-items: center;
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
                            <a href="#" class="active">Help & Advice</a>
                            <a href="contact.html">Contact Us</a>
                            <a href="admin_page.php">Admin</a>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
                    <div class="right-links" style="float: right">
                        <a href="account.php">Account</a>
                        <a href="php\logout.php"> <button class="btn">Log Out</button></a>
                    </div>
                </div>
            </nav>
        </header>
        <div class="row">
            <div class="column">
                <div class="hna">
                <h1>Questions and Answers</h1>
                <p>
                    In this section you are able to ask any questions based around your pet/pets. This is a way for not only the website but the community to provide support and answers
                    for the questions you may want answers for which Lost Pets might not provide.
                </p>
                <a href="qna.php" class="btn">Questions and Answers</a>
                </div>
            </div>
            <div class="column">
                <div class="hna">
                    <h1>Keep cat pets safe!</h1>
                    <p>
                        This section will demonstrate several different ways someone can keep their cat pets safe and protected. With this information you will be more then prepared to
                        be able to carefully and successfully look after your cats at home.
                    </p>
                    <a href="catshelpad.html" class="btn">Cats Safety</a>
                </div>
            </div>
            <div class="column">
                <div class="hna">
                    <h1>Keep dog pets safe!</h1>
                    <p>
                        Keeping your dog pets safe and protected is one of the most important things to do as a dog pet owner. This guide will not just give you knowledge but it will provide
                        a more indepth understanding of what your dog pet/pets might require to be safe.
                    </p>
                    <a href="dogshelpad.html"class="btn">Dogs Safety</a>
                </div>
            </div>
            <div class="column">
                <div class="hna">
                    <h1>Reward information</h1>
                    <p>
                        At Lost Pets, we understand the deep emotional bond between pets and their owners. That's why we're excited to announce our innovative reward system designed 
                        to incentivize and encourage community involvement in reuniting lost pets with their families.
                    </p>
                    <a href="rewardhna.html"class="btn">Dogs Safety</a>
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
