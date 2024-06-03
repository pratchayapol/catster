<?php
// Include database connection file
include_once "condb.php";

// Check if order_id is set through GET request
if(isset($_GET['order_id'])) {
    // Get order_id from GET request
    $order_id = $_GET['order_id'];

    // Check if action is set through GET request
    if(isset($_GET['action'])) {
        // Get action from GET request
        $action = $_GET['action'];
        
        // Prepare SQL query to update order_status based on action
        if($action == 'confirm') {
            $update_query = "UPDATE orders SET order_status = 'confirm' WHERE order_id = '$order_id'";
        } elseif($action == 'refuse') {
            $update_query = "UPDATE orders SET order_status = 'refuse' WHERE order_id = '$order_id'";
        }

        // Execute query
        if(mysqli_query($conn, $update_query)) {
            // Redirect back to the page where the order details were viewed
            header("Location: orders.php");
            exit(); // Stop script execution
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Action not specified.";
    }
} else {
    // If order_id is not set, redirect back to orders.php
    header("Location: orders.php");
    exit(); // Stop script execution
}
?>
