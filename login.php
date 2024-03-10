<?php
session_start();

// Check if the user is already logged in, redirect to index.php
if(isset($_SESSION["webprog"])) {
    header("Location: contact.php");
    exit(); // Ensure to exit after redirection
}

$errors = [];

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    require_once "database.php";
    
    $sql = "SELECT * FROM webprog WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user["password"])) {
            $_SESSION["webprog"] = "yes";
            header("Location: contact.php");
            exit(); // Always exit after a header redirect
        } else {
            $errors[] = "Password does not match";
        }
    } else {
        $errors[] = "Username does not exist";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="logandreg.css">
</head>
<body>
    <nav style="width: 100%; height: 85px;">
        <label class="logo">My Personal Website</label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about_me.php">About Me</a></li>
            <li><a class="active" href="#">Contacts</a></li>
            <li><a href="blog.php">Blog</a></li>
        </ul>
    </nav>
    <button class="hamburger">
        <div class="bar"></div>
    </button>
    <nav class="mobile-nav">
        <a href="index.php">Home</a>
        <a href="about_me.php">About Me</a>
        <a class="active" href="login.php">Contacts</a>
        <a href="blog.php">Blog</a>
    </nav>
    <div class="container" style="margin: 120px auto;">
        <form action="login.php" method="post">
        <h1 class="form-title">Login Form</h1>
            <?php if (!empty($errors)): ?>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="main-user-info">
                <div class="user-input-box">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="user-input-box">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" value="Login" class="btn">Login</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="registration.php">Register</a></p>
                </div>
            </div>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>