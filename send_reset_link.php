<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();

        $resetLink = "http://localhost/auth_php_reset/reset_password.php?token=$token";
        echo "A reset link has been sent to your email: <a href='$resetLink'>Reset Password</a>";
    } else {
        echo "No user found with that email. <a href='forgot_password.html'>Try again</a>";
    }
}
?>