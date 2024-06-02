<?php
session_start();
include 'condb.php';

// Retrieve POST data and initialize variables
$order_tel = isset($_POST['order_tel']) ? $_POST['order_tel'] : '';
$order_address = isset($_POST['order_address']) ? $_POST['order_address'] : '';
$order_note = isset($_POST['order_note']) ? $_POST['order_note'] : '';

if (!isset($_POST['order_total'], $_POST['mem_username'], $_POST['product'])) {
    die('Error: Missing required POST data.');
}

// Generate a unique order ID
function generateOrderId($conn, $length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $orderId = 'OR';
    for ($i = 0; $i < $length; $i++) {
        $orderId .= $characters[rand(0, $charactersLength - 1)];
    }
    $check_query = mysqli_query($conn, "SELECT * FROM orders WHERE order_id = '{$orderId}'");
    if (mysqli_num_rows($check_query) > 0) {
        return generateOrderId($conn, $length); // Regenerate if order ID already exists
    }
    return $orderId;
}

$order_id = generateOrderId($conn);
$order_date = date('Y-m-d H:i:s');
$order_status = 'pending';

// Prepare and execute the order insertion
$query = mysqli_prepare($conn, "INSERT INTO orders (order_id, order_date, order_tel, order_address, order_status, order_total, order_note, mem_username) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($query, 'ssssdsss', $order_id, $order_date, $order_tel, $order_address, $order_status, $_POST['order_total'], $order_note, $_POST['mem_username']);

if (mysqli_stmt_execute($query)) {
    $last_id = mysqli_insert_id($conn);
    foreach ($_POST['product'] as $product) {
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_price = $product['product_price'];
        $quantity = $product['quantity'];
        $sub_total = $product_price * $quantity;

        $detail_query = mysqli_prepare($conn, "INSERT INTO order_details (order_id, product_id, product_name, product_price, quantity, sub_total) 
        VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($detail_query, 'ssssss', $order_id, $product_id, $product_name, $product_price, $quantity, $sub_total);
        mysqli_stmt_execute($detail_query);
    }

    // Clear the cart session and set order_id
    unset($_SESSION['cart']);
    $_SESSION['order_id'] = $order_id;

    // If you have any shipping information, set it here. Otherwise, remove this line.
    $_SESSION['shipping_info'] = ''; // Define as needed

    // Redirect to payment page
    header("location: payment.php");
    exit();
} else {
    // Redirect to cart page in case of error
    header('location: cart.php');
    exit();
}

mysqli_close($conn);
?>
