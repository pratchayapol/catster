<?php
    session_start();
    include 'condb.php';

    if (!empty($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        if (empty($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = 1;
        } else {
            $_SESSION['cart'][$product_id] += 1;
        }

        $_SESSION['msg'] = 'Cart add success';
    }

    header('Location: shop.php');
    exit;
?>
