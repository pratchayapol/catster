<?php
    session_start();
    include 'condb.php';

    if (isset($_POST['product'])) {
        foreach ($_POST['product'] as $product_id => $product) {
            $_SESSION['cart'][$product_id] = $product['quantity'];
        }
    }
    
    $_SESSION['msg'] = 'Cart update success';
    header('Location: cart.php');
    exit;
?>
