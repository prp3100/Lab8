<?php
session_start();

if (isset($_GET['index']) && isset($_GET['action'])) {
    $index = $_GET['index'];
    $action = $_GET['action'];
    
    if (isset($_SESSION['cart'][$index])) {
        if ($action === 'inc') {
            $_SESSION['cart'][$index]['quantity']++;
        } elseif ($action === 'dec') {
            // ลดจำนวนสินค้า ถ้าจำนวนมากกว่า 1 เท่านั้น
            if ($_SESSION['cart'][$index]['quantity'] > 1) {
                $_SESSION['cart'][$index]['quantity']--;
            }
        }
    }
}

header("Location: cart.php");
exit;
?>
