<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simulate user credentials for demonstration
    $validEmail = "edenofori1@gmail.com";
    $validPassword = "password123";

    // Get user input from form
    $userEmail = $_POST["email"];
    $userPassword = $_POST["password"];

    // Check if user credentials are valid
    if ($userEmail == $validEmail && $userPassword == $validPassword) {
        // Set a session variable to indicate user is logged in
        $_SESSION["loggedin"] = true;

        // Redirect to the home page or dashboard
        header("Location: wikihome.html");
        exit;
    } else {
        // Display an error message
        $errorMessage = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wiki Chat</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <section>
        <div class="form-box">
            <div class="lo_go">
                <a href="logo.html"><img src="logo1.png" alt="wiki chat"></a>
            </div>
            <div class="form-value">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox"> Remember Me <a href="#">Forget Password</a></label>
                    </div>
                    <button type="submit">Log in</button>
                    <div class="register">
                        <p>Don't have an account? <a href="register.html">Register</a></p>
                    </div>
                </form>

                <?php
                if (isset($errorMessage)) {
                    echo '<p class="error-message">' . $errorMessage . '</p>';
                }
                ?>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
