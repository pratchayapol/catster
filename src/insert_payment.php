<?php
include 'condb.php';
session_start();

// Check if order_id is set and not empty
if (!isset($_POST['order_id']) || empty($_POST['order_id'])) {
    die('Error: order_id is missing or empty.');
}

$order_id = $_POST['order_id'];
$pay_slip = '';

// Check if a file was uploaded
if (isset($_FILES['slip_payment']) && $_FILES['slip_payment']['error'] === UPLOAD_ERR_OK) {
    $pay_slip = basename($_FILES['slip_payment']['name']);
    $target_dir = "images/";
    $target_file = $target_dir . $pay_slip;

    // Check if target directory is writable
    if (!is_writable($target_dir)) {
        die('Error: Target directory is not writable.');
    }

    // Move the uploaded file to the target directory
    if (!move_uploaded_file($_FILES['slip_payment']['tmp_name'], $target_file)) {
        die('Error: Failed to move uploaded file.');
    }
} else {
    // Handle file upload error
    die('Error: No file uploaded or file upload error.');
}

// Function to generate unique pay_id
function generatePayId($conn, $length = 11) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    do {
        $payId = '';
        for ($i = 0; $i < $length; $i++) {
            $payId .= $characters[rand(0, $charactersLength - 1)];
        }
        $check_query = mysqli_query($conn, "SELECT * FROM payment WHERE pay_id = '{$payId}'");
    } while (mysqli_num_rows($check_query) > 0);
    return $payId;
}

$pay_id = "P" . generatePayId($conn);

// Insert payment data into the database
$sql = "INSERT INTO payment (pay_id, order_id, pay_slip) VALUES ('{$pay_id}', '{$order_id}', '{$pay_slip}')";

if (mysqli_query($conn, $sql)) {
    // Update order status to 'wait'
    $update_order_status_sql = "UPDATE orders SET order_status = 'wait' WHERE order_id = '{$order_id}'";
    if (mysqli_query($conn, $update_order_status_sql)) {
        // Fetch order total
        $order_query = "SELECT order_total FROM orders WHERE order_id = '{$order_id}'";
        $order_result = mysqli_query($conn, $order_query);
        $order_data = mysqli_fetch_assoc($order_result);

        if ($order_data) {
            $total = $order_data['order_total'];
            $profit = $total * 0.15;

            // Update shelter donation
            $update_shelter_donation_sql = "UPDATE shelter SET shelter_donation = shelter_donation + {$profit}";
            if (mysqli_query($conn, $update_shelter_donation_sql)) {
                // Store order_id in session
                $_SESSION['order_id'] = $order_id;

                // Redirect to checkout success page
                echo "<script>window.location='checkout_success.php';</script>";
            } else {
                echo "<script>alert('Error updating donation: " . mysqli_error($conn) . "');</script>";
            }
        } else {
            echo "<script>alert('Order data not found');</script>";
        }
    } else {
        echo "<script>alert('Error updating order status: " . mysqli_error($conn) . "');</script>";
    }
} else {
    echo "<script>alert('Error saving payment data: " . mysqli_error($conn) . "');</script>";
}

// Close the database connection
mysqli_close($conn);
?>
