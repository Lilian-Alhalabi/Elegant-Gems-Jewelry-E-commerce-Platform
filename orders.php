<?php
session_start();
include 'db.php'; 

$order_success = false;
$error_msg = "";

if (isset($_POST['submit_order']) && !empty($_SESSION['cart'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);

    $conn->begin_transaction();

    try {
        foreach ($_SESSION['cart'] as $item) {
            $product = $conn->real_escape_string($item['name']);
            $qty = (int)$item['qty'];
            
            $sql = "INSERT INTO orders (name, email, product, quantity, address) 
                    VALUES ('$name', '$email', '$product', $qty, '$address')";
            
            if (!$conn->query($sql)) {
                throw new Exception($conn->error);
            }
        }
        
        $conn->commit();
        $order_success = true;
        unset($_SESSION['cart']); 
    } catch (Exception $e) {
        $conn->rollback();
        $error_msg = "حدث خطأ أثناء معالجة الطلب: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Status - Elegant Gems</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Elegant Gems</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="product.php">Collection</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="admin.php">Dashboard</a></li>
        </ul>
    </nav>
</header>

<main style="text-align: center; padding: 60px 20px;">
    <?php if ($order_success): ?>
        <div style="max-width: 600px; margin: 0 auto; background: #fdfaf3; border: 2px solid #b8860b; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
            <h2 style="color: #b8860b; font-size: 2em;">✅ Order Placed Successfully!</h2>
            <p style="font-size: 1.1em; color: #444; margin: 20px 0;">
                Thank you, <strong><?php echo htmlspecialchars($name); ?></strong>. Your elegant choice is being prepared. 
                We have received your order for the items in your cart.
            </p>
            <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
            <a href="home.html" style="display: inline-block; background: #b8860b; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold;">Back to Shopping</a>
        </div>
    <?php elseif (!empty($error_msg)): ?>
        <div style="max-width: 600px; margin: 0 auto; background: #fff5f5; border: 1px solid #feb2b2; padding: 30px; border-radius: 15px;">
            <h2 style="color: #c53030;">❌ Order Failed</h2>
            <p><?php echo $error_msg; ?></p>
            <br>
            <a href="cart.php" style="color: #b8860b; font-weight: bold;">Return to Cart</a>
        </div>
    <?php else: ?>
        <div style="padding: 40px;">
            <p>No active order found. <a href="product.php" style="color: #b8860b;">Browse our Collection</a></p>
        </div>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; 2026 Elegant Gems Luxury Store. All rights reserved.</p>
</footer>

</body>
</html>
