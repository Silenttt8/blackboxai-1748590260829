<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET['id'])) {
    $produk_id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$produk_id])) {
        $_SESSION['cart'][$produk_id]++;
    } else {
        $_SESSION['cart'][$produk_id] = 1;
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
