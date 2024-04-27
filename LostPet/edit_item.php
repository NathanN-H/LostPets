<?php
    session_start();
    include("php/connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];
    
        // Fetch item details from the database based on the provided ID
        $sql = "SELECT * FROM shop_items WHERE id = $item_id";
        $result = $con->query($sql);
    
        if ($result->num_rows > 0) {
            // Item found, fetch details
            $row = $result->fetch_assoc();
            $item_name = $row["item_name"];
            $item_description = $row["item_description"];
            $price = $row["price"];
            $stock_quantity = $row["stock_quantity"];
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
        $new_item_name = $_POST['item_name'];
        $new_item_description = $_POST['item_description'];
        $new_price = $_POST['price'];
        $new_stock_quantity = $_POST['stock_quantity'];
    
        // Update item details in the database
        $update_sql = "UPDATE shop_items SET 
            item_name = '$new_item_name',
            item_description = '$new_item_description',
            price = $new_price,
            stock_quantity = $new_stock_quantity
            WHERE id = $item_id";
    
        if ($con->query($update_sql) === TRUE) {
            // Item updated successfully, redirect back to admin page
            header("Location: admin_page.php");
            exit();
        } else {
            echo "Error updating item: " . $con->error;
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
                <h1>Edit Item</h1>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $item_id; ?>" method="post">

                    <div class="field input">
                        <label for="item_name">Item Name:</label><br>
                        <input type="text" id="item_name" name="item_name" value="<?php echo $item_name; ?>"><br> 
                    </div>
                    
                    <div class="field input">
                        <label for="item_description">Item Description:</label><br>
                        <textarea id="item_description" name="item_description"><?php echo $item_description; ?></textarea><br>
                    </div>

                    <div class="field input">
                        <label for="price">Price:</label><br>
                        <input type="text" id="price" name="price" value="<?php echo $price; ?>"><br>
                    </div>

                    <div class="field input">
                        <label for="stock_quantity">Stock Quantity:</label><br>
                        <input type="text" id="stock_quantity" name="stock_quantity" value="<?php echo $stock_quantity; ?>"><br>
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