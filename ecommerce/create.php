<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์มและจัดเก็บไว้ในตัวแปร
    $newProduct = [
        "name"        => trim($_POST['name']),
        "price"       => trim($_POST['price']),
        "description" => trim($_POST['description']),
        "image"       => trim($_POST['image'])
    ];
    
    // ตรวจสอบและเพิ่มสินค้าใหม่เข้าไปใน session
    $_SESSION['products'][] = $newProduct;
    
    // เปลี่ยนเส้นทางกลับไปที่ index.php
    header("Location: product.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 20px;
    }
    .create-container {
      max-width: 500px;
      margin: 50px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 10px;
      color: #555;
    }
    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      padding: 10px 15px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    textarea {
      resize: vertical;
      height: 100px;
    }
    input[type="submit"] {
      width: 100%;
      background-color: #4CAF50;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 15px;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
    a {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #337ab7;
    }
  </style>
</head>
<body>
  <div class="create-container">
    <h2>Create New Product</h2>
    <form method="post" action="">
      <label for="name">ชื่อสินค้า:</label>
      <input type="text" id="name" name="name" required>

      <label for="price">ราคา (บาท):</label>
      <input type="number" id="price" name="price" required>

      <label for="description">รายละเอียด:</label>
      <textarea id="description" name="description" required></textarea>

      <label for="image">ที่อยู่รูปภาพ:</label>
      <input type="text" id="image" name="image" placeholder="images/your-image.jpg" required>

      <input type="submit" value="Create Product">
    </form>
    <a href="product.php">กลับสู่หน้ารายการสินค้า</a>
  </div>
</body>
</html>
