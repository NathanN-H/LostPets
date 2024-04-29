<?php

session_start();
include("php/connection.php");

if (!isset($_SESSION['valid']) || $_SESSION['username'] !== "admin") {
    header("Location: login.php");
    exit();
}

if (isset($_POST['delete']) && isset($_POST['report_id'])) {
    $report_id = $_POST['report_id'];

    // Delete the record from the database
    $sql = "DELETE FROM found_pets WHERE id = $report_id";
    if (mysqli_query($con, $sql)) {
        // Redirect back to the admin page after deletion
        header("Location: admin_page.php");
        exit();
    } else {
        // Handle deletion error
        echo "Error deleting record: " . mysqli_error($con);
    }
} else {
    // Redirect to admin page if deletion parameters are missing
    header("Location: admin_page.php");
    exit();
}
?>