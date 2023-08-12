<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Using prepared statements to prevent SQL injections
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Verify the password hash
            if (password_verify($password, $row['password'])) {
                header('Location: login_success.html');
                exit(); // It's a good practice to exit() after redirecting
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }
    } else {
        echo "Error executing query!";
    }

    $stmt->close();
    $conn->close();
}
?>
