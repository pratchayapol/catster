<?php
    session_start();
    include 'condb.php';

    if (!empty($_GET['product_id'])) {
        unset($_SESSION['cart'][$_GET['product_id']]);
        $_SESSION['msg'] = 'Cart Deleted';
    }

    header('Location: cart.php');
    exit;
?>
