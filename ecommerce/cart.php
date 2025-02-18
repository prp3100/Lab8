<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$cartCount = count($cart);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cart - รายการสินค้าในตะกร้า🧺</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f2f5;
      margin: 0;
      padding: 0;
    }
    header {
      background: #343a40;
      color: #fff;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header h1 {
      margin: 0;
      font-size: 24px;
    }
    .hamburger-menu {
      position: relative;
    }
    .hamburger-button {
      background: none;
      border: none;
      color: #fff;
      font-size: 24px;
      cursor: pointer;
    }
    .menu-content {
      display: none;
      position: absolute;
      top: 35px;
      left: 0;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 4px;
      overflow: hidden;
      min-width: 160px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      z-index: 100;
    }
    .menu-content a {
      display: block;
      padding: 10px 15px;
      text-decoration: none;
      color: #333;
      transition: background 0.3s;
    }
    .menu-content a:hover {
      background: #f8f9fa;
    }
    .container {
      max-width: 1000px;
      margin: 20px auto;
      padding: 0 20px;
    }
    h2 {
      text-align: center;
      margin: 20px 0;
      color: #343a40;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #f0f0f0;
    }
    th {
      background: #007bff;
      color: #fff;
    }
    tr:last-child td {
      border-bottom: none;
    }
    /* ปรับการแสดงผลของรูปภาพให้เหมือนในหน้า home.php */
    td img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 4px;
    }
    /* Styles สำหรับปุ่มเพิ่ม/ลดและปุ่ม Delete */
    .update-btn, .delete-btn {
      display: inline-block;
      padding: 6px 10px;
      border-radius: 4px;
      text-decoration: none;
      font-size: 14px;
      transition: background 0.3s;
      margin: 0 4px;
    }
    .update-btn {
      background: #17a2b8;
      color: #fff;
    }
    .update-btn:hover {
      background: #138496;
    }
    .delete-btn {
      background: #dc3545;
      color: #fff;
    }
    .delete-btn:hover {
      background: #c82333;
    }
    .checkout-btn {
      display: inline-block;
      padding: 12px 20px;
      background: #28a745;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      float: right;
      margin-top: 20px;
      transition: background 0.3s;
    }
    .checkout-btn:hover {
      background: #218838;
    }
    .clearfix::after {
      content: "";
      display: table;
      clear: both;
    }
    footer {
      text-align: center;
      padding: 10px;
      color: #777;
      font-size: 14px;
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <!-- Header with Hamburger Menu -->
  <header>
    <div class="hamburger-menu">
      <button class="hamburger-button" onclick="toggleMenu()">☰</button>
      <div class="menu-content" id="menuContent">
        <a href="home.php">Home</a>
        <a href="product.php">Product List</a>
        <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
        <a href="logout.php">Log Out</a>
      </div>
    </div>
    <h1>ตะกร้าสินค้า🧺</h1>
  </header>
  
  <div class="container">
    <h2>รายการสินค้าที่อยู่ในตะกร้า</h2>
    <?php if ($cartCount > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>สินค้า</th>
            <th>ราคา</th>
            <th>เพิ่มรายการสินค้า</th>
            <th>ราคารวม</th>
            <th>ลบรายการสินค้า</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $index => $product): ?>
            <?php $itemTotal = $product['price'] * $product['quantity']; ?>
            <tr>
              <td>
                <?php
                  // ตรวจสอบว่ารูปภาพมีอยู่จริงหรือไม่ โดยใช้ path จาก $product['image']
                  if (file_exists($product['image'])) {
                    echo '<img src="'.$product['image'].'" alt="'.$product['name'].'">';
                  } else {
                    echo '<img src="images/no-image.jpg" alt="No Image">';
                  }
                ?>
              </td>
              <td><?php echo $product['name']; ?></td>
              <td><?php echo $product['price']; ?> บาท</td>
              <td>
                <a href="update_cart.php?index=<?php echo $index; ?>&action=inc" class="update-btn">▲</a>
                <?php echo $product['quantity']; ?>
                <a href="update_cart.php?index=<?php echo $index; ?>&action=dec" class="update-btn">▼</a>
              </td>
              <td><?php echo $itemTotal; ?> บาท</td>
              <td>
                <a href="delete_from_cart.php?index=<?php echo $index; ?>" class="delete-btn" onclick="return confirm('คุณต้องการลบสินค้าชิ้นนี้ออกจากตะกร้าหรือไม่?');">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="clearfix">
        <a href="checkout.php" class="checkout-btn">ยืนยันการสั่งซื้อ</a>
      </div>
    <?php else: ?>
      <p style="text-align:center; font-size:18px; color:#555;">ไม่มีสินค้าถูกเพิ่มเข้ามาในตะกร้า</p>
    <?php endif; ?>
  </div>
  
  <footer>&copy; <?php echo date("Y"); ?> โครตFast food🏍. All rights reserved.</footer>
  
  <script>
    function toggleMenu() {
      var menu = document.getElementById("menuContent");
      if (menu.style.display === "block") {
        menu.style.display = "none";
      } else {
        menu.style.display = "block";
      }
    }
    window.onclick = function(e) {
      if (!e.target.matches('.hamburger-button')) {
        var menu = document.getElementById("menuContent");
        if (menu.style.display === "block") {
          menu.style.display = "none";
        }
      }
    }
  </script>
</body>
</html>
