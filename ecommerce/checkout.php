<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalOrderPrice = 0;
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Checkout - ยืนยันการสั่งซื้อ🏍</title>
  <style>
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
    .checkout-container {
      display: flex;
      flex-wrap: wrap;
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .form-section, .summary-section {
      flex: 1 1 400px;
      padding: 20px;
    }
    .form-section {
      border-right: 1px solid #f0f0f0;
    }
    .form-section h2, .summary-section h3 {
      text-align: center;
      margin-top: 0;
      color: #343a40;
    }
    .form-section form {
      margin-top: 20px;
    }
    .form-section label {
      display: block;
      margin-bottom: 8px;
      color: #555;
    }
    .form-section input[type="text"],
    .form-section input[type="tel"],
    .form-section input[type="email"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
    }
    .form-section input[type="submit"] {
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
    .form-section input[type="submit"]:hover {
      background: #218838;
    }
    .summary-section table {
      width: 100%;
      border-collapse: collapse;
    }
    .summary-section th, .summary-section td {
      padding: 10px;
      border: 1px solid #f0f0f0;
      text-align: left;
    }
    .summary-section th {
      background: #007bff;
      color: #fff;
    }
    .total-price {
      text-align: right;
      font-size: 18px;
      font-weight: bold;
      margin-top: 15px;
    }
    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #007bff;
    }
    @media (max-width: 768px) {
      .checkout-container {
        flex-direction: column;
      }
      .form-section {
        border-right: none;
        border-bottom: 1px solid #f0f0f0;
      }
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
  <header>
    <div class="hamburger-menu">
      <button class="hamburger-button" onclick="toggleMenu()">☰</button>
      <div class="menu-content" id="menuContent">
        <a href="home.php">Home</a>
        <a href="product.php">Product List</a>
        <a href="cart.php">Cart (<?php echo count($cart); ?>)</a>
        <a href="logout.php">Log Out</a>
      </div>
    </div>
    <h1>Checkout🏍</h1>
  </header>
  <div class="container">
    <div class="checkout-container">
      <div class="form-section">
        <h2>ยืนยันการสั่งซื้อ</h2>
        <form action="thankyou.php" method="post">
          <label for="name">ชื่อ:</label>
          <input type="text" id="name" name="name" required>
          <label for="phone">เบอร์โทร:</label>
          <input type="tel" id="phone" name="phone" required>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
          <input type="submit" value="ยืนยันคำสั่งซื้อ">
        </form>
        <a href="cart.php" class="back-link">กลับไปที่ตะกร้า</a>
      </div>
      <div class="summary-section">
        <h3>สรุปรายการสินค้า</h3>
        <?php if (!empty($cart)): ?>
          <table>
            <thead>
              <tr>
                <th>สินค้า</th>
                <th>ราคา/ชิ้น</th>
                <th>จำนวน</th>
                <th>ราคารวม</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($cart as $product): ?>
                <?php 
                  $itemTotal = $product['price'] * $product['quantity'];
                  $totalOrderPrice += $itemTotal;
                ?>
                <tr>
                  <td><?php echo $product['name']; ?></td>
                  <td><?php echo $product['price']; ?> บาท</td>
                  <td><?php echo $product['quantity']; ?></td>
                  <td><?php echo $itemTotal; ?> บาท</td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <div class="total-price">ยอดรวม: <?php echo $totalOrderPrice; ?> บาท</div>
        <?php else: ?>
          <p>ไม่มีสินค้าในตะกร้า</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <footer>&copy; <?php echo date("Y"); ?> ร้านอาหารของเรา. All rights reserved.</footer>
  <script>
    function toggleMenu(){
      var menu = document.getElementById("menuContent");
      if(menu.style.display === "block"){
        menu.style.display = "none";
      } else {
        menu.style.display = "block";
      }
    }
    window.onclick = function(e){
      if(!e.target.matches('.hamburger-button')){
        var menu = document.getElementById("menuContent");
        if(menu.style.display === "block"){
          menu.style.display = "none";
        }
      }
    }
  </script>
</body>
</html>
