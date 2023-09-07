<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Get the uploaded profile picture file
    $profile_picture = $_FILES["profile_picture"]["name"];
    $profile_picture_tmp = $_FILES["profile_picture"]["tmp_name"];
    $profile_picture_type = $_FILES["profile_picture"]["type"];

    // Check if passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match. Please try again.";
    } else {
        // Hash the password (you should use a more secure method in production)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Handle profile picture upload
        $target_dir = "uploads/"; // Directory where you want to store uploaded files
        $target_file = $target_dir . basename($profile_picture);

        // Check if the file is an image
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            if (move_uploaded_file($profile_picture_tmp, $target_file)) {
                // File uploaded successfully
                // Database connection (replace with your database credentials)
                $db_host = "localhost";
                $db_user = "root";
                $db_password = "";
                $db_name = "register";

                $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

                // Check for database connection errors
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert user data into the database (you should use prepared statements for security)
                $sql = "INSERT INTO users (first_name, last_name, password, gender, email, phone, address, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssss", $first_name, $last_name, $hashed_password, $gender, $email, $phone, $address, $target_file);

                if ($stmt->execute()) {
                    echo "Registration successful!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>
