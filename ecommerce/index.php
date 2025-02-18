<?php
session_start();
$error = "";

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // ข้อมูลผู้ใช้งานตัวอย่าง (Demo User)
    $demo_username = "admin";
    $demo_password = "admin123";

    if ($username === $demo_username && $password === $demo_password) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("Location: home.php");
        exit;
    } else {
        $error = "ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - เข้าสู่ระบบ</title>
  <style>
    /* Global Styles */
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #74ABE2, #5563DE);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    /* Login Container */
    .login-container {
      background: #fff;
      width: 350px;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      text-align: center;
    }
    .login-container h2 {
      margin-bottom: 20px;
      color: #343a40;
      font-size: 24px;
    }
    .login-container form {
      display: flex;
      flex-direction: column;
    }
    .login-container label {
      text-align: left;
      font-size: 14px;
      margin-bottom: 5px;
      color: #555;
    }
    .login-container input[type="text"],
    .login-container input[type="password"] {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
      outline: none;
      transition: border-color 0.3s;
    }
    .login-container input[type="text"]:focus,
    .login-container input[type="password"]:focus {
      border-color: #007bff;
    }
    .login-container input[type="submit"] {
      padding: 10px;
      border: none;
      border-radius: 4px;
      background: #28a745;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    .login-container input[type="submit"]:hover {
      background: #218838;
    }
    .error {
      color: #dc3545;
      font-size: 14px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>เข้าสู่ระบบ</h2>
    <?php if (!empty($error)): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    <form action="" method="post">
      <label for="username">ชื่อผู้ใช้งาน:</label>
      <input type="text" id="username" name="username" required>
      
      <label for="password">รหัสผ่าน:</label>
      <input type="password" id="password" name="password" required>
      
      <input type="submit" value="เข้าสู่ระบบ">
    </form>
  </div>
</body>
</html>
