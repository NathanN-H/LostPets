<?php
    session_start();
    include("php/connection.php");

    if (isset($_POST['delete_voucher'])) {
        $voucher_id = $_POST['voucher_id'];

        // Perform validation here if needed

        // Delete the user from the database
        $sql = "DELETE FROM shop_vouchers WHERE id = $voucher_id";

        if (mysqli_query($con, $sql)) {
            // User deleted successfully, redirect back to admin page or wherever appropriate
            header("Location: admin_page.php");
            exit();
        } else {
            // Handle deletion error
            echo "Error deleting voucher: " . mysqli_error($con);
        }
    }
?>
