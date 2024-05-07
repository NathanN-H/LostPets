<?php
    session_start();
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
            body {
                font-family: 'Poppins', sans-serif; /* Update font family */
            }
        </style>
    </head>
    
    <body>
        <div class="container">
            <div class="box form-box">
            <h1>Login</h1>
                <form action="" method="post">

                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div>
                    <div class="links">
                        Dont's have account? <a href="register.php">Sign Up</a>
                    </div>
                </form>
            <?php 
             
             include("php\connection.php");
             if(isset($_POST['submit'])){
                $username = mysqli_real_escape_string($con, $_POST['username']);
                $password = mysqli_real_escape_string($con, $_POST['password']);
            
                $result = mysqli_query($con, "SELECT * FROM user WHERE Username='$username'") or die("Select Error");
                $row = mysqli_fetch_assoc($result);
            
                if($row) {
                    // Verify the password
                    if(password_verify($password, $row['Password'])) {
                        $_SESSION['valid'] = $row['Email'];
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['age'] = $row['Age'];
                        $_SESSION['id'] = $row['Id'];
                        header("Location: home.php");
                        exit;
                    } else {
                        echo "<div class='message'>
                                 <p>Wrong Username or Password</p>
                              </div> <br>";
                        echo "<a href='login.php'><button class='btn'>Go Back</button>";
                    }
                } else {
                    echo "<div class='message'>
                                 <p>Wrong Username or Password</p>
                              </div> <br>";
                    echo "<a href='login.php'><button class='btn'>Go Back</button>";
                }
            }
           ?>
            </div>
        </div>
        
    </body>
</html>