<?php
include "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get inputs safely
    $student_number = trim($_POST['student_number']);
    $password = trim($_POST['password']);

    // Check if fields are not empty
    if (empty($student_number) || empty($password)) {
        echo "<p style='color:red;'>Both fields are required. <a href='login.html'>Try again</a></p>";
        exit();
    }

    // Prepare SQL
    $sql = "SELECT * FROM users WHERE student_number = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "<p style='color:red;'>Server error: " . htmlspecialchars($conn->error) . "</p>";
        exit();
    }

    $stmt->bind_param("s", $student_number);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($user = $result->fetch_assoc()) {
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            // Set session variables
            $_SESSION['student_number'] = $user['student_number'];
            $_SESSION['name'] = $user['name'];

            // Redirect to main page
            header("Location: index.html");
            exit();
        } else {
            echo "<p style='color:red;'>Incorrect password. <a href='login.html'>Try again</a></p>";
        }
    } else {
        echo "<p style='color:red;'>Student number not found. <a href='login.html'>Try again</a></p>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<p style='color:red;'>Invalid request method. <a href='login.html'>Go back</a></p>";
}
?>
