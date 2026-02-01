<?php
session_start();
require __DIR__ . '/db.php';

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = true;
    } else {
        $stmt = $pdo->prepare(
            "SELECT id, email, password_hash 
             FROM users 
             WHERE email = :email 
             LIMIT 1"
        );
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        // Same response whether user exists or not
        if (!$user || !password_verify($password, $user['password_hash'])) {
            $error = true;
        } else {
            $_SESSION['uid'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: landing.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SecurePortal Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #0f172a;
      color: #e5e7eb;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .box {
      background: #020617;
      padding: 2rem;
      width: 360px;
      border-radius: 10px;
      box-shadow: 0 0 30px rgba(0,0,0,.6);
    }
    h2 {
      text-align: center;
      margin-bottom: 1.5rem;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border-radius: 5px;
      border: none;
    }
    button {
      width: 100%;
      padding: 10px;
      background: #2563eb;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
    .error {
      background: #7f1d1d;
      color: #fecaca;
      padding: 8px;
      border-radius: 5px;
      margin-bottom: 12px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>SecurePortal</h2>

    <?php if ($error): ?>
      <div class="error">Invalid email or password</div>
    <?php endif; ?>

    <form method="POST" action="">
      <input
        type="email"
        name="email"
        placeholder="Email address"
        required
      >
      <input
        type="password"
        name="password"
        placeholder="Password"
        required
      >
      <button type="submit">Sign In</button>
    </form>
  </div>
</body>
</html>
