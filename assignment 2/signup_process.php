<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Hashing the password for added security

    // Check if user already exists
    $checkUser = $conn->prepare("SELECT username FROM users WHERE username=?");
    $checkUser->bind_param("s", $username);

    $checkUser->execute();
    $checkUser->store_result();

    if ($checkUser->num_rows > 0) {
        echo "Username already taken!";
        $checkUser->close();
    } else {
        $checkUser->close();

        // Insert the new user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            echo "Account created successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }

    $conn->close();
}
?>
