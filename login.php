<?php
session_start(); // Start the session
include 'config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from the form
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Perform SQL injection prevention
    $username = mysqli_real_escape_string($connection, $username);

    // Query to fetch user data based on username
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Authentication successful. Set session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['id'];

            // Redirect the user to the home page after successful login
            header("Location: index.php");
            exit;
        } else {
            // Authentication failed. Display an error message
            $error_message = "Invalid credentials. Please try again.";
        }
    } else {
        // No user found with the provided username
        $error_message = "User not found. Please check your username.";
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
    <title>Blog website</title>
</head>

<body>
    <section class="form_section">
        <div class="container form_section-container">
            <h2>Log In</h2>
            <?php if (isset($error_message)): ?>
                <div class="alert_message error"><p><?php echo $error_message; ?></p></div>
            <?php endif; ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Sign In</button>
                <small>Don't have an account? <a href="signup.html">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>
</html>