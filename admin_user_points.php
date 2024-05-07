<?php
    session_start();

    include("php\connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the 'user_points_id' and 'points_user' are set in the POST request
        if (isset($_POST['user_points_id']) && isset($_POST['points_user'])) {
            // Get the user ID and sanitize it
            $user_id = mysqli_real_escape_string($con, $_POST['user_points_id']);
            
            // Query to update user's points by adding 50
            $update_query = "UPDATE user SET points = points + 50 WHERE Id = '$user_id'";
            
            // Execute the update query
            if (mysqli_query($con, $update_query)) {
                // Redirect back to the admin page after updating points
                header("Location: admin_page.php");
                exit(); // Stop further execution
            } else {
                echo "Error updating points: " . mysqli_error($con);
            }
        }
    }
?>
