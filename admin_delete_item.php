<?php
    session_start();
    include("php/connection.php");

    if (isset($_POST['delete_item'])) {
        $item_id = $_POST['item_id'];

        // Perform validation here if needed

        // Delete the user from the database
        $sql = "DELETE FROM shop_items WHERE id = $item_id";

        if (mysqli_query($con, $sql)) {
            // User deleted successfully, redirect back to admin page or wherever appropriate
            header("Location: admin_page.php");
            exit();
        } else {
            // Handle deletion error
            echo "Error deleting user: " . mysqli_error($con);
        }
    }
?>
