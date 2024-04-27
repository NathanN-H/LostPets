<?php
    session_start();

    include("connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    if(isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];
        $stmt = $con->prepare("DELETE FROM user WHERE Id = ?");
        $stmt->bind_param("i", $delete_id);

        if ($stmt->execute()) {
            // Account deleted successfully
            header("Location: logout.php"); // Redirect to logout page or any other appropriate action
            exit();
        } else {
            // Error occurred while deleting account
            echo "Error: " . $con->error;
        }

        $stmt->close();
    }
?>
