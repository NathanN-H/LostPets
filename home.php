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
        <title>Lost Pets</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
        <link rel="shortcut icon" type="image/x-icon" href="Design-Images/cat_shortcuticon.png">
        <style>
            .box {
                text-align: center;
                font-family: 'Poppins', sans-serif; /* Align text in the box centered */
            }
            body {
                font-family: 'Poppins', sans-serif; /* Update font family */
            }
        </style>
    </head>
    <body>
        <header>
            <img class="logo"src="Design-Images/cat_logo.png" alt="Cat Icon">
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
                        <?php

                            $id = $_SESSION['id'];
                            $query = mysqli_query($con, "SELECT * FROM user WHERE Id=$id");

                            while($result = mysqli_fetch_assoc($query)){
                                $res_Uname = $result['Username'];
                                $res_Email = $result['Email'];
                                $res_Age = $result['Age'];
                                $res_petdescription = $result['petdescription'];
                                $res_id = $result['Id'];
                            }
                        ?>
                        <a href="php/logout.php"> <buttom class="btn" style="">Log Out</buttom></a>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <div class="main-box top">
                <div class="top">
                    <div class="box">
                        <p>Hello <b><?php echo $res_Uname ?></b>, Welcome to Lost Pets</p>
                    </div>
                    <div class="box">
                        <p>Your email is <b><?php echo $res_Email ?></b></p>
                    </div>
                    
                </div>
                <div class="bottom">
                    <div class="box">
                        <p>And you are <b><?php echo $res_Age ?> Years Old</b>. Your pet description: <b><?php echo $res_petdescription?></b></p> 
                    </div>
                </div>
            </div>
            
        </main>
        <div class="Location Map">       
            <iframe width="70%" height="700px" style="display: block; margin-left:auto; margin-right:auto; padding-top:20px; border: none;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2723.1381704254118!2d-1.6106426464858496!3d54.97525394423852!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487e70e112c5e9f7%3A0x79a7c60c923dce07!2sNorthumbria%20University!5e0!3m2!1sen!2suk!4v1709805280991!5m2!1sen!2suk" ></iframe>
        </div>
        <style>
            .column{
                float: left;
                width: 33.33%;
            }
            .topcol {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
            .topcol img{
                border-radius:50%;
                margin-left: auto;
                margin-right: auto;
            }
            .column img{
                border-radius:50%;
                margin-left: auto;
                margin-right: auto;
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
            
            @media only screen and (max-width: 840px) {
                .row {
                    display: flex;
                    flex-direction: column; /* Stack columns vertically */
                }

                .column {
                    width: 100%; /* Occupy full width */
                    text-align: center;
                }

                .column p {
                    padding: 10px;
                    font-size: 18px; /* Adjust font size for smaller screens */
                }

                .column img {
                    width: 80%; /* Adjust image size for smaller screens */
                }
            }
            .columnhdtw {
                float: left;
                width: 33.33%;
            }
            .columnhdtw img {
                border-radius:50%;
                width: 50%;
                margin-left: auto;
                margin-right: auto;
            }
            .hdtwtitle{
                text-align: center;
                background: #d0d5db;
            }
            .hdtwtitle p {
                font-size: 20px;
                color: black;
            }
            .hdtwtitle .title {
                font-size: 30px;
            }

            .hdwhtitle{
                text-align: center;
                background: #d0d5db;
            }
            .hdwhtitle p{
                font-size: 20px;
                color: black;
            }
            .hdwhtitle .title{
                font-size: 30px;
            }
        </style>

        <div class="row">
            <div class="topcol">
                <a href="help_advice.html"><img src="Design-Images\help.jpg" alt="Help-Advice" width="50%"></a>
                <p style="font-size: 30px;">Help & Advice</p>
            </div>
            <div class="column">
                <a href="missing_pets.php"><img src="Design-Images\missing.jpg" alt="Missing-Pet-Image-Link" width="50%"></a>
                <p style="font-size: 30px;">Missing Pets</p>
            </div>
            <div class="column">            
                <a href="contact.html"><img src="Design-Images\contact.jfif" alt="Contact-Pet-Image-Link" width="50%" ></a>
                <p style="font-size: 30px;">Contact Us</p>
            </div>
            <div class="column">            
                <a href="found_pets.php"><img src="Design-Images\found.jfif" alt="Found-Pet-Image-Link" width="50%" ></a>
                <p style="font-size: 30px;">Found Pets</p>
            </div>
        </div>
        <div class="hdtwtitle">
            <p class="title">━━━ How does this work?  ━━━</p>
            <div>
                <p>
                    If you unfortunately lost a pet or a pet had went missing through this website theres a quicker way of finding them by joining the community as a whole.
                    This will allow you to not only find hope within the community through possible sightings of your lost or missing pet but also provide you with the same 
                    opportunity to help those who has also lost or has a pet that is missing or remains missing.
                </p>
                <p>
                    Here's how it works:
                </p>
                <div class="row">
                    <div class="columnhdtw">
                        <img src="Design-Images\jointhecomm.jpg" alt="Join-The-Community" >
                        <p>
                            <strong>1. Join the Community:</strong> Sign up and become a part of our community dedicated to reuniting lost pets with their owners. By joining, you gain access to valuable resources and support from fellow pet owners.
                        </p>
                    </div>
                    <div class="columnhdtw">
                        <img src="Design-Images\duty-to-report.jpg" alt="Report-Missing-Pet" >
                        <p>
                            <strong>2. Report Missing Pets:</strong> If your pet is missing, report it on our platform. Provide detailed information about your pet, including photos, descriptions, and last known location.
                        </p>
                    </div>
                    <div class="columnhdtw">
                        <img src="Design-Images\viewmissingpet.jfif" alt="View-Missin-Pet">
                        <p>
                            <strong>3. View Missing Pets:</strong> Browse through listings of missing pets to see if any match the description of your lost companion. You can filter results based on various criteria to narrow down your search.
                        </p>
                    </div>
                    </div>
                    <div class="row">
                        <div class="columnhdtw">
                            <img src="Design-Images\foundpet.jpg" alt="Report-Found-Pet">
                            <p>
                                <strong>4. Report Found Pets:</strong> If you've found a lost pet, you can report it on our website. This helps connect found pets with their worried owners and facilitates happy reunions.
                            </p>
                        </div>
                        <div class="columnhdtw">
                            <img src="Design-Images\advicenhelp.png" alt="Help-And-Advice" >
                            <p>   
                                <strong>5. Offer Help & Advice:</strong> Share your experiences and offer support to others in the community. Your insights may help someone else find their missing pet or cope with the stress of losing one.
                            </p>
                        </div>
                        <div class="columnhdtw">
                                <img src="Design-Images\informed.jfif" alt="Informed" >
                            <p>
                                <strong>6. Stay Informed:</strong> Keep yourself updated with the latest news and tips on pet care, safety, and prevention strategies to reduce the likelihood of losing your pet in the future.
                            </p>
                        </div>
                    </div>
                    <p>
                        Losing a pet can be distressing, but with the help of our community and resources, you increase the chances of bringing them back home safely. Together, we can make a difference and reunite lost pets with their loving families.
                    </p>
            </div>
        </div>
        <div class="hdwhtitle">
            <p class="title">━━━ How do we help?  ━━━</p>
            <div>
                    <p>
                        
                        If you unfortunately lost a pet or a pet had went missing through this website theres a quicker way of finding them by joining the community as a whole.
                        This will allow you to not only find hope within the community through possible sightings of your lost or missing pet but also provide you with the same 
                        opportunity to help those who has also lost or has a pet that is missing or remains missing.
                        
                    </p>
            </div>
            <div class="row">
                <div class="columnhdtw">
                        <h3><strong>Protect your email</strong></h3>
                    <p>    
                        We provide protection and security for your email when you create an account. Unfortunately, there are many people in the world that would take advantage of
                        your email. This can be from spamming, scamming, or a constant unwanted emails. This is prevented as we secure your email is a safe database preventing any
                        of your information from being released.
                    </p>
                </div>
                <div class="columnhdtw">
                        <h3><strong>Providing information</strong></h3>
                    <p>
                        We provide as much useful information and guides on how to protect your pets and keeping them safe and away from harms way. This allows your to gain more useful
                        knowledge on how to help your pets. This will not only benefit your pet but will also benefit yourself as protecting your pet and securing your pet will reassure
                        yourself of the safety your pet will have.
                    </p>
                </div>
                <div class="columnhdtw">
                        <h3><strong>Database of missing pets</strong></h3>
                    <p>
                        You can look through the wide range of different lost pets in the world at anytime you wish. Through this system it will allow you to gain access to useful information
                        on the location of a missing pet potentially in your local area. And if you successfully find a missing pet there is a reward for each successful pet recovered.
                    </p>
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