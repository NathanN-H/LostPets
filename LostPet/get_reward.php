<?php
    session_start();

    include("php/connection.php");

    if (!isset($_SESSION['valid'])) {
        header("Location: login.php");
        exit;
    }

    $userId = $_SESSION['id'];
    $rewardId = $_POST['reward_id'];
    $rewardPrice = $_POST['reward_price'];

    $query = "SELECT points FROM user WHERE Id = $userId";
    $result = mysqli_query($con, $query);
    $userData = mysqli_fetch_assoc($result);
    $userPoints = $userData['points'];

    if ($userPoints >= $rewardPrice) {
        $newPoints = $userPoints - $rewardPrice;
        $query = "UPDATE user SET points = $newPoints WHERE Id = $userId";
        mysqli_query($con, $query);

        // Get the item details from the shop_items table
        $query = "SELECT * FROM shop_items WHERE id = $rewardId";
        $result = mysqli_query($con, $query);
        $itemData = mysqli_fetch_assoc($result);

        // Insert a new record into the user_items table
        $query = "INSERT INTO user_items (user_id, item_id)
                VALUES ($userId, $rewardId)";
        mysqli_query($con, $query);

        echo "Reward claimed successfully!";
    } else {
        echo "Not enough points to claim this reward.";
    }
?>