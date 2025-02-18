<?php
session_start();

// สร้างข้อมูลสินค้าเริ่มต้น หากยังไม่มีใน Session
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        [
            "name"        => "แฮมเบอร์เกอร์",
            "price"       => 50,
            "description" => "แฮมเบอร์เกอร์รสชาติอร่อยที่ทำจากวัตถุดิบคุณภาพ",
            "image"       => "images/hamburger.jpg"
        ],
        [
            "name"        => "พิซซ่า",
            "price"       => 80,
            "description" => "พิซซ่าหน้าดีและชีสเยอะที่ทุกคนชื่นชอบ",
            "image"       => "images/pizza.jpg"
        ],
        [
            "name"        => "แซนวิส",
            "price"       => 40,
            "description" => "แซนวิสที่ทำสดใหม่ทุกวัน",
            "image"       => "images/sandwich.jpg"
        ],
        [
            "name"        => "โค้ก",
            "price"       => 20,
            "description" => "โค้กเย็นสดชื่นสำหรับทุกมื้อ",
            "image"       => "images/coke.jpg"
        ],
        [
            "name"        => "เฟรนฟราย",
            "price"       => 30,
            "description" => "เฟรนฟรายกรอบ ๆ รสชาติเยี่ยม",
            "image"       => "images/frenchfries.jpg"
        ]
    ];
}

$products = $_SESSION['products'];
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product List - โครตFast food🏍</title>
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
    /* Create Button Style */
    .create-btn {
      display: inline-block;
      margin-bottom: 15px;
      padding: 10px 20px;
      background: #28a745;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .create-btn:hover {
      background: #218838;
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
    td img {
      width: 80px;
      border-radius: 4px;
    }
    .action a {
      display: inline-block;
      margin: 0 5px;
      padding: 6px 10px;
      background: #17a2b8;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      transition: background 0.3s;
    }
    .action a:hover {
      background: #138496;
    }
    .delete-btn {
      background: #dc3545;
    }
    .delete-btn:hover {
      background: #c82333;
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
        <a href="index.php">Product List</a>
        <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
        <a href="logout.php">Log Out</a>
      </div>
    </div>
    <h1>จัดสต็อกสินค้า📋</h1>
  </header>
  <div class="container">
    <h2>รายการสินค้า</h2>
    <!-- ปุ่ม Create สำหรับเพิ่มสินค้าใหม่ -->
    <a href="create.php" class="create-btn">Create</a>
    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>สินค้า</th>
          <th>ราคา</th>
          <th>รายละเอียด</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $index => $product): ?>
          <tr>
            <td>
              <?php if (file_exists($product['image'])): ?>
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
              <?php else: ?>
                <img src="images/no-image.jpg" alt="No Image">
              <?php endif; ?>
            </td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['price']; ?> บาท</td>
            <td><?php echo $product['description']; ?></td>
            <td class="action">
              <a href="edit.php?index=<?php echo $index; ?>">Edit</a>
              <a href="delete.php?index=<?php echo $index; ?>" class="delete-btn" onclick="return confirm('คุณต้องการลบสินค้านี้หรือไม่?');">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
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
