<?php
include "db.php";

// Ensure all fields are received
if (isset($_POST['student_number'], $_POST['name'], $_POST['email'], $_POST['password'])) {
    $student_number = trim($_POST['student_number']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (student_number, name, email, password_hash) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $student_number, $name, $email, $password);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Registration successful. <a href='login.html'>Login</a></p>";
        } else {
            echo "<p style='color:red;'>Error during execution: " . htmlspecialchars($stmt->error) . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color:red;'>Statement preparation failed: " . htmlspecialchars($conn->error) . "</p>";
    }

    $conn->close();
} else {
    echo "<p style='color:red;'>Please fill all required fields.</p>";
}
?>
