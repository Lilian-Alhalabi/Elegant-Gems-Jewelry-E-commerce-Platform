<?php
include 'db.php';

$message_sent = false;
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $msg = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$msg')";
    
    if ($conn->query($sql) === TRUE) {
        $message_sent = true;
    } else {
        $error_msg = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Elegant Gems</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Elegant Gems</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="product.html">Collection</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="admin.html">Dashboard</a></li>
        </ul>
    </nav>
</header>

<main style="text-align: center; padding: 50px;">
    <?php if ($message_sent): ?>
        <div style="background: #e6fffa; border: 1px solid #38b2ac; padding: 20px; border-radius: 10px;">
            <h2 style="color: #2c7a7b;">✅ Thank you, <?php echo htmlspecialchars($name); ?>!</h2>
            <p>Your message has been received successfully. We will get back to you soon.</p>
            <br>
            <a href="home.html" style="color: #b8860b; font-weight: bold;">Return to Home</a>
        </div>
    <?php elseif (!empty($error_msg)): ?>
        <div style="background: #fff5f5; border: 1px solid #feb2b2; padding: 20px; border-radius: 10px;">
            <h2 style="color: #c53030;">❌ Oops! Something went wrong.</h2>
            <p><?php echo $error_msg; ?></p>
            <br>
            <a href="contact.html" style="color: #b8860b;">Try Again</a>
        </div>
    <?php else: ?>
        <p>No message submitted. <a href="contact.html">Go to Contact Page</a></p>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2026 Elegant Gems Luxury Store. All rights reserved.</p>
</footer>

</body>
</html>
