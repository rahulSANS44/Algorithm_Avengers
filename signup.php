<?php
session_start(); // Start the session
include 'config.php';

// Initialize variables for error handling
$error_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from the form
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Perform SQL injection prevention
    $username = mysqli_real_escape_string($connection, $username);

    // Check if the username already exists
    $check_username_query = "SELECT * FROM user WHERE username = '$username'";
    $check_username_result = mysqli_query($connection, $check_username_query);
    if (mysqli_num_rows($check_username_result) > 0) {
        $error_message = "Username already exists. Please choose a different username.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $insert_user_query = "INSERT INTO user (username, password) VALUES ('$username', '$hashed_password')";
        if (mysqli_query($connection, $insert_user_query)) {
            // Registration successful. Redirect to login page
            header("Location: login.php");
            exit;
        } else {
            // Error occurred while inserting user data
            $error_message = "Error occurred. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unicons.iconsout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="dg.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Blog website - Sign Up</title>
</head>

<body>
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Sign Up</h2>
            <?php if (!empty($error_message)): ?>
                <div class="alert_message error"><p><?php echo $error_message; ?></p></div>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Sign Up</button>
                <small>Already have an account? <a href="login.php">Sign In</a></small>
            </form>
        </div>
    </section>
</body>
</html>
