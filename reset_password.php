<?php
include "db.php";
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f1f1f1; }
        .form-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        input[type="password"] {
            width: 100%; padding: 12px; margin-top: 15px;
            border-radius: 5px; border: 1px solid #ccc;
        }
        button {
            width: 100%; margin-top: 20px;
            padding: 12px; background: #0d0137;
            color: white; border: none; border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Reset Your Password</h2>
        <form action="process_reset.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>