<?php
session_start();


if (isset($_GET['index'])) {
    $index = $_GET['index'];
    
    if (isset($_SESSION['products'][$index])) {
        $productToAdd = $_SESSION['products'][$index];

        // ถ้า session cart ยังไม่ถูกสร้าง ให้สร้างเป็นอาร์เรย์ใหม่
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        
        $alreadyInCart = false;
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['name'] === $productToAdd['name']) {
                $alreadyInCart = true;
                break;
            }
        }
        
        // ถ้ายังไม่มีในตะกร้า ให้เพิ่มสินค้าเข้าไปพร้อมกำหนดค่าเริ่มต้น quantity เป็น 1
        if (!$alreadyInCart) {
            $productToAdd['quantity'] = 1;
            $_SESSION['cart'][] = $productToAdd;
        }
    }
}

// เปลี่ยนเส้นทางกลับไปที่ home.php หลังจากเพิ่มสินค้า
header("Location: home.php");
exit;
?>
