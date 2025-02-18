<?php
session_start();

// กำหนดข้อมูลสินค้าเริ่มต้น (หากยังไม่มีใน Session)
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
  <title>Home - โครตFast food🏍</title>
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
      max-width: 1200px;
      margin: 20px auto;
      padding: 0 20px;
    }
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .product-item {
      background: #fff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }
    .product-item:hover {
      transform: translateY(-4px);
    }
    .product-item img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    .info {
      padding: 15px;
    }
    .info h2 {
      font-size: 20px;
      margin: 0 0 10px;
      color: #343a40;
    }
    .info p {
      color: #6c757d;
      font-size: 14px;
      margin-bottom: 10px;
    }
    .price {
      font-weight: bold;
      color: #e55353;
      margin-bottom: 10px;
    }
    .add-cart-btn {
      display: inline-block;
      background: #007bff;
      color: #fff;
      padding: 8px 12px;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .add-cart-btn:hover {
      background: #0056b3;
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
        <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
        <a href="logout.php">Log Out</a>
      </div>
    </div>
    <h1>โครตFast food🏍</h1>
  </header>
  <div class="container">
    <div class="product-grid">
      <?php foreach ($products as $index => $product): ?>
        <div class="product-item">
          <?php if (file_exists($product['image'])): ?>
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
          <?php else: ?>
            <img src="images/no-image.jpg" alt="No Image">
          <?php endif; ?>
          <div class="info">
            <h2><?php echo $product['name']; ?></h2>
            <p class="price"><?php echo $product['price']; ?> บาท</p>
            <p><?php echo $product['description']; ?></p>
            <a href="add_to_cart.php?index=<?php echo $index; ?>" class="add-cart-btn">Add Cart</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <footer>&copy; <?php echo date("Y"); ?> โครตFast food🏍. All rights reserved.</footer>
  <script>
    function toggleMenu() {
      var menu = document.getElementById("menuContent");
      if(menu.style.display === "block"){
        menu.style.display = "none";
      } else {
        menu.style.display = "block";
      }
    }
    window.onclick = function(e) {
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
