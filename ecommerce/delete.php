<?php
session_start();

if (!isset($_GET['index'])) {
    exit('No index provided');
}

$index = $_GET['index'];

// ตรวจสอบว่า index ที่ส่งมามีอยู่ใน Session หรือไม่
if (isset($_SESSION['products'][$index])) {
    // ลบสินค้าชิ้นนั้นออกจาก Session
    array_splice($_SESSION['products'], $index, 1);
    echo "success";
} else {
    echo "error";
}
?>
