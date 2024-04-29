<?php
session_start();
include("php/connection.php");
if(isset($_SESSION['valid'])){
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lost Pets - Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
    <link rel="shortcut icon" type="image/x-icon" href="Design-Images/cat_shortcuticon.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Update font family */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <?php 
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                // Check if passwords match
                if($password !== $confirm_password) {
                    echo "<div class='message'>
                            <p>Passwords do not match. Please try again!</p>
                          </div> <br>";
                    echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back Please</button>";
                } else {
                    $verify_query = mysqli_query($con, "SELECT Email FROM user WHERE Email='$email'");
                    if(mysqli_num_rows($verify_query) != 0){
                        echo "<div class='message'>
                                <p>This email is used. Try another one, please!</p>
                              </div> <br>";
                        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back Please</button>";
                    } else {
                        // Hash the password before storing
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_query($con, "INSERT INTO user(Username,Email,Age,Password) VALUES('$username','$email','$age','$hashed_password')");
                        echo "<div class='message'>
                                <p>Registration Successful!</p>
                              </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Login Please</button>";
                    }
                }
            } else {
            ?>
            <h1>Register</h1>
            <form id="registrationForm" action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                    <span id="emailFormatError" style="color:red;"></span>
                </div>
                <div class="field input">
                    <label for="age">Age</label>
                    <input type="text" name="age" id="age" autocomplete="off" required>
                </div>


                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Already have an account? <a href="login.php">Sign In</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>
    <script>
        function validateEmail(){
            var email = document.getElementById("email").value;
            var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var error_message = document.getElementById("emailFormatError");

            if(!emailFormat.test(email)){
                error_message.textContent = "Please enter a valid email address.";
                document.getElementById("registrationForm").submit.disabled = true;
            } else {
                error_message.textContent = "";
                document.getElementById("registrationForm").submit.disabled = false;
            }
        }

        document.getElementById("email").addEventListener("keyup", validateEmail);
    </script>
</body>
</html>
