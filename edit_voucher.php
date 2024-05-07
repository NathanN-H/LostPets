<?php
    session_start();
    include("php/connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    if (isset($_GET['id'])) {
        $voucher_id = $_GET['id'];
    
        // Fetch item details from the database based on the provided ID
        $sql = "SELECT * FROM shop_vouchers WHERE id = $voucher_id";
        $result = $con->query($sql);
    
        if ($result->num_rows > 0) {
            // Item found, fetch details
            $row = $result->fetch_assoc();
            $voucher_name = $row["voucher_name"];
            $voucher_description = $row["voucher_description"];
            $price = $row["price"];
        } else {
            // Item not found, redirect back to admin page
            header("Location: admin_page.php");
            exit();
        }
    } else {
        // ID parameter not provided, redirect back to admin page
        header("Location: admin_page.php");
        exit();
    }
    
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $new_voucher_name = $_POST['voucher_name'];
        $new_voucher_description = $_POST['voucher_description'];
        $new_price = $_POST['price'];
    
        // Update item details in the database
        $update_sql = "UPDATE shop_vouchers SET 
            voucher_name = '$new_voucher_name',
            voucher_description = '$new_voucher_description',
            price = $new_price
            WHERE id = $voucher_id";
    
        if ($con->query($update_sql) === TRUE) {
            // Item updated successfully, redirect back to admin page
            header("Location: admin_page.php");
            exit();
        } else {
            echo "Error updating voucher: " . $con->error;
        }
    }
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
        </style>
    </head>
    <body>
        <div class="container">
            <div class="box form-box">
                <h1>Edit Voucher</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $voucher_id; ?>" method="post">

                    <div class="field input">
                        <label for="voucher_name">Voucher Name:</label><br>
                        <input type="text" id="voucher_name" name="voucher_name" value="<?php echo $voucher_name; ?>"><br> 
                    </div>
                    
                    <div class="field input">
                        <label for="voucher_description">Voucher Description:</label><br>
                        <textarea id="voucher_description" name="voucher_description"><?php echo $voucher_description; ?></textarea><br>
                    </div>

                    <div class="field input">
                        <label for="price">Price:</label><br>
                        <input type="text" id="price" name="price" value="<?php echo $price; ?>"><br>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Update" required>
                    </div>
                </form>
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