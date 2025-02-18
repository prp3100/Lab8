<?php
session_start();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thank You - สั่งซื้อสำเร็จแล้ว</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #74ABE2, #5563DE);
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .thankyou-container {
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      max-width: 400px;
      width: 90%;
    }
    .checkmark {
      font-size: 60px;
      color: #28a745;
      margin-bottom: 20px;
    }
    .message {
      font-size: 22px;
      color: #333;
      margin-bottom: 30px;
    }
    .home-btn {
      display: inline-block;
      padding: 12px 24px;
      background: #007bff;
      color: #fff;
      border-radius: 4px;
      text-decoration: none;
      font-size: 16px;
      transition: background 0.3s;
    }
    .home-btn:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="thankyou-container">
    <div class="checkmark">✅</div>
    <div class="message">การสั่งซื้อสำเร็จแล้ว</div>
    <a href="home.php" class="home-btn">ย้อนกลับไปหน้า Home</a>
  </div>
</body>
</html>
