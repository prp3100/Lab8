<?php
session_start();

if (!isset($_GET['index'])) {
    header("Location: product.php");
    exit;
}

$index = $_GET['index'];
if (!isset($_SESSION['products'][$index])) {
    header("Location: product.php");
    exit;
}

$product = $_SESSION['products'][$index];

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มและอัปเดตข้อมูลสินค้าใน Session
    $_SESSION['products'][$index]['name'] = trim($_POST['name']);
    $_SESSION['products'][$index]['image'] = trim($_POST['image']);
    $_SESSION['products'][$index]['description'] = trim($_POST['description']);
    $_SESSION['products'][$index]['price'] = floatval($_POST['price']);
    
    header("Location: product.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Product - แก้ไขสินค้า</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f2f5;
      margin: 0;
      padding: 20px;
    }
    .edit-container {
      max-width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    h2 {
      text-align: center;
      color: #343a40;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      color: #555;
    }
    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }
    textarea {
      resize: vertical;
      min-height: 80px;
    }
    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    input[type="submit"]:hover {
      background: #218838;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>
<body>
  <div class="edit-container">
    <h2>แก้ไขสินค้า</h2>
    <form action="" method="post">
      <label for="name">ชื่อสินค้า:</label>
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
      
      <label for="image">ที่อยู่รูปภาพ:</label>
      <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" required>
      
      <label for="description">รายละเอียดสินค้า:</label>
      <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
      
      <label for="price">ราคา (บาท):</label>
      <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>
      
      <input type="submit" value="บันทึกการเปลี่ยนแปลง">
    </form>
    <a href="product.php" class="back-link">ย้อนกลับไปที่รายการสินค้า</a>
  </div>
</body>
</html>
